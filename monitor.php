<?php
// $list = scandir(__DIR__);

$file = "/Users/cui/Sites/tgjr/sqjr_ver2_api.com/storage/logs/laravel.log"; 
$date = '2017-05-02 11:36';
$log = '';
$command = "tail -5000 {$file} | grep '.ERROR.' | grep '{$date}' ";
exec($command . ' 2>&1', $log, $status);
if($log) {
    $str = "# laravel.log \r\n ";
    $message = [];
    $count = count($log);
    $message[] = " ## 【Admin - ERROR - {$count} 条】";
    foreach ($log as $key => $val) {
        $message[] = $val;
        $message[] = "---------------------";
    }
}
// echo $log = implode(PHP_EOL, $log);
// 将会发送到钉钉webhook的数据
$data = [
    'msgtype' => 'markdown',
    'markdown' => [
        'title' => '错误日志',
        'text' => ''
    ]
];

/**
 * 推送到钉钉
 */
// 原生markdown中两个换行才是真的换行，别听钉钉文档瞎吹，一个\n不行的
// 我在这儿被坑了超久
$data['markdown']['text'] = implode('\r\n\r\n ', $message);
$data = json_encode($data);
// json编码后，上面的\r\n\r\n会变成\\r\\n\\r\\n，所以要替换成正常的状态
$data = str_replace('\\\\r\\\\n\\\\r\\\\n', '\r\n\r\n', $data);
$data = str_replace('\\\\r\\\\n', '\r\n', $data);

print_r($data);
exit;

sendDingTalk('3da3d630072c898307d3d798cd688bb066231b70e396c0111fe2e85a6b7c5839', $data);
exit;

// ob_start();
// foreach ($list as $item) {
//     if(is_dir($item)){ 
//         echo $item;
//         echo PHP_EOL;
//     }
    
// }
// phpinfo();
// $info = ob_get_contents();
// ob_end_clean();
// echo $info;
// print_r($list);

sendDingTalk('3da3d630072c898307d3d798cd688bb066231b70e396c0111fe2e85a6b7c5839', '');

function sendDingTalk($accessToken, $dataString) {
    if(empty($accessToken)) {
        return 'params is empty!';
    }
    $tokens = [];
    $webhook = "https://oapi.dingtalk.com/robot/send?access_token=%s";
    if(is_string($accessToken)) {
        $tokens[] = $accessToken;
    }elseif(is_array($accessToken)) {
        $tokens = array_unique($accessToken);
    }
    foreach ($tokens as $token) {
        $webhook = sprintf($webhook, $token);
        $message="monitor test";
//         $atMobiles = [];
//         $data = array ('msgtype' => 'text','text' => array ('content' => $message), 'at' => array('atMobiles' => $atMobiles, 'isAtAll' => true));
//         $dataString = json_encode($data);
        
        echo $result = requestByCurl($webhook, $dataString);
    }
}

function requestByCurl($webhook, $dataString) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $webhook);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
     
    return $result;
}


