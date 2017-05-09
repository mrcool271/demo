<?php  
function request_by_curl($remote_server, $post_string) {  
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $remote_server);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    $data = curl_exec($ch);
    curl_close($ch);  
               
    return $data;  
}  
 
$webhook = "https://oapi.dingtalk.com/robot/send?access_token=3da3d630072c898307d3d798cd688bb066231b70e396c0111fe2e85a6b7c5839";
$message="robot at test";
$data = array ('msgtype' => 'text','text' => array ('content' => $message), 'at' => array('atMobiles' => array('18600369129','18600369129'), 'isAtAll' => false));
$data_string = json_encode($data);
 
$result = request_by_curl($webhook, $data_string);  
echo $result;
