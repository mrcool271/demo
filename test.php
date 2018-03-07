<?php 
echo 12345;
$status = 1;
$log = '';
$cmd = "source /etc/profile";//&& cd /tmp/t1/release/demo/20170420-165955 && ls -al && ln -sfn /tmp/t1/release/demo/20170420-165955 /tmp/t1/release/demo/current-demo.tmp && chown -h test /tmp/t1/release/demo/current-demo.tmp && mv -fT /tmp/t1/release/demo/current-demo.tmp /tmp/t1/t2";
exec($cmd . ' 2>&1',$log,$status);
var_dump($log);
var_dump($status);
exit;


$status = 1;
$log = '';
$cmd = "ssh -T -p 22 -q -o UserKnownHostsFile=/dev/null -o StrictHostKeyChecking=no -o CheckHostIP=false 'test'@'172.168.66.110' '. /etc/profile && cd /tmp/t1/release/demo/20170420-165955 && ls -al && ln -sfn /tmp/t1/release/demo/20170420-165955 /tmp/t1/release/demo/current-demo.tmp && chown -h test /tmp/t1/release/demo/current-demo.tmp && mv -fT /tmp/t1/release/demo/current-demo.tmp /tmp/t1/t2";
exec($cmd . ' 2>&1',$log,$status);
var_dump($log);
var_dump($status);
exit;

$t = escapeshellarg("cd /tmp/t1/t2/../conf/demo/prod && cp -rf t.php /tmp/t1/release/demo/20170420-143327/t.php && cp -rf t.php /tmp/t1/release/demo/20170420-143327/t.php.tt");
var_dump($t);
exit;


$callback = $_GET['callback'];
echo $callback.'({
"code": "CA1998",
"price": 1780,
"tickets": 5
})';
exit;
// printInfo($_SERVER);exit;

$branch = 3;

echo strtotime("2009-09-10 16:00:10").'<br/>';	//输出 1252569610
echo strtotime("10 September 2009").'<br/>';	//输出 1252512000
echo strtotime("+1 day")."<br/>";	//输出明天此时的时间戳 1390477302

// echo strtotime("2009-09-10 16:00:10");	//输出 1252569610
// echo strtotime("10 September 2009");	//输出 1252512000
// echo strtotime("+1 day"), "<br />";	//输出明天此时的时间戳 1390477302

function printInfo($arr,$is_detail=0){
	echo '<pre>';
	if($is_detail){
		var_dump($arr);
	}else{
		print_r($arr);
	}
	echo '</pre>';
}
// $str= mt_rand();
// $str = uniqid(mt_rand(), TRUE);
// var_dump($_REQUEST);
// echo strlen($str);
// $path_parts = pathinfo($filename);
exit;