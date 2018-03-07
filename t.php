<?php

$a = (object) [];
echo json_encode($a);
exit;

$errors = array();
$warnings = array();
if ( extension_loaded('ionCube Loader') ) {
	$version = 'ionCube';
} else {
	$errors[] = 'Unable to find the ionCube Loader.  Please be sure the ionCube Loader is installed and configured on your server';
}
if ( version_compare(PHP_VERSION, '5.2.0', '<') ) {
	$errors[] = 'ClientExec requires you run PHP 5.2.0 or newer.  You are currently running ' . PHP_VERSION;
}
if ( !function_exists('mysql_connect') ) {
	$errors[] = 'The required PHP extension MySQL could not be found.';
}
if ( !function_exists('mb_ereg') ) {
	$errors[] = 'The required PHP extension Multibyte String with Regex could not be found.';
}
if ( !function_exists('gd_info') ) {
	$errors[] = 'The PHP extension GD could not be found.  This is required for report graphs.';
}
// Warnings
if ( !extension_loaded('mcrypt') ) {
	$warnings[] = 'The PHP extension mcrypt could not be found.  You will not be able to encrypt hosting passwords, or store Credit Card information.';
}
if ( !function_exists('curl_init') ) {
	$warnings[] = 'The PHP extension cURL could not be found.  Some control panel and dashboard plugins require this extension.';
}
if ( !function_exists('imap_mime_header_decode') ) {
	$warnings[] = 'The PHP extension imap could not be found.  This is required for e-mail fetching and piping to function.';
}


print_r($errors);
print_r($warnings);
exit;



echo $str = pack('h*','abkkdadlsfdalskfjs');
echo bin2hex($str);
// echo $str = pack('H*','ffff');

// echo strlen ( $str );
exit;

$command = "/sbin/ifconfig | grep 'inet addr'|awk '{print $2}'|cut -d ':' -f2 | awk '$1 !~ /127.0.0.1/{print}'| tail -n 1";
$command = escapeshellcmd($command);





//本机IP地址命令行
$cmd = "/sbin/ifconfig | grep 'inet addr'|awk '{print $2}'|cut -d ':' -f2 | awk '$1 !~ /127.0.0.1/{print}'| tail -n 1";
$handle = popen($cmd, 'r');
echo $ip = trim(fread($handle, 1024));
pclose($handle);
exit;

































$a = range(0, 10);
$b = range('a', 'z');
print_r($a);
exit;


print_r($_SERVER);
exit;
/**
Array
(
    [HTTP_HOST] => demo.com
    [HTTP_USER_AGENT] => Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0
    [HTTP_ACCEPT] => text/html,application/xhtml+xml,application/xml;q=0.9,;q=0.8
    [HTTP_ACCEPT_LANGUAGE] => zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3
    [HTTP_ACCEPT_ENCODING] => gzip, deflate
    [HTTP_DNT] => 1
    [HTTP_CONNECTION] => keep-alive
    [HTTP_PRAGMA] => no-cache
    [HTTP_CACHE_CONTROL] => no-cache
    [PATH] => /usr/bin:/bin:/usr/sbin:/sbin
    [SERVER_SIGNATURE] => 
    [SERVER_SOFTWARE] => Apache/2.2.26 (Unix) PHP/5.4.30 DAV/2 mod_ssl/2.2.26 OpenSSL/0.9.8za mod_perl/2.0.7 Perl/v5.16.2
    [SERVER_NAME] => demo.com
    [SERVER_ADDR] => 127.0.0.1
    [SERVER_PORT] => 80
    [REMOTE_ADDR] => 127.0.0.1
    [DOCUMENT_ROOT] => /Users/cui/Sites/git/demo
    [SERVER_ADMIN] => you@example.com
    [SCRIPT_FILENAME] => /Users/cui/Sites/git/demo/t.php
    [REMOTE_PORT] => 54075
    [GATEWAY_INTERFACE] => CGI/1.1
    [SERVER_PROTOCOL] => HTTP/1.1
    [REQUEST_METHOD] => GET
    [QUERY_STRING] => 
    [REQUEST_URI] => /t.php
    [SCRIPT_NAME] => /t.php
    [PHP_SELF] => /t.php
    [REQUEST_TIME_FLOAT] => 1450082107.332
    [REQUEST_TIME] => 1450082107
)



 */


$process = "httpd";
$command = "ps aux | grep {$process} | grep -v grep | grep -v 'ps aux' | grep -v vim";
// echo exec($command);// 最后一条结果
exec($command, $output);//output is array
print_r($output);
echo (int)$output[0];
echo "\n";
// echo shell_exec($command);// 所有结果字符串
exit;

Class Ttt {
	
	public function tt() {
// 		echo __CLASS__;
		$process = 'httpd';
		exec("ps aux | grep {$process} | grep -v grep | grep -v 'ps aux' | grep -v vim",$output);
// 		var_dump($output);
		echo count($output);
	}
	function getProcessCpuUsage($process)
	{
		if(!$process) return -1;
	
		$c_pid = exec("ps aux | grep ".$process." | grep -v grep | grep -v su | grep -v 'ps aux' | awk {'print $3'}");
		return $c_pid;
	}
	
	function getProcessMemUsage($process) {
		if(!$process) return FALSE;
	
		$c_pid = exec("ps aux | grep ".$process." | grep -v grep | grep -v su | grep -v 'ps aux' | awk {'print $4'}");
		return $c_pid;
	}
	
	function getProcessPid($process) {
		if(!$process) return FALSE;
	
		$c_pid = exec("ps aux | grep ".$process." | grep -v grep | grep -v su | grep -v 'ps aux' | awk {'print $2'}");
		return $c_pid;
	}
	
	function getProcessUser($process) {
		if(!$process) return FALSE;
	
		$c_pid = exec("ps aux | grep ".$process." | grep -v grep | grep -v su | grep -v 'ps aux' | awk {'print $1'}");
		return $c_pid;
	}
	
}

$t = new Ttt();
$t->tt();
exit;

/* An easy way to keep in track of external processes.
 * Ever wanted to execute a process in php, but you still wanted to have somewhat controll of the process ? Well.. This is a way of doing it.
* @compability: Linux only. (Windows does not work).
* @author: Peec
*/
class Process{
	private $pid;
	private $command;

	public function __construct($cl=false){
		if ($cl != false){
			$this->command = $cl;
			$this->runCom();
		}
	}
	private function runCom(){
		$command = 'nohup '.$this->command.' > /dev/null 2>&1 & echo $!';
		exec($command ,$op);
		$this->pid = (int)$op[0];
	}

	public function setPid($pid){
		$this->pid = $pid;
	}

	public function getPid(){
		return $this->pid;
	}

	public function status(){
		$command = 'ps -p '.$this->pid;
		exec($command,$op);
		if (!isset($op[1]))return false;
		else return true;
	}

	public function start(){
		if ($this->command != '')$this->runCom();
		else return true;
	}

	public function stop(){
		$command = 'kill '.$this->pid;
		exec($command);
		if ($this->status() == false)return true;
		else return false;
	}
}
?>



echo $url = "http://www.baidu.com";
// echo $url = "http://xapi.jr.test.ffan.com/saveriskscore";

$ch = curl_init();

$opt = array(
		CURLOPT_URL => $url,
		CURLOPT_POST => 1,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_FOLLOWLOCATION => false,
		CURLOPT_COOKIEJAR => tempnam('/tmp/', 'test_Cookie_'),
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_TIMEOUT => 10
);

// $opt[CURLOPT_COOKIE] = 'uid=1234';
$opt[CURLOPT_HEADER] = true;
curl_setopt_array($ch, $opt);
$data = curl_exec($ch);
print_r(array($data));
exit;






echo print_r($_SERVER,1);
exit;


//字符串遮罩
$str = '刘鑫总';
$start = 1;
$end = -1;
$shade_num = 4;
$shade='*';

mb_strlen($str,'utf-8')==2 && $start = 0;
$temp_str = mb_substr($str, $start, $end, 'utf-8');
$shade = str_repeat($shade, $shade_num);
$temp_str = str_replace($temp_str, $shade, $str);
echo $temp_str;



$d = '2015-01-20 18:55:00';
echo date('n H:i',strtotime($d));
exit;


// $a = intval('');
// var_dump($a);
// exit;

b1();
function b1() {
	a1();
}
function a1() {
	print_r($_SERVER);
}
exit;


// if(0 == 'a') {
// 	echo 999;exit;//√
// }
$err = array ( 'error_msg' => '银行卡已绑定', 'error_no' => 501, 'rpc_return' => array ( 'status' => 501, 'message' => '银行卡已绑定', 'idCode' => 0 ) );
$codeArr = array('101'=>'成功','102'=>'失败','103'=>'not_auth','104'=>'超时');
if(array_key_exists(0, $codeArr)) {
	echo 888;//x
}
if(in_array(0, $codeArr)) {
	echo 111;//√
}
if(in_array(0, $codeArr,true)) {
	echo 222;//x
}
echo 'end';exit;
if(isset($err['rpc_return']['idCode']) && array_key_exists($err['rpc_return']['idCode'],$codeArr)) {
	echo 123;
	echo $err['rpc_return']['idCode'];
	echo $codeArr[$err['rpc_return']['idCode']];
}
exit;

$a = array_change_key_case(array('idCard'=>'102'));
print_r($a);
exit;


$a = false;
var_dump(json_decode(json_encode($a)));
exit;

echo date('Y-m-d H:i:s',1420420876);
exit;

$a = 'A2340';
echo addslashes($a);
exit;

echo date('Y-m-d H:i:s',strtotime('-10 day'));
exit;


$hashArr = array('a'=>array(1,2,3),'b'=>66,22);
print_r(array_keys($hashArr));
exit;

// $arr = array(1,2,3);
// echo implode(',', $arr);
// exit;
$condition = array(
		"uid = 2",
		"status = 0"
);

echo implode(',', $condition);
exit;
echo $t;
print_r($t);
exit;

$a = array(1,2,3);
echo json_encode($a);
exit;

$today = new \DateTime(date('Y-m-d'));

var_dump($today);
$invest_end_time = new \DateTime(date('Y-m-d ', time()-86400));
//$invest_end_time->add(new \DateInterval('P1D'));
var_dump($invest_end_time);
$days = (int)$today->diff($invest_end_time)->format('%R%a');
var_dump($days);
exit;
return intval($days) < 0 ? 0 : $days;

exit;



$param_arr = array('a','b','c');
var_dump(call_user_func_array('sprintf', $param_arr));
exit;



echo var_dump(json_decode(json_encode(false)));
exit;


// $a = json_decode('{"finance_common_result_code":0,"status":"0","message":"\u6210\u529f"}',1);
// var_dump($a);
// exit;

if(null == 0) {
	echo 1234;//√
}
if(false == 0) {
	echo 5678;//√
}
exit;

phpinfo();
exit;

// echo sprintf('%.2f',0.58*100);
// exit;
sprintf('%.2f',floor(strval(0.58*100))/100);//done
var_dump( floor(strval(0.58*100))/100);
// echo sprintf('%.2f',0.58*100/100);
exit;

echo floatval(0.58*100 - 58);
exit;

echo 6.71/100 - 0.0671;
exit;

echo $aa = (10001.22*100);
echo gettype($aa);
echo 10001.22*100 - 1000122;
exit;
echo '<br/>';
echo $aa / 100;
echo '<br/>';
echo $aa = intval(10001.22*1000);
echo '<br/>';
echo ($aa / 1000);
exit;

echo bcsub(6.71/100, 0.0671,7);
exit;

$a = '0.0671';
$b = (double)$a;
if($a != $b) {
	echo 1;
}
// echo gettype($b);
exit;


echo 6.71/100;
exit;

if(0.06 != '0.06'){
	echo 1;
}else {
	echo 2;
}
exit;

phpinfo();
exit;

var_dump('a'== 0);//true
exit;

echo var_dump(is_int(183/61));
exit;

echo $t1 = microtime(1);
sleep(1);
usleep(1);
echo '--';
echo microtime(1);
echo '--';
echo microtime(1) - $t1;
exit;

echo json_encode(array('PAY_SUCCESS', 'TRADE_SUCCESS'));
echo json_encode(array('9001'));
exit;


echo count(false);//1
exit;
echo date("Y-m-d H:i:s");
exit;
$a = null;
var_dump(count($a));
exit;

echo 6000 / 1000 /100;
exit;

echo date("Y-m-d",strtotime("-1 day"));
echo date("Y-m-d");
echo date("Y-m-d",strtotime("+1 day"));
exit;

$a = '1';
echo "'$a'";
exit;

$t = '[{"name":"projectNo","value":"1410201121189362"},{"name":"accountName","value":""},{"name":"startTime","value":""},{"name":"endTime","value":""},{"name":"frm","value":"invest_list"}]';
print_r(json_decode($t,1));
exit;
$a = '123456789';
echo substr($a, -4);;
exit;

var_dump(json_decode(json_encode(FALSE)));
// echo FALSE;
exit;

$arr = array('a','b','c');
echo $str = str_replace(array('y%','m%','d%'), $arr, 'yyyy%mmm%ddd%');
exit;


echo date('Y-m-d H:i:s');
exit;

echo md5('3719');
exit;


echo date('Y-m-d H:i:s', time());
exit;

$a = 1.235;
echo floor(1.239*100)/100;
exit;
echo sprintf('%.2f',floor(1.235*100)/100);
/*
echo 123;exit;
$number = 10001.22;
$rate1 = 100;
$rate2 = 1000;

test($number, $rate1);
echo "------\n";
// test($number, $rate2);

function test($number, $rate){
	$aa = $number * $rate;
	$aa = bcmul($number, $rate);
	var_dump($aa);
	$aa = intval($aa);
	var_dump($aa);
	$aa = bcdiv($aa, $rate, 2);
	var_dump($aa);
}

exit;

*/

