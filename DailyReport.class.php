<?php

namespace Virus\Script;

/**
 * 交易摘要统计脚本
 * @author yutingwu@meilishuo.com
 * @version 0.1
 */
class DailyReport extends \Virus\Frame\Qandt\Script
{

    const TABLE_ORDER = 't_bat_order';
    const SENDMAIL_SUBJECT = '每日交易统计摘要';
    const SENDMAIL_FROM = 'yutingwu@meilishuo.com';
    const SENDMAIL_TO = 'yunzhao@meilishuo.com,chaoguo@meilishuo.com,yishuliu@meilishuo.com, yingliu@meilishuo.com, weifengcui@meilishuo.com, yutingwu@meilishuo.com, changhuaxiao@meilishuo.com, chengwenhu@meilishuo.com, hailongchen@meilishuo.com';
    const DAY_SECONDS = 86400;
    const DAY_SINCE = 14;

    private static $_fields = array('ctime', 'pay_time', 'send_time', 'receive_time');
    private static $_sources = array('all', 'mob', 'pc');
    private $_date;

    public function __construct($args)
    {
        parent::__construct($args);
        $this->_init();
    }

    private function _init()
    {
        $arguments = $this->getArguments();
        $date = isset($arguments['t']) ? trim($arguments['t']) : date('Ymd', strtotime('-1 day'));
        $this->_date = date('Ymd', strtotime($date));
    }

    /**
     * 调用所有的子类
     */
    public function run()
    {
        $subject = self::SENDMAIL_SUBJECT . '-' . $this->_date;
        $body = $this->_makeBody();
        return $this->_sendMimeMail(self::SENDMAIL_FROM, self::SENDMAIL_TO, $subject, $body);
    }

    /**
     * 获取date，还有几个类型的信息
     * @param type $withCoupon
     * @return type
     */
    private function _getData($withCoupon = true, Array $fields = array())
    {
        $data = array();
        for ($i = 0; $i < self::DAY_SINCE; $i++) {
            $date = date('Y-m-d', strtotime($this->_date) - self::DAY_SECONDS * $i);
            $fields = $fields ? $fields : self::$_fields;
            foreach ($fields as $field) {
                $data[$date][$field] = $this->_getSummary($field, $date, $withCoupon);
            }
        }
        return $data;
    }

    /**
     * 获取计数信息
     * @param type $field
     * @return array
     */
    private function _getSummary($field = 'ctime', $date = null, $withCoupon = true)
    {
        $data = array();
        $date = $date ? $date : $this->_date;
        $start = strtotime($date);
        $end = $start + 86400;
        $VirtualShop = \Virus\Package\Coupon\PurchaseLimitVerify::$VirtualShop;
        $excludeShop = $VirtualShop ? '`shop_id` not in (' . implode(',', $VirtualShop) . ') ' : '1';
        $withCoupon = $withCoupon ? '1' : 'ifnull(`coupon_allowance`, 0) = 0';
        $sql = "SELECT COUNT(`order_id`) AS `count`, SUM(`total_price`) AS `total_price`, "
            . "SUM(`coupon_allowance`) AS `coupon_allowance`, `source` "
            . "FROM `" . self::TABLE_ORDER . "` "
            . "WHERE  `$field` >= $start AND `$field` < $end AND $withCoupon AND $excludeShop "
            . "GROUP BY `source`";
        $result = \Virus\Package\Order\Helper\DBOrderHelper::getConn()->read($sql);
        if (!$result) {
            return $data;
        }
        foreach ($result as $row) {
            //source 第一位为是4或7为pc 否则 mob
            $source = $row['source'][0] == 4 || $row['source'][0] == 7 ? 'pc' : 'mob';
            foreach ($row as $k => $v) {
                if (!isset($data['all'][$k])) {
                    $data['all'][$k] = 0;
                }
                $data['all'][$k] += $v;

                if (!isset($data[$source][$k])) {
                    $data[$source][$k] = 0;
                }
                $data[$source][$k] += $v;
            }
        }
        return $data;
    }

    /**
     * 发信方法
     * @param type $from
     * @param type $to
     * @param type $subject
     * @param type $body
     * @return type
     */
    private function _sendMimeMail($from, $to, $subject, $body)
    {
        $subject = mb_convert_encoding($subject, 'gbk', 'utf-8');
        $body = mb_convert_encoding($body, 'gbk', 'utf-8');
        $body = wordwrap($body, 70);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=gbk' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n";
        return mail($to, $subject, $body, $headers);
    }

    /**
     * 创建邮件正文
     * @param type $data
     * @return string
     */
    private function _makeBody()
    {
        $data = $this->_getData();
        //全部信息
        $summaryHeader = array('日期', '星期', '收订数量', '收订总额', '支付数量', '支付总额', '支付单均', '支付礼券金额');
        $summaryHeader = $this->_tableRowHelper($summaryHeader, 'th');
        $summaryBody = '';
        foreach ($data as $date => $item) {
            $order = $item['ctime']['all'];
            $pay = $item['pay_time']['all'];
            $send = $item['send_time']['all'];
            $receive = $item['receive_time']['all'];
            $fields = array($date, $this->_getWeek($date), $order['count'], number_format($order['total_price'], 2), $pay['count'], number_format($pay['total_price'], 2),
                number_format($pay['total_price'] / $pay['count'], 2), number_format($pay['coupon_allowance'], 2));
            $summaryBody .= $this->_tableRowHelper($fields);
        }

        //收发货信息表
        $deliveryHeader = array('日期', '星期', '发货数量', '发货总额', '收货数量', '收货总额');
        $deliveryHeader = $this->_tableRowHelper($deliveryHeader, 'th');
        $deliveryBody = '';
        foreach ($data as $date => $item) {
            $order = $item['ctime']['all'];
            $pay = $item['pay_time']['all'];
            $send = $item['send_time']['all'];
            $receive = $item['receive_time']['all'];
            $fields = array($date, $this->_getWeek($date), $send['count'], number_format($send['total_price'], 2), $receive['count'], number_format($receive['total_price'], 2));
            $deliveryBody .= $this->_tableRowHelper($fields);
        }

        //来源分拆
        $sourceHeader = array('日期', '星期', '手机收订数量', '手机收订总额', '网页收订数量', '网页收订总额', '手机支付数量', '手机支付总额', '网页支付数量', '网页支付总额');
        $sourceHeader = $this->_tableRowHelper($sourceHeader, 'th');
        $sourceBody = '';
        foreach ($data as $date => $item) {
            $orderMob = $item['ctime']['mob'];
            $orderPc = $item['ctime']['pc'];
            $payMob = $item['pay_time']['mob'];
            $payPc = $item['pay_time']['pc'];
            $fields = array($date, $this->_getWeek($date),
                $orderMob['count'], number_format($orderMob['total_price'], 2), $orderPc['count'], number_format($orderPc['total_price'], 2),
                $payMob['count'], number_format($payMob['total_price'], 2), $payPc['count'], number_format($payPc['total_price'], 2)
            );
            $sourceBody .= $this->_tableRowHelper($fields);
        }

        //无礼券
        $data = $this->_getData(false);
        $rawHeader = array('日期', '星期', '收订数量', '收订总额', '支付数量', '支付总额', '支付单均', '支付礼券金额');
        $rawHeader = $this->_tableRowHelper($rawHeader, 'th');
        $rawBody = '';
        foreach ($data as $date => $item) {
            $order = $item['ctime']['all'];
            $pay = $item['pay_time']['all'];
            $send = $item['send_time']['all'];
            $receive = $item['receive_time']['all'];
            $fields = array($date, $this->_getWeek($date), $order['count'], number_format($order['total_price'], 2), $pay['count'], number_format($pay['total_price'], 2),
                number_format($pay['total_price'] / $pay['count'], 2), number_format($pay['coupon_allowance'], 2));
            $rawBody .= $this->_tableRowHelper($fields);
        }
        $body = <<<EOF
<html><head><title></title>
<style type='text/css'>
    table {border-collapse:collapse;border:#ddd 1px solid;font-size:12px;width:95%;margin-left:10px;text-align:center;}
    table th,table td {padding-left:2px;padding-right:2px;border:#ddd 1px solid;border-collapse:collapse;height:25px;overflow:hidden;line-height:25px;}
    table thead {height:30px;line-height:30px;font-weight:bold;color:#ed7d00;}
	table tbody td {text-align:right;}
</style>
</head><body>
<br /><br />
<table><catption>每日交易摘要表</caption><thead>$summaryHeader</thead><tbody>$summaryBody</tbody></table>
<br /><br />
<table><catption>无礼券交易摘要表</caption><thead>$rawHeader</thead><tbody>$rawBody</tbody></table>
<br /><br />
<table><catption>收发货摘要表</caption><thead>$deliveryHeader</thead><tbody>$deliveryBody</tbody></table>
<br /><br />
<table><catption>交易来源拆分表</caption><thead>$sourceHeader</thead><tbody>$sourceBody</tbody></table>
</body></html>
EOF;
        return $body;
    }

    /**
     * 表格生成器
     * @param type $data
     * @param type $td
     * @return string
     */
    private function _tableRowHelper($data, $td = 'td')
    {
        $string = "<tr><$td>" . implode("</$td><$td>", $data) . "</$td></tr>\n";
        return $string;
    }

    /**
     * 获取星期
     * @staticvar array $weekarray
     * @param type $date
     * @return type
     */
    private function _getWeek($date)
    {
        static $weekArray = array('星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六');
        if (!is_numeric($date)) {
            $date = strtotime($date);
        }
        $offset = date("w", $date);
        return $weekArray[$offset];
    }

}
