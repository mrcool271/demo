<?php
/**
 * 一些demo
 */

/**
 * 时间戳和微秒数的使用方法
 */
function eg_microtime(){
	$t1 = microtime();		//格式	0.69580900 1390037200 
	$t2 = microtime(TRUE);	//格式	1390037200.6958	快　PHP5以后才有的参数
	list($usec, $sec) = explode(" ", microtime());
	$t3 = ((float)$usec + (float)$sec);//格式	1390037200.6958	比$t2
	echo $t1;
	echo '<br>';
	echo $t2;
	echo '<br>';
	echo $t3; 
	exit;
}
// eg_microtime();

/**
 * TODO 路径相关的方法
 */
function eg_path(){
	echo __FILE__;				//输出	/Users/cui/Sites/git/demo/index.php
	echo '<br>';
	echo __DIR__;				//输出	/Users/cui/Sites/git/demo
	echo '<br>';
	echo dirname(__FILE__);		//输出	/Users/cui/Sites/git/demo
	echo '<br>';
	print_r(pathinfo(__DIR__.'/test.php'));	//输出	Array ( [dirname] => /Users/cui/Sites/git/demo [basename] => test.php [extension] => php [filename] => test ) 
	echo '<br>';
}
// eg_path();
	
// $path_parts = pathinfo(__DIR__.'/test.php');
// print_r($path_parts);

// print_r($_SERVER);
// phpinfo();




/**
 * array_merge() 的用法
 */
function eg_array_merge(){
	$arr1 = array('a'=>array(101,array(1,3,5)),'b'=>array(103,104));
	$arr2 = array('c'=>array(201,202),'d'=>array(203,204));
	$arr3 = array('e'=>array(301,302),'0'=>array(303,304,305,array(123,456)),'g'=>array(307,308));
	$tmp= array_merge($arr1,$arr2,$arr3);
// 	$tmp = array_merge($arr1);//如果只有一个数组并且key是数字类型,那么会将此key从０开始重新排
	printInfo($tmp);//使用print_r格式化输出
// 	printInfo($tmp,1);//使用var_dump格式化输出
// 	print_r( array_count_values(array(array(0,1,2,3,3,3,3,3))));//查看
}
// eg_array_merge();	//打开注释看一下结果,结果是,把这三个数组里面的所有项a,b,c,d,e,0,g都取出来,换成一个大数组,而a-g的结构保持不变


/**
 * 格式化输出数组结果
 * @param array  $arr 需要输出的数据
 * @param number $is_detail	是否显示详细的类型信息,即使用var_dump()输出
 * @version v0.1 注意:有的前台页面输出的时候,使用格式化<pre></pre>之后,数据不显示了.这时候去掉就会有显示.
 */
function printInfo($arr,$is_detail=0){
	echo '<pre>';
	if($is_detail){
		var_dump($arr);
	}else{
		print_r($arr);
	}
	echo '</pre>';
}


exit;


/**
 * ******************************　以下是性能测试相关的方法
 */

/**　测试mircotime(true) 的速度

function microtime_float3(){
return microtime(true);
}
function microtime_float2(){
if( PHP_VERSION > 5){
return microtime(true);
}else{
list($usec, $sec) = explode(" ", microtime());
return ((float)$usec + (float)$sec);
}
}
function microtime_float(){
list($usec, $sec) = explode(" ", microtime());
return ((float)$usec + (float)$sec);
}
function runtime($t1){
return number_format((microtime_float() - $t1)*1000, 4).'ms';
}
$t1 = microtime_float();
for($i=0;$i<10000;$i++){
microtime_float();
}
echo "microtime_float=====";
echo runtime($t1).'<br>';
$t1 = microtime(true);
for($i=0;$i<10000;$i++){
microtime(true);
}
echo "microtime_true=====";
echo runtime($t1).'<br>';
$t1 = microtime(true);
for($i=0;$i<10000;$i++){
microtime_float2();
}
echo "microtime_float2=====";
echo runtime($t1).'<br>';
$t1 = microtime(true);
for($i=0;$i<10000;$i++){
microtime_float3();
}
echo "microtime_float3=====";
echo runtime($t1).'<br>';
*/