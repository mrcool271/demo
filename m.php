<?php




//本机IP地址命令行
$cmd = "/sbin/ifconfig | grep 'inet addr'|awk '{print $2}'|cut -d ':' -f2 | awk '$1 !~ /127.0.0.1/{print}'| tail -n 1";
$handle = popen($cmd, 'r');
echo $ip = trim(fread($handle, 1024));
pclose($handle);
exit;






// 发送163邮箱没问题，发送公司邮箱不可以
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
// echo phpversion();
$from = 'cuiweifeng@wanda.cn'; 
$to = 'cuiweifeng@wanda.cn,luhongguang@wanda.cn';
$body = 'testaaaaa';
$subject = 'test';
// $subject = mb_convert_encoding($subject, 'gbk', 'utf-8');
// $body = mb_convert_encoding($body, 'gbk', 'utf-8');
$body = wordwrap($body, 70);
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type:text/html;charset=gbk' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";
$ret = mail($to, $subject, $body, $headers);
var_dump($ret);exit;

// $ret = mail('adj_0051@163.com', "没有主题", $message);
// $ret = mail('cuiweifeng@wanda.cn', "没有主题", $message);
var_dump($ret);
exit;




//str_replace str replace str
$find = array("中","文","国家");
$replace = "";
$str = "中文ddda国家dsfd";
foreach ($find as $val ) {
	$len = mb_strlen($val,'utf-8');
	$replace = str_pad($replace,$len,"*");
	$str = str_replace($val,$replace,$str);
}
print_r($str);
exit;


//str_replace array replace array
$find = array("中","文","国家");
$str = "中文ddda国家dsfd";
$replace = array('A','B','C');
print_r(str_replace($find,$replace,$str));
exit;


echo phpversion();exit;
echo mail("cuiweifeng@wanda.cn", "test主题", “test”);