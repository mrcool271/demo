<?php 
/**
 * array自带的一些常用函数
 * 包括：
 * 	1、array_merge() 的用法
 */


/**
 * array_merge() 的用法
 */
function test_array_merge(){
	$arr1 = array('a'=>array(101,array(1,3,5)),'b'=>array(103,104));
	$arr2 = array('c'=>array(201,202),'d'=>array(203,204));
	$arr3 = array('e'=>array(301,302),'0'=>array(303,304,305,array(123,456)),'g'=>array(307,308));
	$tmp= array_merge($arr1,$arr2,$arr3);
	// 	$tmp = array_merge($arr1);//如果只有一个数组并且key是数字类型,那么会将此key从０开始重新排
	printInfo($tmp);//使用print_r格式化输出
	// 	printInfo($tmp,1);//使用var_dump格式化输出
	// 	print_r( array_count_values(array(array(0,1,2,3,3,3,3,3))));//查看
}
// test_array_merge();	//打开注释看一下结果,结果是,把这三个数组里面的所有项a,b,c,d,e,0,g都取出来,换成一个大数组,而a-g的结构保持不变

