<?php
/**
 *	随机数相关的方法
 *
 *	包括：	
 *	1、生成N个不重复的随机数
 */



/**
 * 1、生成N个不重复的随机数
 * $min 和 $max: 指定随机数的范围
 * $num: 指定生成数量
 * array unique_rand( int $min, int $max, int $num )
 */
function unique_rand($min, $max, $num) {
	$count = 0;
	$return = array();
	while ($count < $num) {
		$return[] = mt_rand($min, $max);
		$return = array_flip(array_flip($return));
		$count = count($return);
	}
	shuffle($return);	//把数组中的元素按随机顺序重新排列
	return $return;
}

$arr = unique_rand(1, 25, 16);
sort($arr);
echo implode(',', $arr);
exit;
/*
结果：2,3,4,6,7,8,9,10,11,12,13,16,20,21,22,24
方法说明:
	0、将随机数存入数组，再在数组中去除重复的值，即可生成一定数量的不重复随机数
	1、生成随机数时用了 mt_rand() 函数。这个函数生成随机数的平均速度要比 rand() 快四倍。
	2、去除数组中的重复值时用了“翻翻法”，就是用 array_flip() 把数组的 key 和 value 交换两次。这种做法比用 array_unique() 快得多。
	3、返回数组前，先使用 shuffle() 为数组赋予新的键名，保证键名是 0-n 连续的数字。如果不进行此步骤，可能在删除重复值时造成键名不连续，给遍历带来麻烦。
涉及函数说明：
	1、array_flip() 函数返回一个反转后的数组，如果同一值出现了多次，则最后一个键名将作为它的值，所有其他的键名都将丢失。如果原数组中的值的数据类型不是字符串或整数，函数将报错。
	2、implode() 函数把数组元素组合为一个字符串。
*/


