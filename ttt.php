<?php
class T{
	
	// 将对象转换为多维数组
	public static function ObjectToArray($object) {
		if (is_object($object))
			$object = get_object_vars($object);
		else if (is_array($object))
			return array_map(array(__CLASS__, __FUNCTION__), $object);
		return $object;
	}
	
	/**
	 * 数组key值风格转换
	 * type 0 将Java风格转换为C的风格， 1 将C风格转换为Java的风格
	 * @param array $result 需要转换的数组
	 * @param number $case 转换类型，默认小写
	 */
	public static function ArrayKeyToCase($result, $case=0) {
		$temp = array();
		foreach ( $result as $key => $item ) {
			if ( $case ) {
				$keyTemp = ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $key));
			} else {
				$keyTemp = strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $key), "_"));
			}
			$temp[$keyTemp] = $item;
			if ( is_array($item) ) {
				$temp[$keyTemp] = self::ArrayKeyToCase($item, $case);
			}
		}
		return $temp;
	}
}


$result =array
(
		'FinanceCommon_ResultCode' => 0,
		'paymentDetails' => array(
				array
				(
						'projectId'=> 19,
						'periodNum' => 0,
				)
		),
		'totalCount' => 0
);
// $result = array(array('getMasdF'=>'9',1=>array('dG'=>1),'getMasdN'=>'3','getMasdP'=>'4',));

// $t = T::ArrayKeyToCase($result);
// print_r($t);

$obj = new stdClass();
$obj->a = 10;
$obj->b = 11;
$obj->c->p = 12;
$obj->d = 13;
$obj->e->t = 22;

$a = T::ObjectToArray($obj);
print_r($a);
exit;
