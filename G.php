<?php
function G($start,$end='',$dec=4) {
	static $_info       =   array();
	static $_mem        =   array();
	if(is_float($end)) { // 记录时间
		$_info[$start]  =   $end;
	}elseif(!empty($end)){ // 统计时间和内存使用
		if(!isset($_info[$end])) $_info[$end]       =  microtime(TRUE);
		if(MEMORY_LIMIT_ON && $dec=='m'){
			if(!isset($_mem[$end])) $_mem[$end]     =  memory_get_usage();
			return number_format(($_mem[$end]-$_mem[$start])/1024);
		}else{
			return number_format(($_info[$end]-$_info[$start]),$dec);
		}

	}else{ // 记录时间和内存使用
		$_info[$start]  =  microtime(TRUE);
		if(MEMORY_LIMIT_ON) $_mem[$start]           =  memory_get_usage();
	}
// 	print_r(array($_info,$_mem));
}


G('begin');
sleep(2);
G('end');

echo G('begin','end',6);
echo "-------";
echo G('begin','end','m');
