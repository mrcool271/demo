<?php
/**
 * 将时间显示为 刚刚、n分钟/小时前、昨天前天 等
 */

date_default_timezone_set('PRC');//Asia/Shanghai

function transfer_time($time) 
{
	$rtime = date("Y-m-d H:i",$time);
	$htime = date("H:i",$time);

	$time = time() - $time;

	if ($time < 60)
	{
		$str = "刚刚";
	}
	elseif ($time < 60 * 60)
	{
		$min = floor($time/60);
		$str = $min.'分钟前';
	}
	elseif ($time < 60 * 60 * 24)
	{
		$h = floor($time/(60*60));
		$str = $h.'小时前 '.$htime;
	}
	elseif ($time < 60 * 60 * 24 * 3)
	{
		$d = floor($time/(60*60*24));
		if($d==1)
			$str = '昨天 '.$rtime;
		else
			$str = '前天 '.$rtime;
	}
	else
	{
		$str = $rtime;
	}
	return $str;
}
$date = "1390234032";
echo transfer_time($date);
exit;
/*
	上面这个是将 Unix时间戳 转化为时间轴显示的PHP函数方法，在SNS，微博上面用的比较多。
 */
