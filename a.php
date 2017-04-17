<?php
echo '222';exit;
echo 'master';
print_r($_SERVER);
exit;


echo json_encode(array('你好'),JSON_UNESCAPED_UNICODE);
exit;
print_r($_SERVER);
exit;

echo microtime(1);exit;
echo $time = sprintf("%8s.%03d",date('H:i:s'),floor(microtime()*1000));
exit;
echo __DIR__;exit;
define('TT',dirname(__FILE__).'ABC');
echo TT;
exit;


// header("Location:http://oauth2.com/sso/checkticket?ticket=12345");
// header("Location:http://oauth2.com/sso/test");
$url = "http://oauth2.com/test/test?access_token=6bPJG4Dk0p6M4kE8NKLts1W59CJiZoZF4yZMr7nA1";
$a = http_get($url);
print_r(json_decode($a,1));
exit;

/**
 * GET 请求
 * @param string $url
 */
function http_get($url){
	$oCurl = curl_init();
	if(stripos($url,"https://")!==FALSE){
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
	}
	curl_setopt($oCurl, CURLOPT_URL, $url);
	curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
	$sContent = curl_exec($oCurl);
	$aStatus = curl_getinfo($oCurl);
	curl_close($oCurl);
    return $sContent;
}

exit;

function https_get() {
    $curl = curl_init();
    // 刚开始抓取了https://github.com,但是页面弹框，后来改用抓取支付宝首页测试
    curl_setopt($curl, CURLOPT_URL, 'https://www.alipay.com');
    // 设置header
    curl_setopt($curl, CURLOPT_HEADER, 1);
    // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 运行cURL，请求网页数据
    $data = curl_exec($curl);
    // 关闭cURL请求
    curl_close($curl);
    // 打印出抓取的测试数据
    var_dump($data);
}

echo 'master';
echo 'merge';

$ticket = '12345';
$tokenArr = array(1,2,3);
$server = Yii::app()->oauth2Resource;
$response = new OAuth2ServerResponse;
$redis = new RedisClient();
$data = $redis->hMSet($this->ticketKey . $ticket);
// 		$redis->hMSet($this->ticketKey . $ticket, $tokenArr);
// 		$redis->expire($this->ticketKey . $ticket, 6000);
$redis->delete($this->ticketKey . $ticket);
$data = $redis->hMGet($this->ticketKey . $ticket);
print_r($data);
exit;
exit;
