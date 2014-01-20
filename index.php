<?php
/**
 * 一些demo
 */




/**
 * serialize() 序列化反序列化常用函数
 * serialize,json_encode,var_export，一般会用json_encode形式的。
 * TODO 好像使用的时候，是json_encode+base64待组合使用，去lib库里面研究一下。
 */
function eg_serialize(){
	//使用serialize,unserialize
	$a = array('a' => 'Apple' ,'b' => 'banana' , 'c' => 'Coconut');
	$aa = serialize($a);
	echo $aa;	//输出结果：a:3:{s:1:"a";s:5:"Apple";s:1:"b";s:6:"banana";s:1:"c";s:7:"Coconut";}
	echo '<br/>';
	printInfo(unserialize($aa));	//输出结果 Array ( [a] => Apple [b] => banana [c] => Coconut )
	echo '<br/>';
	
	//使用压缩+base64编码+压缩的serialize,unserialize
	$b = array('a'=>'test":"test','b'=>'tt":1"tt');		
	echo $bb = serialize($b);		//输出结果：a:2:{s:1:"a";s:11:"test":"test";s:1:"b";s:8:"tt":1"tt";}
	printInfo(unserialize($bb));	//输出$b
	//当数组值包含如双引号、单引号或冒号等字符时，它们被反序列化后，可能会出现问题。为了克服这个问题，一个巧妙的技巧是使用base64_encode和base64_decode,但是base64编码将增加字符串的长度。为了克服这个问题，可以和gzcompress一起使用。
	$bb = base64_encode(gzcompress(serialize($b)));		//输出结果：eJxLtDKyqi62MrRSSlSyBtJARklqcYkSlLIGSyWBaAugEFDcEERa1wIAwmEP1A==
	echo $bb;
	printInfo(unserialize(gzuncompress(base64_decode($bb))));	//输出结果:$b
	
	//使用json_encode,json_decode √√√
	//使用json_encode和json_decode格式输出要serialize和unserialize格式快得多,JSON格式是可读的,JSON格式比serialize返回数据结果小,JSON格式是开放的、可移植的。其他语言也可以使用它.
	$c = array('a' => 'Apple' ,'b' => 'banana' , 'c' => 'Coconut');
	echo $cc = json_encode($c);		//输出结果：{"a":"Apple","b":"banana","c":"Coconut"}
	echo '<br/>';
	printInfo(json_decode($cc));	//输出结果!!!：stdClass Object ( [a] => Apple [b] => banana [c] => Coconut ) array ( 'a' => 'Apple', 'b' => 'banana', 'c' => 'Coconut', )
	
	//使用var_export函数把变量作为一个字符串输出；eval把字符串当成PHP代码来执行,一般不这么用
	$a = array('a' => 'Apple' ,'b' => 'banana' , 'c' => 'Coconut');
	$s = var_export($a , true);	//序列化数组
	echo $s;	//输出结果： array ( 'a' => 'Apple', 'b' => 'banana', 'c' => 'Coconut', )
	echo '<br/>';
	eval('$my_var=' . $s . ';');	//反序列化
	print_r($my_var);
}
// eg_serialize();


/**
 * microtime(true) 时间戳和微秒数的使用方法
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
 * 路径相关的方法
 * TODO (未完待续)
 */
function eg_path(){
	echo __FILE__;				//输出	/Users/cui/Sites/git/demo/index.php
	echo '<br>';
	echo __DIR__;				//输出	/Users/cui/Sites/git/demo
	echo '<br>';
	echo dirname(__FILE__);		//输出	/Users/cui/Sites/git/demo
	echo '<br>';
	printInfo(pathinfo(__DIR__.'/test.php'));	//输出	Array ( [dirname] => /Users/cui/Sites/git/demo [basename] => test.php [extension] => php [filename] => test ) 
	echo '<br>';
	printInfo(pathinfo('abc.txt'));			//输出	Array ( [dirname] => . [basename] => abc.txt [extension] => txt [filename] => abc ) 
	echo '<br>';
	$path_parts = pathinfo('abc.a');;
	echo '/var/'.$path_parts['dirname']; 	//输出	/var/.
	
}
// eg_path();
	

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


/**
 * empty(),isset(),is_null()的实例测试
 */
function eg_empty_isset_is_null(){
	$a;
	$b = false;
	$c = '';
	$d = 0;
	$e = null;
	$f = array();

	//empty()				//	输出
	var_dump(empty($a));	//bool(true)
	var_dump(empty($b));	//bool(true)
	var_dump(empty($c));	//bool(true)
	var_dump(empty($d));	//bool(true)
	var_dump(empty($e));	//bool(true)
	var_dump(empty($f));	//bool(true)
	echo '<br>';
	//isset()
	var_dump(isset($a));	//bool(false)
	var_dump(isset($b));	//bool(true)
	var_dump(isset($c));	//bool(true)
	var_dump(isset($d));	//bool(true)
	var_dump(isset($e));	//bool(false)
	var_dump(isset($f));	//bool(true)
	echo '<br>';

	//is_null()
	var_dump(is_null($a));	//bool(true)
	var_dump(is_null($b));	//bool(false)
	var_dump(is_null($c));	//bool(false)
	var_dump(is_null($d));	//bool(false)
	var_dump(is_null($e));	//bool(true)
	var_dump(is_null($f));	//bool(false)
}
// eg_empty_isset_is_null();

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
 
// printInfo($_SERVER);

