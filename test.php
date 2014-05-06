<?php 

// printInfo($_SERVER);exit;

$branch = 2;

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