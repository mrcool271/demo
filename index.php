<?php
/**
 * 一些demo
 */

// var_dump(ctype_alnum('a123@1'));// false 校验字符or数字
// var_dump(ctype_digit('11'));//true
// exit;

phpinfo();
exit;


// echo strlen('k');//1
// echo chr(0xe6).chr(0x88).chr(0x91);//我
// exit;
// $str = '中';
// echo $a = strlen($str);//3
// var_dump($str[0]);
// echo ord("$str[1]");


// echo mb_internal_encoding();//PHP的内部编码ISO-8859-1
// echo mb_strlen('中文a字1符','UTF-8');//6
// echo mb_strlen('中文a字1符','GBK');//8
// echo mb_strlen('中文a字1符','GB2312');//10
// exit;



setcookie('1','2');
$currentCookieParams = session_get_cookie_params();
print_r($currentCookieParams);
exit;



$str = '123456';
// echo md5($str,true);
// echo md5(md5($str));
echo md5(md5($str,true));
exit;


$str = '<script>alert(1);</script>';
echo htmlspecialchars(strip_tags($str));
exit;


// phpinfo();
print_r( getenv('HTTP_X_FORWARDED_FOR'));
// print_r($_SERVER);
exit;

// echo md5('123456');exit;
echo md5(substr(hash('sha256', '123456'), 0, 40));
// echo (hash('sha256', 'The quick brazy dog.'));
exit;

// echo md5(uniqid(mt_rand(),true) . $_SERVER['REQUEST_TIME']. mt_rand());//获取唯一值




exit;


if(0 == 'a') {
	echo 999;exit;//√ 可以通过的，这是一个坑
}

echo 0==''?11:2;
// echo  in_array(0, array(1,'')) ? '1':'2';
exit;

phpinfo();
exit;

echo bcdiv('10','100',4);
exit;


$a = '0000-00-00 00:00:00';
echo strtotime($a);
exit;

$result = array('getParamPP'=>array('getMasdF'=>'1','getMasdM'=>array('dG'=>1),'getMasdN'=>'3','getMasdP'=>'4',));
$a = ArrayKeyToCase($result);
print_r($a);
/**
 * 数组key值风格转换
 * type 0 将Java风格转换为C的风格， 1 将C风格转换为Java的风格
 * @param array $result 需要转换的数组
 * @param number $case 转换类型，默认小写
 */
function ArrayKeyToCase($result, $case=0) {
	$temp = array();
	foreach ( $result as $key => $item ) {
		if ( $case ) {
			$keyTemp = ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $key));
		} else {
			$keyTemp = strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $key), "_"));
		}
		$temp[$keyTemp] = $item;
		if ( is_array($item) ) {
			$temp[$keyTemp] = ArrayKeyToCase($item, $case);
		}
	}
	return $temp;
}
exit;



list($microTime, $seconds) = explode(" ", microtime());
echo microtime(1);
echo microtime();
exit;

$a = 1406622733000;
echo date('Y-m-d H:i:s',substr($a, 0,-3));
exit;


echo $member_id = 140217150844012121111;
echo "--";
echo (int)$member_id;
echo gettype($member_id);
exit;

$number = 10001.22;
$rate1 = 100;
$rate2 = 1000;

testt($number, $rate1);
echo "------\n";
testt($number, $rate2);

function testt($number, $rate){
	$aa = $number * $rate;
	$aa = bcmul($number, $rate);
	var_dump($aa);
	$aa = intval($aa);
	var_dump($aa);
	$aa = bcdiv($aa, $rate, 2);
	var_dump($aa);
}

exit;

echo $aa = intval(10001.22*100);
echo '<br/>';
echo $aa / 100;
echo '<br/>';
echo $aa = intval(10001.22*1000);
echo '<br/>';
echo ($aa / 1000);
// 1000121
// 10001.21
// 10001220
// 10001.22
exit;

echo '{"totalCount":10,"items":[{"productList":[{"orderNo":"1597902717530001784","productId":"20140729110505","productCount":1,"productPrice":1,"storeId":null,"merchantId":null,"plazaId":null,"productInfo":"{\"appDetail\":\"http:\/\/www.126.com\",\"description\":\"Rush\u4ee3\u91d1\u52381\u63cf\u8ff0\",\"freeQuotaNum\":30,\"isNeedValidate\":0,\"limitPerMember\":0,\"limitPerOrder\":0,\"merchant\":{\"address\":\"\u91d1\u5730\u4e2d\u5fc325\u5c42B\u5ea7\u7b2c\u56db\u4f1a\u8bae\u5ba4\",\"merchantNo\":\"20140729110339\",\"name\":\"Rush\",\"telephone\":\"110\"},\"origPrice\":3,\"productNo\":\"20140729110505\",\"productType\":1001,\"remark\":[],\"saleEndTime\":1406822399000,\"salePrice\":\"0.01\",\"saleStartTime\":1406563200000,\"saleStatus\":2,\"soldNum\":0,\"stockNum\":8,\"subTitle\":\"Rush\u4ee3\u91d1\u52381\u526f\u6807\u9898\",\"title\":\"Rush\u4ee3\u91d1\u52381\",\"topPics\":[\"h00624b89663af85de8ebe72f9d60ca01bc\",\"h00a940c1ffc2418e739477abb266098da9\"],\"totalNum\":200,\"validEndTime\":1406822399000,\"validStartTime\":1406563200000,\"wapDetail\":\"http:\/\/www.126.com\",\"webDetail\":\"http:\/\/www.baidu.com\"}"}],"couponList":null,"presentCoupons":null,"createTime":1406622733000,"updateTime":1406623248000,"version":2,"orderNo":"1597902717530001784","deleteFlag":0,"orderCode":7008,"orderSrc":0,"memberId":"14072317074201224","orderAmt":1,"realPayAmt":1,"orderStatus":"PAY_SUCCESS","usePoint":0,"usePointDiscount":0,"returnPoint":0,"payOrderNo":"20140729163219001677","payTime":1406623248520,"parent":null,"remark":null,"usePointResult":false,"usePointMsg":null,"yazuoMemberId":0,"orderMarkVo":{"orderNo":"1597902717530001784","refundFlag":0,"payFlag":1,"usePointFlag":0,"useCouponFlag":0,"createTicketFlag":0,"applyRefundFlag":0,"auditRefundFailFlag":0,"auditRefundSuccessFlag":0,"payTimeoutFlag":0,"returnPointFlag":0},"orderPosExtVo":null},{"productList":[{"orderNo":"4628227039840001572","productId":"20140729110603","productCount":1,"productPrice":1,"storeId":null,"merchantId":null,"plazaId":null,"productInfo":"{\"appDetail\":\"www.wanhui.cn\",\"description\":\"Rush\u4ee3\u91d1\u52382\u63cf\u8ff0\",\"freeQuotaNum\":70,\"isNeedValidate\":0,\"limitPerMember\":0,\"limitPerOrder\":0,\"merchant\":{\"address\":\"\u91d1\u5730\u4e2d\u5fc325\u5c42B\u5ea7\u7b2c\u56db\u4f1a\u8bae\u5ba4\",\"merchantNo\":\"20140729110339\",\"name\":\"Rush\",\"telephone\":\"110\"},\"origPrice\":2,\"productNo\":\"20140729110603\",\"productType\":1001,\"remark\":[],\"saleEndTime\":1406822399000,\"salePrice\":\"0.01\",\"saleStartTime\":1406563200000,\"saleStatus\":2,\"soldNum\":0,\"stockNum\":10,\"subTitle\":\"Rush\u4ee3\u91d1\u52382\u526f\u6807\u9898\",\"title\":\"Rush\u4ee3\u91d1\u52382\",\"topPics\":[\"h006e0bbcdc1bc5521d0d946fedf81e8d3b\",\"h00e3c3fac4ff91a2948bb135b355cb6669\"],\"totalNum\":400,\"validEndTime\":1406822399000,\"validStartTime\":1406563200000,\"wapDetail\":\"www.wanhui.cn\",\"webDetail\":\"www.csdn.net\"}"}],"couponList":null,"presentCoupons":null,"createTime":1406616539000,"updateTime":1406616539000,"version":0,"orderNo":"4628227039840001572","deleteFlag":0,"orderCode":7008,"orderSrc":0,"memberId":"14072317074201224","orderAmt":1,"realPayAmt":1,"orderStatus":"INITIAL","usePoint":0,"usePointDiscount":0,"returnPoint":0,"payOrderNo":null,"payTime":null,"parent":null,"remark":null,"usePointResult":false,"usePointMsg":null,"yazuoMemberId":0,"orderMarkVo":{"orderNo":"4628227039840001572","refundFlag":0,"payFlag":0,"usePointFlag":0,"useCouponFlag":0,"createTicketFlag":0,"applyRefundFlag":0,"auditRefundFailFlag":0,"auditRefundSuccessFlag":0,"payTimeoutFlag":0,"returnPointFlag":0},"orderPosExtVo":null},{"productList":[{"orderNo":"0788607126170001392","productId":"20140729110505","productCount":1,"productPrice":1,"storeId":null,"merchantId":null,"plazaId":null,"productInfo":"{\"appDetail\":\"http:\/\/www.126.com\",\"description\":\"Rush\u4ee3\u91d1\u52381\u63cf\u8ff0\",\"freeQuotaNum\":30,\"isNeedValidate\":0,\"limitPerMember\":0,\"limitPerOrder\":0,\"merchant\":{\"address\":\"\u91d1\u5730\u4e2d\u5fc325\u5c42B\u5ea7\u7b2c\u56db\u4f1a\u8bae\u5ba4\",\"merchantNo\":\"20140729110339\",\"name\":\"Rush\",\"telephone\":\"110\"},\"origPrice\":3,\"productNo\":\"20140729110505\",\"productType\":1001,\"remark\":[],\"saleEndTime\":1406822399000,\"salePrice\":\"0.01\",\"saleStartTime\":1406563200000,\"saleStatus\":2,\"soldNum\":0,\"stockNum\":10,\"subTitle\":\"Rush\u4ee3\u91d1\u52381\u526f\u6807\u9898\",\"title\":\"Rush\u4ee3\u91d1\u52381\",\"topPics\":[\"h00624b89663af85de8ebe72f9d60ca01bc\",\"h00a940c1ffc2418e739477abb266098da9\"],\"totalNum\":200,\"validEndTime\":1406822399000,\"validStartTime\":1406563200000,\"wapDetail\":\"http:\/\/www.126.com\",\"webDetail\":\"http:\/\/www.baidu.com\"}"}],"couponList":null,"presentCoupons":null,"createTime":1406616174000,"updateTime":1406616301000,"version":2,"orderNo":"0788607126170001392","deleteFlag":0,"orderCode":7008,"orderSrc":0,"memberId":"14072317074201224","orderAmt":1,"realPayAmt":1,"orderStatus":"PAY_SUCCESS","usePoint":0,"usePointDiscount":0,"returnPoint":0,"payOrderNo":"20140729144258001815","payTime":1406616301473,"parent":null,"remark":null,"usePointResult":false,"usePointMsg":null,"yazuoMemberId":0,"orderMarkVo":{"orderNo":"0788607126170001392","refundFlag":0,"payFlag":1,"usePointFlag":0,"useCouponFlag":0,"createTicketFlag":0,"applyRefundFlag":0,"auditRefundFailFlag":0,"auditRefundSuccessFlag":0,"payTimeoutFlag":0,"returnPointFlag":0},"orderPosExtVo":null},{"productList":[{"orderNo":"4331736246280001921","productId":"20140724092906","productCount":1,"productPrice":100,"storeId":null,"merchantId":null,"plazaId":null,"productInfo":"{\"appDetail\":\"1\",\"description\":\"1\",\"freeQuotaNum\":0,\"isNeedValidate\":0,\"limitPerMember\":5,\"limitPerOrder\":5,\"merchant\":{\"address\":\"12\",\"merchantNo\":\"20140724092811\",\"name\":\"\u5546\u62372128\",\"telephone\":\"12\"},\"origPrice\":10000,\"productNo\":\"20140724092906\",\"productType\":1001,\"remark\":[],\"saleEndTime\":1406822399000,\"salePrice\":\"1\",\"saleStartTime\":1406131200000,\"saleStatus\":2,\"soldNum\":0,\"stockNum\":63,\"subTitle\":\"\u4e3b\u6807\u9898\",\"title\":\"\u4e3b\u6807\u98982129\",\"topPics\":[\"h00bb88ed174f62beacbc16e9ebe2f22d73\"],\"totalNum\":105,\"validEndTime\":1406822399000,\"validStartTime\":1406131200000,\"wapDetail\":\"1\",\"webDetail\":\"1\"}"}],"couponList":null,"presentCoupons":null,"createTime":1406537949000,"updateTime":1406537949000,"version":0,"orderNo":"4331736246280001921","deleteFlag":0,"orderCode":7008,"orderSrc":0,"memberId":"14072317074201224","orderAmt":100,"realPayAmt":100,"orderStatus":"INITIAL","usePoint":0,"usePointDiscount":0,"returnPoint":0,"payOrderNo":null,"payTime":null,"parent":null,"remark":null,"usePointResult":false,"usePointMsg":null,"yazuoMemberId":0,"orderMarkVo":{"orderNo":"4331736246280001921","refundFlag":0,"payFlag":0,"usePointFlag":0,"useCouponFlag":0,"createTicketFlag":0,"applyRefundFlag":0,"auditRefundFailFlag":0,"auditRefundSuccessFlag":0,"payTimeoutFlag":0,"returnPointFlag":0},"orderPosExtVo":null},{"productList":[{"orderNo":"2831226204250001946","productId":"20140724093137","productCount":1,"productPrice":100,"storeId":null,"merchantId":null,"plazaId":null,"productInfo":"{\"appDetail\":\"1\",\"description\":\"1\",\"freeQuotaNum\":5,\"isNeedValidate\":0,\"limitPerMember\":4,\"limitPerOrder\":3,\"merchant\":{},\"origPrice\":10000,\"productNo\":\"20140724093137\",\"productType\":2001,\"remark\":[{\"appDetail\":\"1\",\"packageProductNo\":\"20140724093137\",\"productNo\":\"20140724092906\",\"productNum\":3,\"productOrder\":1,\"productTitle\":\"\u4e3b\u6807\u98982129\",\"productType\":1001,\"validEndTime\":1406822399000,\"validStartTime\":1406208697000},{\"appDetail\":\"http:\/\/10.1.169.16:9711\/static\/detail.html\",\"packageProductNo\":\"20140724093137\",\"productNo\":\"20140724093025\",\"productNum\":5,\"productOrder\":2,\"productTitle\":\"\u6d4b\u8bd5\u56fd\u8d38\u5238\",\"productType\":1001,\"validEndTime\":1406822399000,\"validStartTime\":1406208697000}],\"saleEndTime\":1406822399000,\"salePrice\":\"1\",\"saleStartTime\":1406131200000,\"saleStatus\":2,\"soldNum\":0,\"stockNum\":4,\"subTitle\":\"1\",\"title\":\"\u5957\u99102133\",\"topPics\":[\"h00bb88ed174f62beacbc16e9ebe2f22d73\"],\"totalNum\":10,\"validEndTime\":1406208697000,\"validStartTime\":1406208697000,\"wapDetail\":\"1\",\"webDetail\":\"1\"}"}],"couponList":null,"presentCoupons":null,"createTime":1406535307000,"updateTime":1406536855000,"version":2,"orderNo":"2831226204250001946","deleteFlag":0,"orderCode":7008,"orderSrc":0,"memberId":"14072317074201224","orderAmt":100,"realPayAmt":100,"orderStatus":"PAY_SUCCESS","usePoint":0,"usePointDiscount":0,"returnPoint":0,"payOrderNo":"20140728162228001990","payTime":1406536855640,"parent":null,"remark":null,"usePointResult":false,"usePointMsg":null,"yazuoMemberId":0,"orderMarkVo":{"orderNo":"2831226204250001946","refundFlag":0,"payFlag":1,"usePointFlag":0,"useCouponFlag":0,"createTicketFlag":0,"applyRefundFlag":0,"auditRefundFailFlag":0,"auditRefundSuccessFlag":0,"payTimeoutFlag":0,"returnPointFlag":0},"orderPosExtVo":null},{"productList":[{"orderNo":"4628497338370001442","productId":"20140724093137","productCount":1,"productPrice":100,"storeId":null,"merchantId":null,"plazaId":null,"productInfo":"{\"appDetail\":\"1\",\"description\":\"1\",\"freeQuotaNum\":5,\"isNeedValidate\":0,\"limitPerMember\":4,\"limitPerOrder\":3,\"merchant\":{},\"origPrice\":10000,\"productNo\":\"20140724093137\",\"productType\":2001,\"remark\":[{\"appDetail\":\"1\",\"packageProductNo\":\"20140724093137\",\"productNo\":\"20140724092906\",\"productNum\":3,\"productOrder\":1,\"productTitle\":\"\u4e3b\u6807\u98982129\",\"productType\":1001,\"validEndTime\":1406822399000,\"validStartTime\":1406208697000},{\"appDetail\":\"http:\/\/10.1.169.16:9711\/static\/detail.html\",\"packageProductNo\":\"20140724093137\",\"productNo\":\"20140724093025\",\"productNum\":5,\"productOrder\":2,\"productTitle\":\"\u6d4b\u8bd5\u56fd\u8d38\u5238\",\"productType\":1001,\"validEndTime\":1406822399000,\"validStartTime\":1406208697000}],\"saleEndTime\":1406822399000,\"salePrice\":\"1\",\"saleStartTime\":1406131200000,\"saleStatus\":2,\"soldNum\":0,\"stockNum\":5,\"subTitle\":\"1\",\"title\":\"\u5957\u99102133\",\"topPics\":[\"h00bb88ed174f62beacbc16e9ebe2f22d73\"],\"totalNum\":10,\"validEndTime\":1406208697000,\"validStartTime\":1406208697000,\"wapDetail\":\"1\",\"webDetail\":\"1\"}"}],"couponList":null,"presentCoupons":null,"createTime":1406267010000,"updateTime":1406268815000,"version":1,"orderNo":"4628497338370001442","deleteFlag":0,"orderCode":7006,"orderSrc":0,"memberId":"14072317074201224","orderAmt":100,"realPayAmt":100,"orderStatus":"CLOSE","usePoint":0,"usePointDiscount":0,"returnPoint":0,"payOrderNo":null,"payTime":null,"parent":null,"remark":null,"usePointResult":false,"usePointMsg":null,"yazuoMemberId":0,"orderMarkVo":{"orderNo":"4628497338370001442","refundFlag":0,"payFlag":0,"usePointFlag":0,"useCouponFlag":0,"createTicketFlag":0,"applyRefundFlag":0,"auditRefundFailFlag":0,"auditRefundSuccessFlag":0,"payTimeoutFlag":0,"returnPointFlag":0},"orderPosExtVo":null}]}';
exit;

$a = array(array(1,2,3),array(4,5,6));
$b = array(array(11,22,33),array(44,55,66));
$a = array_merge($a,$b);
print_r($a);
exit;

//驼峰格式转换
$name = ab_cdddd;
echo  lcfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));
echo  ucfirst(preg_replace("/_([a-zA-Z])/e", "strtoupper('\\1')", $name));

exit;


$a = array(1,2,3,4);
$b = array(3,4,6);
//array_push($a, $b);
$c = array_merge($a,$b);
print_r($c);
exit;


$a = array('a'=>array(1,'b'=>array(7,'e'=>89),3),'c'=>array('d'=>4,5,6));
print_r(json_decode(json_encode($a)));
exit;


var_dump(file_put_contents("tmp.txt","Hello World. Testing!"));//注意权限
exit;

echo date('Y-m-d h:i:s', time());
exit;

//格式化数字
$t = 0.0001;
echo round($t,2);//0
echo sprintf('%.2f',round($t,2));//0.00
exit;

//二维数组中每一个里面求交集
$str1 = '74,75,76,77,78,79,80,81,82,83,84,85,86';
$str2 = '74,75,76,77,83,84,85,86';

$tmpStr[] = explode(',', $str1);
$tmpStr[] = explode(',', $str2);

$result = array();
foreach ($tmpStr as $val) {
	$in = array_intersect($result, $val);
	if($in){
		echo 11;
	}
	$result = array_merge($result,$val);
	print_r($result);
}

print_r($tmpStr);
exit;


$str = '[{"city":"73,2","maxfreight":"1","issue":"11"},{"city":"74,75,76,77,78,79,80,81,82,83,84,85,86","maxfreight":"2","issue":"22"}]';
$tmp = json_decode($str,true);
print_r($tmp);
exit;

/**
 * 如果类中没有方法或权限不是public的话，会默认的调用魔末方法__call(String $method,Array $arguments){}
 */
class MethodTest {
	/**
	 * @param string $name
	 * @param array $arguments
	 */
	public function __call($name, $arguments) {
		print_r($arguments);//Array ( [0] => test )
	}
	
	protected function runTest() { 
		echo '111';
	}
}

$obj = new MethodTest;
$obj->runTest('test');
exit;


$str = 'abc';
print_r((array)$str);//Array ( [0] => abc )
exit;



//敏感词放入缓存中
//算法：把敏感词首字放入数组中，校验时如果首字在在根据首字数组中的值找下一个。
// $arr = array(array('mask_word'=>'测试','mask_type'=>'1'),array('mask_word'=>'评论人民','mask_type'=>'1'),array('mask_word'=>'是','mask_type'=>'1'));//Array ( [0] => Array ( [27979] => 1 [35780] => 2 [26159] => -2 ) [1] => Array ( [35797] => -2 ) [2] => Array ( [35770] => 3 ) [3] => Array ( [20154] => 4 ) [4] => Array ( [27665] => -2 ) )
/**输出为
 * Array
(
    [0] => Array（首字）
        (
            [27979] => 1 （下一个字的位置的key）
            [35780] => 2
            [26159] => -2
        )

    [1] => Array
        (
            [35797] => -2
        )

    [2] => Array
        (
            [35770] => 3
        )

    [3] => Array
        (
            [20154] => 4
        )

    [4] => Array
        (
            [27665] => -2（结束）
        )

)

 */
$arr = array(array('mask_word'=>'abc','mask_type'=>'1'),array('mask_word'=>'acd','mask_type'=>'5'),array('mask_word'=>'abcde','mask_type'=>'1'));//Array ( [0] => Array ( [97] => 1 ) [1] => Array ( [98] => 2 [99] => 3 ) [2] => Array ( [99] => -2 ) [3] => Array ( [100] => -6 ) )
/**输出为
 * Array
(
    [0] => Array
        (
            [97] => 1
        )

    [1] => Array
        (
            [98] => 2
            [99] => 3
        )

    [2] => Array
        (
            [99] => -2
        )

    [3] => Array
        (
            [100] => -6
        )

)

 */
print_r( serialization($arr));
exit;

function serialization($wordsInfo) {
	$serialTable = array();
	$status_num = 0;
	foreach ($wordsInfo as $word) {
		$ptr = 0; //当前状态指针
		$word['mask_word'] = trim($word['mask_word']);
		$word['mask_word'] = strtolower($word['mask_word']);
		$length = strlen($word['mask_word']);
		for ($i = 0; $i < $length; ++$i) {
			if ((ord($word['mask_word']{$i}) & 0xf0) == 224) { //232 & 240 即 1110 1000 & 1111 0000 结果为 1110 0000 十进制为224，代表是中文？
				//a chinese char contains 3 * 8bit
				$sword = $word['mask_word']{$i} . $word['mask_word']{$i+1} . $word['mask_word']{$i+2};
				echo $hash_num = hashChar($sword);
				echo '<br>';
				$i += 2;
			}
			else {
				//a normal char contains 1 * 8bit
				$hash_num = hashChar($word['mask_word']{$i});
			}
			if (empty($serialTable[$ptr][$hash_num])) {
				//a new char has not exist in the hashtable
				if ($i < $length - 1) {
					//the 1st or 2nd char in a chinese word
					++$status_num;
					$serialTable[$ptr][$hash_num] = $status_num;
					$ptr = $status_num;
				}
				else {
					//a normal char or the 3rd char in a chinese word
					$serialTable[$ptr][$hash_num] = -1 - intval($word['mask_type']);
				}
			}
			elseif ($serialTable[$ptr][$hash_num] < 0) {
				//TODO now, the 'abcd' is not work is exist 'abc';
				$preType = -1 - $serialTable[$ptr][$hash_num];
				if (intval($word['mask_type']) > $preType) {
					if ($i == $length - 1) {
						$serialTable[$ptr][$hash_num] = -1 - intval($word['mask_type']);
					}
				}
				break;
			}
			else {
				$ptr = $serialTable[$ptr][$hash_num];
			}
		}
	}
	return $serialTable;
}

//hash the character
function hashChar($word) {
	switch(strlen($word)) {
		case 1:  //this is non-chinese character, just return the ascii code
			return ord($word);
			break;
		case 3:  //if chinese character, the hash = ((first bit)-224)*64*64+((second bit)-128)*64+(third bit)
			$ret = ((ord($word{0}) & 0x1f) << 12) + ((ord($word{1}) & 0x7f) << 6) + (ord($word{2}) & 0x7f);
			return $ret;
	}
}

exit;

// echo base_convert(240, 10, 2);//进制转换
// echo ord('谁');
// echo chr(0xE6).chr(0x88).chr(0x91);
// echo dechex(230);

// (ord($word['mask_word']{$i}) & 0xf0) 
// exit;

//echo microtime();
// ECHO 1403796355 / 86400;
// ECHO 1403796355 - 1262275200;
// echo date('Ymd',1000000000);
// echo 1000000000/(365*86400);

// echo sprintf("%03d", 8);//008

// echo 5 & 6;//4
// echo 2 & 2;//2
// echo ord('中');
// echo 0xf0;


// echo ord('我');
// echo chr(0xE6).chr(0x88).chr(0x91);
// echo dechex(230);

$a = '我';
echo $a[0];
echo ord($a{0});
// echo ord($a[0]);
// echo dechex(ord($a[2]));
exit;



//位运算 简单的权限控制等应用
$a = 1 << 0;
$b = 1 << 1;
$c = 1 << 2;

echo $d = $a | $c ;
echo $d & $b;//0
exit;


print_r(getTimeStamp());
function getTimeStamp()
{
	list($microTime, $seconds) = explode(" ", microtime());
	echo  $microTime = intval($microTime * 1000000);

	$timeStamp = array (
			0 => $seconds,
			1 => substr($microTime, 0, 3),
			2 => substr($microTime, 3, 3),
	);
	return $timeStamp;
}
exit;


//取差集注意
$array1 = array('aaa'=>'0','status'=>'0');
$array2 = array('aaa'=>'0','status'=>'1');

$result = array_diff($array1, $array2);//不比较键名,只比较值
print_r($result);//Array ( )
$result2 = array_diff_assoc($array1, $array2);//比较键名
print_r($result2);//Array ( [status] => 0 )

//array_diff_assoc() 函数返回两个数组的差集数组。该数组包括了所有在被比较的数组中，但是不在任何其他参数数组中的键和值。
//和 array_diff() 函数 不同，本函数要求键名和键值都进行比较。返回的数组中键名保持不变。 
exit;


$firstArray = array('aaa'=>'2','status1'=>'2');
$secondArray = array('aaa'=>'2','status'=>'2');
$tmp = array_flip($secondArray);//Array ( [2] => status )，相当于去重了
print_r($tmp);
$result = array_diff_fast($firstArray, $secondArray);

print_r($result);//Array ( )
//array_diff()函数在处理大数组时的效率不高
function array_diff_fast($firstArray, $secondArray) {
	// 转换第二个数组的键值关系
	$secondArray = array_flip($secondArray);
	// 循环第一个数组
	foreach($firstArray as $key => $value) {
		// 如果第二个数组中存在第一个数组的值
		if (isset($secondArray[$value])) {
			// 移除第一个数组中对应的元素
			unset($firstArray[$key]);
		}
	}
	return $firstArray;
}
//注意：PHP 内置的 array_diff() 函数可以处理多个数组，而本文提供的方法只处理了两个数组的比较。




print_r($_SERVER);
exit;

/** 

//敏感词放入缓存中
$arr = array(array('mask_word'=>'测试','mask_type'=>'1'),array('mask_word'=>'评论人','mask_type'=>'1'));
print_r( serialization($arr));
exit;

function serialization($wordsInfo) {
	$serialTable = array();
	$status_num = 0;
	foreach ($wordsInfo as $word) {
		$ptr = 0; //当前状态指针
		$word['mask_word'] = trim($word['mask_word']);
		$word['mask_word'] = strtolower($word['mask_word']);
		$length = strlen($word['mask_word']);
		for ($i = 0; $i < $length; ++$i) {
			if ((ord($word['mask_word']{$i}) & 0xf0) == 224) { //232 & 240 即 1110 1000 & 1111 0000 结果为 1110 0000 十进制为224，代表是中文？   
				//a chinese char contains 3 * 8bit
				$sword = $word['mask_word']{$i} . $word['mask_word']{$i+1} . $word['mask_word']{$i+2};
				echo $hash_num = hashChar($sword);
				$i += 2;
			}
			else {
				//a normal char contains 1 * 8bit
				$hash_num = hashChar($word['mask_word']{$i});
			}
			if (empty($serialTable[$ptr][$hash_num])) {
				//a new char has not exist in the hashtable
				if ($i < $length - 1) {
					//the 1st or 2nd char in a chinese word
					++$status_num;
					$serialTable[$ptr][$hash_num] = $status_num;
					$ptr = $status_num;
				}
				else {
					//a normal char or the 3rd char in a chinese word
					$serialTable[$ptr][$hash_num] = -1 - intval($word['mask_type']);
				}
			}
			elseif ($serialTable[$ptr][$hash_num] < 0) {
				//TODO now, the 'abcd' is not work is exist 'abc';
				$preType = -1 - $serialTable[$ptr][$hash_num];
				if (intval($word['mask_type']) > $preType) {
					if ($i == $length - 1) {
						$serialTable[$ptr][$hash_num] = -1 - intval($word['mask_type']);
					}
				}
				break;
			}
			else {
				$ptr = $serialTable[$ptr][$hash_num];
			}
		}
	}
	return $serialTable;
}

//hash the character
function hashChar($word) {
	switch(strlen($word)) {
		case 1:  //this is non-chinese character, just return the ascii code
			return ord($word);
			break;
		case 3:  //if chinese character, the hash = ((first bit)-224)*64*64+((second bit)-128)*64+(third bit)
			$ret = ((ord($word{0}) & 0x1f) << 12) + ((ord($word{1}) & 0x7f) << 6) + (ord($word{2}) & 0x7f);
			return $ret;
	}
}

exit;
*/


/**
 * PHP实例——字符串分割（完美支持中英文，兼容mb_substr）
 +----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function msubstr($str, $start, $length, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr")){
		$slice = mb_substr($str, $start, $length, $charset);
	}elseif(function_exists('iconv_substr')) {
		$slice = iconv_substr($str,$start,$length,$charset);
		if(false === $slice) {
			$slice = '';
		}
	}else{
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice.'...' : $slice;
}

exit;


 
$str = '';
if(isset($str)) {
	echo 1;
}
if(empty($str)) {
	echo 2;
}
exit;


//1. 获取所有可用的模块 - get_loaded_extensions 该函数返回所有已经加载的（可用的）模块。 
// print_r(get_loaded_extensions());

$arr = get_defined_functions();
print_r($arr);
exit;

 $arr = array(
 	array(1,2,3),array(4,5,6)
 );
 print_r(current($arr));
 exit;
 
 

printInfo($_SERVER);exit;


/**
 * base64编码（网络传统文本图片音频啥的）
 */
$str = "http://www.baidu.com?a= 1&''/*";
$tmp = base64_encode($str);
echo $tmp;
echo base64_decode($tmp);
exit;



/**
 * 转码
 */
$str = file_get_contents('/Users/cui/cui.out');
// $xml = array('a'=>12,'b'=>3);
// $str = '{"track":{"billcode":"768362251981","detail":[{"time":"2014\/04\/04 15:05:47","scantype":"\u7b7e\u6536","memo":"\u5df2\u7b7e\u6536,\u7b7e\u6536\u4eba\u662f\u5df2\u7b7e\u6536"}]}}';
// echo $str;exit;
// $str = iconv('gb2312', 'utf-8', $str);
// if (function_exists("mb_convert_encoding")) {
// 	$str = mb_convert_encoding($str,'utf-8','gb2312');
// } elseif(function_exists("iconv")) {
// 	$str = iconv('gb2312','utf-8',$str);
// } else die("sorry, you have no libs support for charset changes.");
// echo $str;
// exit;
$str = str_replace('gb2312', 'utf-8', $str);
$str = mb_convert_encoding($str,'utf-8','gb2312');
echo $str;exit;
$xml = simplexml_load_string($str);
// print_r($xml);
$newExpress = json_decode(json_encode($xml),1);
echo  json_encode($xml);
printInfo($newExpress);
exit;




$json = '{"time":{"areaName":"","time":"1970-01-01 08:00:00","ftime":"1970-01-01 08:00:00","status":"2","context":"2"},"scantype":{"areaName":"","time":"1970-01-01 08:00:00","ftime":"1970-01-01 08:00:00","status":null,"context":null},"memo":{"areaName":"","time":"1970-01-01 08:00:00","ftime":"1970-01-01 08:00:00","status":null,"context":null}}';
// printInfo(array_values(json_decode($json,1)));
printInfo(json_decode($json,1));
exit;


//报名初复审结束时间
$first_review_end_day = '2014-01-01';
$first_review_end_hour =  0;
$second_review_end_day = '2015-01-01';
$second_review_end_hour =  0;
$first_review_end_time = strtotime($first_review_end_day.' '.'2:00:00');
$second_review_end_time = strtotime("{$second_review_end_day} {$second_review_end_hour}");

$re = array('succ'=>0,'msg'=>$first_review_end_time);
echo json_encode($re);
exit;

echo strtotime("2014-05-21");
exit;

$t = '{"start":"2014-05-11 15:50","end":"2014-05-31 23:50"}';
$time = json_decode($t,TRUE);
if( isset($time['start']) && isset($time['end']) && time()>strtotime($time['start']) && time()<strtotime($time['end']) ){
	echo time();
}


exit;

// $json = '[{"areaName":"","time":"2014-03-31 23:39:36","ftime":"2014-03-31 23:39:36","status":"\u6536\u4ef6","context":"\u5e7f\u4e1c\u5e7f\u5dde\u4e1c\u5ddd\u70b9 \u7684\u6536\u4ef6\u5458 \u7f57\u6c49\u4f19\u5df2\u6536\u4ef6"},{"areaName":"","time":"2014-04-01 00:27:07","ftime":"2014-04-01 00:27:07","status":"\u6536\u4ef6","context":"\u5e7f\u4e1c\u5e7f\u5dde\u4e1c\u5ddd\u70b9 \u7684\u6536\u4ef6\u5458 \u7f57\u6c49\u4f19\u5df2\u6536\u4ef6"},{"areaName":"","time":"2014-04-01 05:12:06","ftime":"2014-04-01 05:12:06","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u5e7f\u4e1c\u5e7f\u5dde\u4e2d\u8f6c\u90e8"},{"areaName":"","time":"2014-04-01 05:43:23","ftime":"2014-04-01 05:43:23","status":"\u53d1\u4ef6","context":"\u7531\u5e7f\u4e1c\u5e7f\u5dde\u516c\u53f8 \u53d1\u5f80 \u5317\u4eac\u4e2d\u8f6c\u90e8"},{"areaName":"","time":"2014-04-01 05:43:23","ftime":"2014-04-01 05:43:23","status":"\u88c5\u888b","context":"\u5e7f\u4e1c\u5e7f\u5dde\u516c\u53f8 \u6b63\u5728\u8fdb\u884c \u88c5\u888b \u626b\u63cf"},{"areaName":"","time":"2014-04-01 05:52:05","ftime":"2014-04-01 05:52:05","status":"\u53d1\u4ef6","context":"\u7531\u5e7f\u4e1c\u5e7f\u5dde\u516c\u53f8 \u53d1\u5f80 \u5e7f\u5dde\u673a\u573a\u5317"},{"areaName":"","time":"2014-04-02 12:06:22","ftime":"2014-04-02 12:06:22","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u5317\u4eac\u4e2d\u8f6c\u90e8"},{"areaName":"","time":"2014-04-02 12:07:26","ftime":"2014-04-02 12:07:26","status":"\u88c5\u888b","context":"\u5317\u4eac\u4e2d\u8f6c\u90e8 \u6b63\u5728\u8fdb\u884c \u88c5\u888b \u626b\u63cf"},{"areaName":"","time":"2014-04-02 12:07:26","ftime":"2014-04-02 12:07:26","status":"\u53d1\u4ef6","context":"\u7531\u5317\u4eac\u4e2d\u8f6c\u90e8 \u53d1\u5f80 \u5185\u8499\u53e4\u9102\u5c14\u591a\u65af\u516c\u53f8"},{"areaName":"","time":"2014-04-03 00:20:08","ftime":"2014-04-03 00:20:08","status":"\u53d1\u4ef6","context":"\u7531\u5317\u4eac\u4e2d\u8f6c\u90e8 \u53d1\u5f80 \u5185\u8499\u53e4\u9102\u5c14\u591a\u65af\u516c\u53f8"},{"areaName":"","time":"2014-04-03 21:35:28","ftime":"2014-04-03 21:35:28","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u5185\u8499\u53e4\u9102\u5c14\u591a\u65af\u516c\u53f8"},{"areaName":"","time":"2014-04-03 21:36:15","ftime":"2014-04-03 21:36:15","status":"\u6d3e\u4ef6","context":"\u5185\u8499\u53e4\u9102\u5c14\u591a\u65af\u516c\u53f8 \u7684\u6d3e\u4ef6\u5458 \u8d2d\u7269\u4e2d\u5fc3\u5206\u90e8 \u6b63\u5728\u6d3e\u4ef6"},{"areaName":"","time":"2014-04-03 22:24:58","ftime":"2014-04-03 22:24:58","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u5185\u8499\u53e4\u9102\u5c14\u591a\u65af\u516c\u53f8"},{"areaName":"","time":"2014-04-04 12:40:17","ftime":"2014-04-04 12:40:17","status":"\u6d3e\u4ef6","context":"\u5185\u8499\u53e4\u9102\u5c14\u591a\u65af\u516c\u53f8 \u7684\u6d3e\u4ef6\u5458 \u8d2d\u7269\u4e2d\u5fc304 \u6b63\u5728\u6d3e\u4ef6"},{"areaName":"","time":"2014-04-04 15:05:47","ftime":"2014-04-04 15:05:47","status":"\u7b7e\u6536","context":"\u5df2\u7b7e\u6536,\u7b7e\u6536\u4eba\u662f\u5df2\u7b7e\u6536"}]';
// $json = '[{"areaName":"","time":"2014-05-10 20:09:38","ftime":"2014-05-10 20:09:38","status":"\u6536\u4ef6","context":"\u5e7f\u4e1c\u82b1\u90fd\u65b0\u534e \u7684\u6536\u4ef6\u5458 \u90ed\u4f1f\u4fca\u5df2\u6536\u4ef6"},{"areaName":"","time":"2014-05-10 20:10:16","ftime":"2014-05-10 20:10:16","status":"\u53d1\u4ef6","context":"\u7531\u5e7f\u4e1c\u82b1\u90fd\u65b0\u534e \u53d1\u5f80 \u5e7f\u4e1c\u5e7f\u5dde\u4e2d\u8f6c\u90e8"},{"areaName":"","time":"2014-05-10 22:07:08","ftime":"2014-05-10 22:07:08","status":"\u88c5\u888b","context":"\u5e7f\u4e1c\u82b1\u90fd\u65b0\u534e \u6b63\u5728\u8fdb\u884c \u88c5\u888b \u626b\u63cf"},{"areaName":"","time":"2014-05-10 22:07:08","ftime":"2014-05-10 22:07:08","status":"\u53d1\u4ef6","context":"\u7531\u5e7f\u4e1c\u82b1\u90fd\u65b0\u534e \u53d1\u5f80 \u5e7f\u4e1c\u5e7f\u5dde\u4e2d\u8f6c\u90e8"},{"areaName":"","time":"2014-05-10 23:55:45","ftime":"2014-05-10 23:55:45","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u5e7f\u4e1c\u5e7f\u5dde\u516c\u53f8"},{"areaName":"","time":"2014-05-11 01:26:47","ftime":"2014-05-11 01:26:47","status":"\u53d1\u4ef6","context":"\u7531\u5e7f\u4e1c\u5e7f\u5dde\u516c\u53f8 \u53d1\u5f80 \u6c5f\u82cf\u5357\u4eac\u4e2d\u8f6c\u90e8"},{"areaName":"","time":"2014-05-12 02:17:47","ftime":"2014-05-12 02:17:47","status":"\u53d1\u4ef6","context":"\u7531\u6c5f\u82cf\u5357\u4eac\u4e2d\u8f6c\u90e8 \u53d1\u5f80 \u6c5f\u82cf\u5357\u4eac\u516c\u53f8"},{"areaName":"","time":"2014-05-12 02:27:21","ftime":"2014-05-12 02:27:21","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u6c5f\u82cf\u5357\u4eac\u516c\u53f8"},{"areaName":"","time":"2014-05-12 02:40:13","ftime":"2014-05-12 02:40:13","status":"\u6d3e\u4ef6","context":"\u6c5f\u82cf\u5357\u4eac\u516c\u53f8 \u7684\u6d3e\u4ef6\u5458 \u6c64\u6d77\u6d0b \u6b63\u5728\u6d3e\u4ef6"},{"areaName":"","time":"2014-05-12 07:32:58","ftime":"2014-05-12 07:32:58","status":"\u5230\u4ef6","context":"\u5feb\u4ef6\u5df2\u5230\u8fbe\u6c5f\u82cf\u5357\u4eac\u516c\u53f8"},{"areaName":"","time":"2014-05-12 08:10:13","ftime":"2014-05-12 08:10:13","status":"\u6d3e\u4ef6","context":"\u6c5f\u82cf\u5357\u4eac\u516c\u53f8 \u7684\u6d3e\u4ef6\u5458 \u6c64\u6d77\u6d0b\u516b \u6b63\u5728\u6d3e\u4ef6"},{"areaName":"","time":"2014-05-12 12:42:31","ftime":"2014-05-12 12:42:31","status":"\u7b7e\u6536","context":"\u5df2\u7b7e\u6536,\u7b7e\u6536\u4eba\u662f\u5df2\u7b7e\u6536"}]';
// $json = '{"a":{"button":"\u6652\u5355\u9886\u5238","url":"http:\/\/www.meilishuo.com\/club\/single\/554393?frm=shaidan_shuoming","pop":"\u7acb\u5373\u53bb\u6652\u5355\uff0c\u5c31\u6709\u673a\u4f1a\u83b7\u5f975\u5143\u4f18\u60e0\u5238\uff0c\u5feb\u6765\u6652\u5355\uff01"}}';
// $json = '{"code":0,"info":[{"order":{"id":3976087,"order_id":140512172247,"status":4,"status_text":"\u4ea4\u6613\u6210\u529f","words":"","step":1,"total_price":"0.00","order_price":"0.01","goods_price":"0.01","ctime":"2014-05-12 15:34","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"2014-05-12 15:34","send_time":"","receive_time":"","last_status_time":"","pay_time_out":"2014-05-13 15:34","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":1,"opt":[{"type":3,"text":"\u8bc4\u8bba"}],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4400628,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/img-tx.meilishuo.net\/pic\/u\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","b_pic_url":"http:\/\/imgtest.meiliworks.com\/pic\/b\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"36","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":1,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974885,"order_id":140331400933,"status":2,"status_text":"\u7b49\u5f85\u786e\u8ba4\u6536\u8d27","words":"","step":0,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-31 16:17","shop_id":"101277","seller_uid":"2740189","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u4e13\u9500\u7f8e\u8863","phone":"13240733798","qq":"1000000","im":{"qq":"1000000","type":3,"shop_id":"101277"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-31 16:17","pay_time_out":"2014-04-01 16:17","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[{"type":2,"text":"\u786e\u8ba4\u6536\u8d27"}],"coupon_msg":"","receive_allow_weixin":1},"goods":[{"mid":4399351,"twitter_id":2475537685,"goods_id":89853295,"price":"0.01","amount":1,"goods_title":"\u6d4b\u8bd5\u5546\u54c1\u65e0\u5fe7\u591f\u5b9d\u8d1d\uff0c\u4e0d\u9000\u4e0d\u6362\u614e\u62cd","goods_img":"http:\/\/imgst-dl.meilishuo.net\/pic\/u\/fd\/91\/df0353f3616b053b663f9e60dea2_798_925.c6.jpg","b_pic_url":"http:\/\/imgtest-dl.meiliworks.com\/pic\/b\/fd\/91\/df0353f3616b053b663f9e60dea2_798_925.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":2,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":1}]},{"order":{"id":3974884,"order_id":140331467745,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-31 16:17","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-31 16:18","pay_time_out":"2014-04-01 16:17","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399350,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/img-tx.meilishuo.net\/pic\/u\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","b_pic_url":"http:\/\/imgtest.meiliworks.com\/pic\/b\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"35","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974883,"order_id":140331508845,"status":1,"status_text":"\u7b49\u5f85\u53d1\u8d27","words":"","step":1,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-31 16:12","shop_id":"101277","seller_uid":"2740189","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u4e13\u9500\u7f8e\u8863","phone":"13240733798","qq":"1000000","im":{"qq":"1000000","type":3,"shop_id":"101277"},"pay_time":"2014-03-31 16:13","send_time":"","receive_time":"","last_status_time":"","pay_time_out":"2014-04-01 16:12","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399349,"twitter_id":2475537685,"goods_id":89853295,"price":"0.01","amount":1,"goods_title":"\u6d4b\u8bd5\u5546\u54c1\u65e0\u5fe7\u591f\u5b9d\u8d1d\uff0c\u4e0d\u9000\u4e0d\u6362\u614e\u62cd","goods_img":"http:\/\/imgst-dl.meilishuo.net\/pic\/u\/fd\/91\/df0353f3616b053b663f9e60dea2_798_925.c6.jpg","b_pic_url":"http:\/\/imgtest-dl.meiliworks.com\/pic\/b\/fd\/91\/df0353f3616b053b663f9e60dea2_798_925.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":1,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974882,"order_id":140331699961,"status":1,"status_text":"\u7b49\u5f85\u53d1\u8d27","words":"","step":1,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-31 16:12","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"2014-03-31 16:13","send_time":"","receive_time":"","last_status_time":"","pay_time_out":"2014-04-01 16:12","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399348,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/img-tx.meilishuo.net\/pic\/u\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","b_pic_url":"http:\/\/imgtest.meiliworks.com\/pic\/b\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"37","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":1,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974881,"order_id":140331507299,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-31 16:06","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-31 16:08","pay_time_out":"2014-04-01 16:06","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399347,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/imgst-dl.meilishuo.net\/pic\/u\/55\/00\/b75af81b8ac5ef1b42f65af862ca_432_572.c6.jpg","b_pic_url":"http:\/\/imgst-dl.meilishuo.net\/pic\/b\/55\/00\/b75af81b8ac5ef1b42f65af862ca_432_572.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u7ea2\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"35","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974785,"order_id":140324457513,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"0.02","order_price":"0.02","goods_price":"0.02","ctime":"2014-03-24 17:59","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-24 17:59","pay_time_out":"2014-03-25 17:59","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399204,"twitter_id":2158059851,"goods_id":77626967,"price":"0.02","amount":1,"goods_title":"\u6d4b\u8bd5\u5b9d\u8d1d\uff0c\u62cd\u4e0b\u4e0d\u9000\u6b3e\uff0c\u4e0d\u53d1\u8d27\u54e6~","goods_img":"http:\/\/imgtest.meiliworks.com\/pic\/u\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","b_pic_url":"http:\/\/imgtest-lx.meilishuo.net\/pic\/b\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ec4\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974784,"order_id":140324611361,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"0.02","order_price":"0.02","goods_price":"0.02","ctime":"2014-03-24 17:08","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-24 17:09","pay_time_out":"2014-03-25 17:08","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399203,"twitter_id":2158059851,"goods_id":77626967,"price":"0.02","amount":1,"goods_title":"\u6d4b\u8bd5\u5b9d\u8d1d\uff0c\u62cd\u4e0b\u4e0d\u9000\u6b3e\uff0c\u4e0d\u53d1\u8d27\u54e6~","goods_img":"http:\/\/imgtest.meiliworks.com\/pic\/u\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","b_pic_url":"http:\/\/imgtest-lx.meilishuo.net\/pic\/b\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ec4\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974783,"order_id":140324733927,"status":2,"status_text":"\u7b49\u5f85\u786e\u8ba4\u6536\u8d27","words":"","step":2,"total_price":"0.01","order_price":"0.02","goods_price":"0.02","ctime":"2014-03-24 16:59","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"762364745988","express_company":"\u4e2d\u901a\u5feb\u9012","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"2014-03-24 17:00","send_time":"2014-03-25 19:23","receive_time":"","last_status_time":"2014-03-24 16:59","pay_time_out":"2014-03-25 16:59","receive_time_out":"2014-04-04 19:23","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[{"type":2,"text":"\u786e\u8ba4\u6536\u8d27"}],"coupon_msg":"","receive_allow_weixin":1},"goods":[{"mid":4399202,"twitter_id":2158059851,"goods_id":77626967,"price":"0.02","amount":1,"goods_title":"\u6d4b\u8bd5\u5b9d\u8d1d\uff0c\u62cd\u4e0b\u4e0d\u9000\u6b3e\uff0c\u4e0d\u53d1\u8d27\u54e6~","goods_img":"http:\/\/imgtest.meiliworks.com\/pic\/u\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","b_pic_url":"http:\/\/imgtest-lx.meilishuo.net\/pic\/b\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ec4\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":2,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":1}]},{"order":{"id":3974777,"order_id":140324132765,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-24 15:55","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-24 15:55","pay_time_out":"2014-03-25 15:55","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399196,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/img-tx.meilishuo.net\/pic\/u\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","b_pic_url":"http:\/\/imgtest.meiliworks.com\/pic\/b\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"36","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974776,"order_id":140324419501,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-24 15:52","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-03-24 15:52","pay_time_out":"2014-03-25 15:52","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399195,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/img-tx.meilishuo.net\/pic\/u\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","b_pic_url":"http:\/\/imgtest.meiliworks.com\/pic\/b\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"36","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974773,"order_id":140324274661,"status":2,"status_text":"\u7b49\u5f85\u786e\u8ba4\u6536\u8d27","words":"","step":2,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-24 15:37","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"718392829750","express_company":"\u4e2d\u901a\u5feb\u9012","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"2014-03-24 15:38","send_time":"2014-04-15 17:47","receive_time":"","last_status_time":"2014-03-24 15:38","pay_time_out":"2014-03-25 15:37","receive_time_out":"2014-04-25 17:47","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[{"type":2,"text":"\u786e\u8ba4\u6536\u8d27"}],"coupon_msg":"","receive_allow_weixin":1},"goods":[{"mid":4399192,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/imgst-dl.meilishuo.net\/pic\/u\/55\/00\/b75af81b8ac5ef1b42f65af862ca_432_572.c6.jpg","b_pic_url":"http:\/\/imgst-dl.meilishuo.net\/pic\/b\/55\/00\/b75af81b8ac5ef1b42f65af862ca_432_572.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u7ea2\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"37","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":2,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":1}]},{"order":{"id":3974772,"order_id":140324918285,"status":1,"status_text":"\u7b49\u5f85\u53d1\u8d27","words":"","step":1,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-24 15:32","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"2014-03-24 15:37","send_time":"","receive_time":"","last_status_time":"","pay_time_out":"2014-03-25 15:32","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399191,"twitter_id":2157132337,"goods_id":77555517,"price":"0.01","amount":1,"goods_title":"\u6652\u5355\u6d4b\u8bd5\u5355\u54c1\uff0c\u62cd\u4e0b\u4e0d\u53d1\u8d27\u4e0d\u9000\u6b3e\u7684~\u4e0d\u53c2\u52a0\u7f8e\u4e3d\u8bf4\u4efb\u4f55\u6d3b\u52a8\u54e6","goods_img":"http:\/\/img-tx.meilishuo.net\/pic\/u\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","b_pic_url":"http:\/\/imgtest.meiliworks.com\/pic\/b\/0f\/57\/90da8b5330b19646e7670f9a4fba_447_626.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"35","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":3,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":1,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]},{"order":{"id":3974700,"order_id":140313538007,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":1,"total_price":"0.02","order_price":"0.02","goods_price":"0.02","ctime":"2014-03-13 21:08","shop_id":"100421","seller_uid":"35840103","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u82b1\u975e\u82b1","phone":"18310733136","qq":"2035362761","im":{"qq":"2035362761","type":3,"shop_id":"100421"},"pay_time":"2014-03-14 10:40","send_time":"","receive_time":"","last_status_time":"2014-04-09 14:33","pay_time_out":"2014-03-14 21:08","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399105,"twitter_id":2158059851,"goods_id":77626967,"price":"0.02","amount":1,"goods_title":"\u6d4b\u8bd5\u5b9d\u8d1d\uff0c\u62cd\u4e0b\u4e0d\u9000\u6b3e\uff0c\u4e0d\u53d1\u8d27\u54e6~","goods_img":"http:\/\/imgtest.meiliworks.com\/pic\/u\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","b_pic_url":"http:\/\/imgtest-lx.meilishuo.net\/pic\/b\/f3\/98\/04ed543f34b0585576958fa645d3_647_542.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ec4\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":280645,"refund_status_text":"\u9000\u6b3e\u6210\u529f","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","refund_status":41,"receive_allow":2}]},{"order":{"id":3974699,"order_id":140313436757,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":1,"total_price":"0.01","order_price":"0.01","goods_price":"0.01","ctime":"2014-03-13 21:08","shop_id":"101277","seller_uid":"2740189","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u4e13\u9500\u7f8e\u8863","phone":"13240733798","qq":"1000000","im":{"qq":"1000000","type":3,"shop_id":"101277"},"pay_time":"2014-03-14 10:39","send_time":"","receive_time":"","last_status_time":"2014-04-09 14:33","pay_time_out":"2014-03-14 21:08","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":4399104,"twitter_id":2475537685,"goods_id":89853295,"price":"0.01","amount":1,"goods_title":"\u6d4b\u8bd5\u5546\u54c1\u65e0\u5fe7\u591f\u5b9d\u8d1d\uff0c\u4e0d\u9000\u4e0d\u6362\u614e\u62cd","goods_img":"http:\/\/imgst-dl.meilishuo.net\/pic\/u\/fd\/91\/df0353f3616b053b663f9e60dea2_798_925.c6.jpg","b_pic_url":"http:\/\/imgtest-dl.meiliworks.com\/pic\/b\/fd\/91\/df0353f3616b053b663f9e60dea2_798_925.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u9ed1\u8272","is_show":"1"},{"name":"\u5c3a\u7801","value":"-","is_show":"0"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":280644,"refund_status_text":"\u9000\u6b3e\u6210\u529f","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","refund_status":41,"receive_allow":2}]},{"order":{"id":3209043,"order_id":140227841123,"status":5,"status_text":"\u4ea4\u6613\u5173\u95ed","words":"","step":0,"total_price":"165.00","order_price":"165.00","goods_price":"165.00","ctime":"2014-02-27 12:00","shop_id":"106167","seller_uid":"4499180","buyer_uid":"63662389","express_price":"0.00","freight":"\u514d\u8fd0\u8d39","comment":"","express_id":"","express_company":"","pay_name":"\u652f\u4ed8\u5b9d","mls_phone":"4000800577","mls_qq":"4000800577","shop_name":"\u5c0f\u7433\u978b\u978b\u94fa","phone":"","qq":"","im":{"qq":"","type":3,"shop_id":"106167"},"pay_time":"","send_time":"","receive_time":"","last_status_time":"2014-02-28 12:00","pay_time_out":"2014-02-28 12:00","receive_time_out":"","service_time_out":"","show_receive_button":0,"show_receive_button_detail":0,"has_commented":0,"coupon_id":0,"has_shoppingshow":0,"is_shoppingshow":0,"opt":[],"coupon_msg":"","receive_allow_weixin":0},"goods":[{"mid":3571343,"twitter_id":2213930361,"goods_id":83046581,"price":"165.00","amount":1,"goods_title":"\u79cb\u51ac\u97e9\u7248\u539a\u5e95\u4f11\u95f2\u978b N\u5b57\u6bcd\u8fd0\u52a8\u978b\u771f\u76ae\u8212\u9002\u8dd1\u978b\u4e94\u73af\u9ed1\u8272\u5973\u978b\u60c5\u4fa3\u978b","goods_img":"http:\/\/imgst-dl.meilishuo.net\/pic\/u\/00\/3a\/b207a66bb2c90b50bb11aa65f34d_700_563.c6.jpg","b_pic_url":"http:\/\/imgtest-lx.meilishuo.net\/pic\/b\/00\/3a\/b207a66bb2c90b50bb11aa65f34d_700_563.c6.jpg","prop":[{"name":"\u989c\u8272","value":"\u6e38\u8247\u94bb\u84dd\u8272\u7eff\u978b\u5e95","is_show":"1"},{"name":"\u5c3a\u5bf8","value":"38","is_show":"1"}],"coupon_price":"0.00","is_doota":1,"ac_type":0,"refund_id":0,"refund_status_text":"","appeal_id":0,"appeal_status_text":"","service_allow":0,"refund_enter":0,"is_commented":0,"has_commented":0,"appeal":"","article_id":"","receive_allow":2}]}],"total_num":16,"order_num":16,"shopping_show":{"button":"\u6652\u5355\u9886\u5238","url":"http:\/\/www.meilishuo.com\/club\/single\/554393?frm=shaidan_shuoming"}}';
$json = '{"time":{"areaName":"","time":"1970-01-01 08:00:00","ftime":"1970-01-01 08:00:00","status":"2","context":"2"},"scantype":{"areaName":"","time":"1970-01-01 08:00:00","ftime":"1970-01-01 08:00:00","status":null,"context":null},"memo":{"areaName":"","time":"1970-01-01 08:00:00","ftime":"1970-01-01 08:00:00","status":null,"context":null}}';
// printInfo(array_values(json_decode($json,1)));
printInfo(json_decode($json,1));
exit;

// $a = array('b'=> '123'.'\r\n'.'456');

// $temp = http_build_query($a);
// printInfo($temp);
// exit;

// $d = array(array(array(1,2,3)));
// echo count($d);
// $detail['123']['bb']['areaName'] = '111';
// $detail['23']['db']['d'] = '111';
// $detail['345']['ccc']['bbbb'] = '222';

// printInfo($detail);
// echo count($detail);
// exit;

// $tm  = '20100517 06:54:35';
// echo date('Y-m-d H:i:s',strtotime($tm));
// exit;

// $tmp = '[{"context":"\u5df2\u7b7e\u6536,\u7b7e\u6536\u4eba\u662f\u5df2\u7b7e\u6536","time":"2014-04-04 15:05:47","status":"\u7b7e\u6536","areaCode":"","ftime":"2014-04-04 15:05:47","areaName":""}]';

$simple = '<?xml version="1.0" encoding="utf-8" ?><para><note>simple note</note></para>';
// $p = xml_parser_create();
// xml_parse_into_struct($p, $simple, $vals, $index);
// xml_parser_free($p);
// echo "Index array\n";
// print_r($index);
// echo "\nVals array\n";
// print_r($vals);
// echo 1234;
// exit;

/**
申通物流，一个运单和多个运单的返回结果是不一样的
 */
/*
$str = '<?xml version="1.0" encoding="gb2312" ?> 
 <root>
<track>
<billcode>368084106561</billcode> 
 <detail>
<time>20100516 18:51:54</time> 
<scantype>收件</scantype> 
<memo>上海崇明公司 的收件员 施先生已收件</memo> 
</detail>
 <detail>
<time>20100516 18:56:13</time> 
<scantype>发件</scantype> 
<memo>由上海崇明公司 发往 上海中转部</memo> 
</detail>
 <detail>
<time>20100516 22:34:36</time> 
<scantype>发件</scantype> 
<memo>由上海中转部 发往 上海普陀公司</memo> 
</detail>
 <detail>
<time>20100516 22:35:32</time> 
<scantype>到件</scantype> 
<memo>快件已到达上海普陀公司</memo> 
</detail>
 <detail>
<time>20100517 06:54:35</time> 
<scantype>派件</scantype> 
<memo>上海普陀公司 的派件员 怒江北路13818639411 正在派件</memo> 
</detail>
 <detail>
<time>20100517 09:54:37</time> 
<scantype>派件</scantype> 
<memo>上海普陀公司 的派件员 冯丽红 正在派件</memo> 
</detail>
 <detail>
<time>20100517 17:42</time> 
<scantype>签收</scantype> 
<memo>已签收,签收人是草签</memo> 
</detail>
</track>
</root>';
*/

$str = file_get_contents('/Users/cui/cui.out');
// echo $str;exit;
// $str = iconv('gb2312', 'utf-8', $str);
// if (function_exists("mb_convert_encoding")) {
// 	$str = mb_convert_encoding($str,'utf-8','gb2312');
// } elseif(function_exists("iconv")) {
// 	$str = iconv('gb2312','utf-8',$str);
// } else die("sorry, you have no libs support for charset changes.");
// echo $str;
// exit;
$str = str_replace('gb2312', 'utf-8', $str);
$str = mb_convert_encoding($str,'utf-8','gb2312');
// echo $str;exit;
$xml = simplexml_load_string($str);
// print_r($xml);
// $newExpress = json_decode(json_encode($xml),1);
echo  json_encode($xml);
// printInfo($newExpress);
exit;


// $sequential = array("foo", "bar", "baz", "blong");
// var_dump(json_encode($sequential,JSON_FORCE_OBJECT));
// exit;

// if (in_array(1, array(1,2,3))) {
// 	echo '1111';
// }
// exit;

// $json = '<Response><success>false</success><reason>无查询值</reason></Response>';
// $json = '[{"Waybill_No":"3580680985","Upload_Time":"2014-4-10 21:54:44","ProcessInfo":"湖北省汉口武广公司 已收件"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-10 22:01:47","ProcessInfo":"湖北省武汉市桥口区汉正街分部公司 的收件员 陈顺意 已收件"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-10 23:45:31","ProcessInfo":"湖北省汉口武广公司 已打包"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-10 23:48:11","ProcessInfo":"湖北省汉口武广公司已 发出"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-11 0:53:39","ProcessInfo":"武汉转运中心公司 已收入"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-11 0:57:13","ProcessInfo":"武汉转运中心公司已 发出"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-11 10:34:04","ProcessInfo":"长沙转运中心公司 已收入"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-11 11:04:22","ProcessInfo":"长沙转运中心公司已 发出"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-13 4:20:57","ProcessInfo":"云南省昆明市公司 已收入"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-13 4:22:29","ProcessInfo":"云南省昆明市公司 已拆包"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-13 6:24:55","ProcessInfo":"云南省昆明市公司已 发出"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-13 9:47:50","ProcessInfo":"云南省昆明市和谐公司 已收入"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-13 10:25:16","ProcessInfo":"云南省昆明市和谐公司 的派件员 罗永高 派件中 派件员电话"},{"Waybill_No":"3580680985","Upload_Time":"2014-4-13 15:37:36","ProcessInfo":"客户杨已签收 派件员 张庭娥"}]';
// $json = '[{"context":"PDA\u6b63\u5e38\u7b7e\u6536\u626b\u63cf \u827e\u6676 \u5317\u4eac\u5e02\u6d77\u6dc0\u533a\u4e0a\u5730","time":"2014-04-22 11:27:52","status":"\u7b7e\u6536","areaCode":"110108000000","ftime":"2014-04-22 11:27:52","areaName":"\u5317\u4eac\u5e02,\u5e02\u8f96\u533a,\u6d77\u6dc0\u533a"},{"context":"\u6d3e\u4ef6\u626b\u63cf \u5510\u660e\u5cf0 \u5317\u4eac\u5e02\u6d77\u6dc0\u533a\u4e0a\u5730","time":"2014-04-22 08:25:39","status":"\u6d3e\u4ef6","areaCode":"110108000000","ftime":"2014-04-22 08:25:39","areaName":"\u5317\u4eac\u5e02,\u5e02\u8f96\u533a,\u6d77\u6dc0\u533a"},{"context":"\u4e0b\u8f66\u626b\u63cf \u5510\u660e\u5cf0 \u5317\u4eac\u5e02\u6d77\u6dc0\u533a\u4e0a\u5730","time":"2014-04-22 07:32:57","status":"\u5728\u9014","areaCode":"110108000000","ftime":"2014-04-22 07:32:57","areaName":"\u5317\u4eac\u5e02,\u5e02\u8f96\u533a,\u6d77\u6dc0\u533a"},{"context":"\u53d1\u8f66\u626b\u63cf \u9a6c\u51e4\u519b \u5317\u4eac\u8f6c\u8fd0\u4e2d\u5fc3","time":"2014-04-21 23:49:11","status":"\u5728\u9014","areaCode":"110000000000","ftime":"2014-04-21 23:49:11","areaName":"\u5317\u4eac\u5e02"},{"context":"\u88c5\u4ef6\u5165\u8f66\u626b\u63cf \u51af\u4eac \u5317\u4eac\u8f6c\u8fd0\u4e2d\u5fc3","time":"2014-04-21 22:34:09","status":"\u5728\u9014","areaCode":"110000000000","ftime":"2014-04-21 22:34:09","areaName":"\u5317\u4eac\u5e02"},{"context":"\u62c6\u5305\u626b\u63cf \u90ed\u745e\u51ef \u5317\u4eac\u8f6c\u8fd0\u4e2d\u5fc3","time":"2014-04-21 22:30:32","status":"\u5728\u9014","areaCode":"110000000000","ftime":"2014-04-21 22:30:32","areaName":"\u5317\u4eac\u5e02"},{"context":"\u4e0b\u8f66\u626b\u63cf \u5f20\u9ad8\u660e \u5317\u4eac\u8f6c\u8fd0\u4e2d\u5fc3","time":"2014-04-21 22:17:57","status":"\u5728\u9014","areaCode":"110000000000","ftime":"2014-04-21 22:17:57","areaName":"\u5317\u4eac\u5e02"},{"context":"\u53d1\u8f66\u626b\u63cf \u865e\u5409\u6ee8 \u6d59\u6c5f\u7701\u676d\u5dde\u5e02\u8427\u5c71\u4e2d\u90e8","time":"2014-04-20 23:15:45","status":"\u5728\u9014","areaCode":"330109000000","ftime":"2014-04-20 23:15:45","areaName":"\u6d59\u6c5f\u7701,\u676d\u5dde\u5e02,\u8427\u5c71\u533a"},{"context":"\u88c5\u4ef6\u5165\u8f66\u626b\u63cf \u865e\u5409\u6ee8 \u6d59\u6c5f\u7701\u676d\u5dde\u5e02\u8427\u5c71\u4e2d\u90e8","time":"2014-04-20 22:48:14","status":"\u5728\u9014","areaCode":"330109000000","ftime":"2014-04-20 22:48:14","areaName":"\u6d59\u6c5f\u7701,\u676d\u5dde\u5e02,\u8427\u5c71\u533a"},{"context":"\u88c5\u4ef6\u5165\u5305\u626b\u63cf \u5218\u8fdb\u53cb \u6d59\u6c5f\u7701\u676d\u5dde\u5e02\u8427\u5c71\u4e2d\u90e8","time":"2014-04-20 22:40:11","status":"\u5728\u9014","areaCode":"330109000000","ftime":"2014-04-20 22:40:11","areaName":"\u6d59\u6c5f\u7701,\u676d\u5dde\u5e02,\u8427\u5c71\u533a"},{"context":"\u63fd\u6536\u626b\u63cf \u90ed\u65b0\u840d \u6d59\u6c5f\u7701\u676d\u5dde\u5e02\u8427\u5c71\u4e2d\u90e8","time":"2014-04-20 22:23:06","status":"\u5728\u9014","areaCode":"330109000000","ftime":"2014-04-20 22:23:06","areaName":"\u6d59\u6c5f\u7701,\u676d\u5dde\u5e02,\u8427\u5c71\u533a"}]';
// $json = '[{"areaName":"","time":"2014-4-10 21:54:44","ftime":"2014-4-10 21:54:44","context":"\u6e56\u5317\u7701\u6c49\u53e3\u6b66\u5e7f\u516c\u53f8 \u5df2\u6536\u4ef6"},{"areaName":"","time":"2014-4-10 22:01:47","ftime":"2014-4-10 22:01:47","context":"\u6e56\u5317\u7701\u6b66\u6c49\u5e02\u6865\u53e3\u533a\u6c49\u6b63\u8857\u5206\u90e8\u516c\u53f8 \u7684\u6536\u4ef6\u5458 \u9648\u987a\u610f \u5df2\u6536\u4ef6"},{"areaName":"","time":"2014-4-10 23:45:31","ftime":"2014-4-10 23:45:31","context":"\u6e56\u5317\u7701\u6c49\u53e3\u6b66\u5e7f\u516c\u53f8 \u5df2\u6253\u5305"},{"areaName":"","time":"2014-4-10 23:48:11","ftime":"2014-4-10 23:48:11","context":"\u6e56\u5317\u7701\u6c49\u53e3\u6b66\u5e7f\u516c\u53f8\u5df2 \u53d1\u51fa"},{"areaName":"","time":"2014-4-11 0:53:39","ftime":"2014-4-11 0:53:39","context":"\u6b66\u6c49\u8f6c\u8fd0\u4e2d\u5fc3\u516c\u53f8 \u5df2\u6536\u5165"},{"areaName":"","time":"2014-4-11 0:57:13","ftime":"2014-4-11 0:57:13","context":"\u6b66\u6c49\u8f6c\u8fd0\u4e2d\u5fc3\u516c\u53f8\u5df2 \u53d1\u51fa"},{"areaName":"","time":"2014-4-11 10:34:04","ftime":"2014-4-11 10:34:04","context":"\u957f\u6c99\u8f6c\u8fd0\u4e2d\u5fc3\u516c\u53f8 \u5df2\u6536\u5165"},{"areaName":"","time":"2014-4-11 11:04:22","ftime":"2014-4-11 11:04:22","context":"\u957f\u6c99\u8f6c\u8fd0\u4e2d\u5fc3\u516c\u53f8\u5df2 \u53d1\u51fa"},{"areaName":"","time":"2014-4-13 4:20:57","ftime":"2014-4-13 4:20:57","context":"\u4e91\u5357\u7701\u6606\u660e\u5e02\u516c\u53f8 \u5df2\u6536\u5165"},{"areaName":"","time":"2014-4-13 4:22:29","ftime":"2014-4-13 4:22:29","context":"\u4e91\u5357\u7701\u6606\u660e\u5e02\u516c\u53f8 \u5df2\u62c6\u5305"},{"areaName":"","time":"2014-4-13 6:24:55","ftime":"2014-4-13 6:24:55","context":"\u4e91\u5357\u7701\u6606\u660e\u5e02\u516c\u53f8\u5df2 \u53d1\u51fa"},{"areaName":"","time":"2014-4-13 9:47:50","ftime":"2014-4-13 9:47:50","context":"\u4e91\u5357\u7701\u6606\u660e\u5e02\u548c\u8c10\u516c\u53f8 \u5df2\u6536\u5165"},{"areaName":"","time":"2014-4-13 10:25:16","ftime":"2014-4-13 10:25:16","context":"\u4e91\u5357\u7701\u6606\u660e\u5e02\u548c\u8c10\u516c\u53f8 \u7684\u6d3e\u4ef6\u5458 \u7f57\u6c38\u9ad8 \u6d3e\u4ef6\u4e2d \u6d3e\u4ef6\u5458\u7535\u8bdd"},{"areaName":"","time":"2014-4-13 15:37:36","ftime":"2014-4-13 15:37:36","context":"\u5ba2\u6237\u6768\u5df2\u7b7e\u6536 \u6d3e\u4ef6\u5458 \u5f20\u5ead\u5a25"}]';
$json = '[{"areaName":"","time":"2014-5-4 17:47:57","ftime":"2014-5-4 17:47:57","context":"\u6cb3\u5317\u7701\u4fdd\u5b9a\u5e02\u9ad8\u7891\u5e97\u5e02\u516c\u53f8 \u7684\u6536\u4ef6\u5458 \u6768\u658c \u5df2\u6536\u4ef6"}]';
$var = json_decode($json,1);
printInfo($var);
exit;


/**
 * 圆通物流测试
 */
$str = 'sign=CB19AB009E439A815F94A839B17087E8&app_key=Szj9b1&format=Json&method=yto.Marketing.WaybillTrace
		&timestamp=2014-4-30 15:14:32&user_id=hailongchen&v=1.0&param=[{"Number":"3580680985"}]';

$param = array('param' => json_encode(array(array('Number'=> '3580680985'))));
$auth = array(
    				'api' => 'http://58.32.246.70:8088/MarketingInterface',
    				'secret' => '6KxODv',
    				'method' => 'yto.Marketing.WaybillTrace',//走件流程查询接口
    				'v' => '1.0',
    				'user_id' => 'hailongchen',
    				'app_key' => 'Szj9b1',
    				'format' => 'Json',
    				'timestamp' => '',
    		);
$auth['timestamp'] = '2014-4-30 16:26:32';

$secret = $auth['secret'];
unset($auth['api']);
unset($auth['secret']);
ksort($auth);
$sign = '';

foreach ($auth as $k => $v){
	$sign .= $k.$v;
}
//签名
$sign = array('sign' => strtoupper(md5($secret.$sign)));
$data = array_merge($sign,$auth,$param);
printInfo($auth);
printInfo($data);
echo http_build_query($data);
exit;
exit;

$arr1 = array('a'=>array(101,array(1,3,5)),'b'=>array(103,104));
$arr2 = array('a'=>array(201,202),'b'=>array(203,204));
$arr3 = array('e'=>array(301,302),'0'=>array(303,304,305,array(123,456)),'g'=>array(307,308));
$tmp= array_merge($arr3,$arr1,$arr2);
printInfo($tmp);
exit;


$a=array("a"=>"Cat","b"=>"Dog");
array_unshift($a,array('c'=>'d'));
print_r($a);
exit;

$arr = array(
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
		1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0);
printInfo(array_chunk($arr, 70));
exit;

// echo date('Y:m:d H:i:s');
// exit;

// $arr = array(array(1,2,3),array(4,5,6));
// print_r( end($arr));
// print_r(reset($arr));
// exit;

// $str =  'a b c d e f';
// $var = str_replace(' ', '', $str);
// echo $var ;
// exit;
// echo (int)date('i');
// exit;

// $arr = array();



// echo date('Ymd his', strtotime('-30 day'));
// echo '</br>';
// echo strtotime('-30 day');
// echo '</br>';
// echo time();
// // echo date('Ymdhis', strtotime('-2 day'));
// exit;

// var_dump(1>0);
// exit;
/*
$json = '{"traces":[{"acceptAddress":"广州沙太","acceptTime":"2013-12-23 21:37:14","remark":"广州沙太(程文) 已收件 进入公司分捡"},{"acceptAddress":"广州沙太","acceptTime":"2013-12-24 01:14:19","remark":"广州沙太() 已收件 进入公司分捡"},{"acceptAddress":"广州沙太","acceptTime":"2013-12-24 01:57:45","remark":"快件离开 广州沙太 已发往太原中转"},{"acceptAddress":"广州沙太","acceptTime":"2013-12-24 02:09:52","remark":"在 广州沙太 装包并发往广州中心"},{"acceptAddress":"广州中心","acceptTime":"2013-12-24 09:46:58","remark":"在 广州中心 装包并发往太原中转"},{"acceptAddress":"太原中转","acceptTime":"2013-12-26 10:36:59","remark":"所在包 到达太原中转 "},{"acceptAddress":"太原中转","acceptTime":"2013-12-26 10:39:09","remark":"快件到达 太原中转 正在分捡中 上一站是 广州中心"},{"acceptAddress":"太原中转","acceptTime":"2013-12-26 10:49:42","remark":"在 太原中转 装包并发往吕梁"},{"acceptAddress":"太原中转","acceptTime":"2013-12-26 10:51:01","remark":"快件离开 太原中转 已发往吕梁"},{"acceptAddress":"吕梁","acceptTime":"2013-12-27 08:48:30","remark":"所在包 到达吕梁 "},{"acceptAddress":"吕梁","acceptTime":"2013-12-27 20:32:16","remark":"快件到达 吕梁 正在分捡中 上一站是 太原"},{"acceptAddress":"吕梁","acceptTime":"2013-12-27 21:33:22","remark":"快件离开 吕梁 已发往吕梁中阳县"},{"acceptAddress":"吕梁中阳县","acceptTime":"2013-12-28 08:14:08","remark":"快件到达 吕梁中阳县 正在分捡中 上一站是 吕梁"},{"acceptAddress":"吕梁中阳县","acceptTime":"2013-12-28 08:40:55","remark":"拴旺2864115 正在派件中"},{"acceptAddress":"吕梁中阳县","acceptTime":"2013-12-28 14:37:15","remark":"签收人是 拍照签收"}]}';
$json = '{"company":"zhongtong","number":"718452098059","to":"\u4e0a\u6d77\u5e02\u95f5\u884c\u533a\u6caa\u95f5\u8def\u53e4\u65b9\u8def76\u53f7\u767e\u8299\u4e3d\u62a4\u80a4\u9020\u578b\u4e2d\u5fc3"}';
$json = '[{"context":"\u5317\u4eac\u4e2d\u5173\u6751 \u6d3e\u4ef6\u5df2\u7b7e\u6536 ,\u7b7e\u6536\u4eba\u662f \u62cd\u7167\u7b7e\u6536","time":"2014-03-29 09:47:45","status":"\u7b7e\u6536","areaCode":"110000000000","ftime":"2014-03-29 09:47:45","areaName":"\u5317\u4eac\u5e02"},{"context":"\u5317\u4eac\u4e2d\u5173\u6751 \u4f55\u4e49\u6625 \u6b63\u5728\u6d3e\u4ef6","time":"2014-03-29 08:33:08","status":"\u6d3e\u4ef6","areaCode":"110000000000","ftime":"2014-03-29 08:33:08","areaName":"\u5317\u4eac\u5e02"},{"context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u4e2d\u5173\u6751\uff0c\u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac","time":"2014-03-29 06:57:35","status":"\u5728\u9014","areaCode":"110000000000","ftime":"2014-03-29 06:57:35","areaName":"\u5317\u4eac\u5e02"},{"context":"\u5feb\u4ef6\u79bb\u5f00 \u5317\u4eac\u5e02\u5185\u90e8\uff0c\u5df2\u53d1\u5f80 \u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 04:01:52","status":"\u5728\u9014","areaCode":"","ftime":"2014-03-29 04:01:52","areaName":""},{"context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u5e02\u5185\u90e8\uff0c\u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac","time":"2014-03-28 16:09:49","status":"\u5728\u9014","areaCode":"110000000000","ftime":"2014-03-28 16:09:49","areaName":"\u5317\u4eac\u5e02"},{"context":"\u5728 \u5357\u4eac\u4e2d\u8f6c\u90e8 \u88c5\u5305\uff0c\u5e76\u53d1\u5f80 \u5317\u4eac","time":"2014-03-27 23:00:27","status":"\u5728\u9014","areaCode":"","ftime":"2014-03-27 23:00:27","areaName":""},{"context":"\u6240\u5728\u5305\u5230\u8fbe \u5357\u4eac\u4e2d\u8f6c\u90e8","time":"2014-03-27 22:59:42","status":"\u5728\u9014","areaCode":"320100000000","ftime":"2014-03-27 22:59:42","areaName":"\u6c5f\u82cf\u7701,\u5357\u4eac\u5e02"},{"context":"\u5728 \u5357\u4eac\u6c5f\u5b81\u533a \u88c5\u5305\uff0c\u5e76\u53d1\u5f80 \u5317\u4eac","time":"2014-03-27 21:35:58","status":"\u5728\u9014","areaCode":"","ftime":"2014-03-27 21:35:58","areaName":""},{"context":"\u5feb\u4ef6\u79bb\u5f00 \u5357\u4eac\u6c5f\u5b81\u533a\uff0c\u5df2\u53d1\u5f80 \u5317\u4eac","time":"2014-03-27 21:30:36","status":"\u5728\u9014","areaCode":"","ftime":"2014-03-27 21:30:36","areaName":""},{"context":"\u5feb\u4ef6\u5230\u8fbe \u5357\u4eac\u6c5f\u5b81\u533a\uff0c\u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8","time":"2014-03-27 20:26:56","status":"\u5728\u9014","areaCode":"320115000000","ftime":"2014-03-27 20:26:56","areaName":"\u6c5f\u82cf\u7701,\u5357\u4eac\u5e02,\u6c5f\u5b81\u533a"},{"context":"\u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8 \u7ee3\u574a \u5df2\u6536\u4ef6\uff0c\u8fdb\u5165\u516c\u53f8\u5206\u6361","time":"2014-03-27 20:26:24","status":"\u5728\u9014","areaCode":"","ftime":"2014-03-27 20:26:24","areaName":""}]';
$json = '{"error":[{"reason":"单号非法"}]}';
$json  = '{"result":"false","remark":"s12"}';
$json = '[{"areaName":"\u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8","time":"2014-03-27 20:26:24","ftime":"2014-03-27 20:26:24","context":"\u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8(\u7ee3\u574a) \u5df2\u6536\u4ef6 \u8fdb\u5165\u516c\u53f8\u5206\u6361"},{"areaName":"\u5357\u4eac\u6c5f\u5b81\u533a","time":"2014-03-27 20:26:56","ftime":"2014-03-27 20:26:56","context":"\u5feb\u4ef6\u5230\u8fbe \u5357\u4eac\u6c5f\u5b81\u533a \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8"},{"areaName":"\u5357\u4eac\u6c5f\u5b81\u533a","time":"2014-03-27 21:30:36","ftime":"2014-03-27 21:30:36","context":"\u5feb\u4ef6\u79bb\u5f00 \u5357\u4eac\u6c5f\u5b81\u533a \u5df2\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5357\u4eac\u6c5f\u5b81\u533a","time":"2014-03-27 21:35:58","ftime":"2014-03-27 21:35:58","context":"\u5728 \u5357\u4eac\u6c5f\u5b81\u533a \u88c5\u5305\u5e76\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5357\u4eac\u4e2d\u8f6c\u90e8","time":"2014-03-27 22:59:42","ftime":"2014-03-27 22:59:42","context":"\u6240\u5728\u5305 \u5230\u8fbe\u5357\u4eac\u4e2d\u8f6c\u90e8 "},{"areaName":"\u5357\u4eac\u4e2d\u8f6c\u90e8","time":"2014-03-27 23:00:27","ftime":"2014-03-27 23:00:27","context":"\u5728 \u5357\u4eac\u4e2d\u8f6c\u90e8 \u88c5\u5305\u5e76\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5317\u4eac\u5e02\u5185\u90e8","time":"2014-03-28 16:09:49","ftime":"2014-03-28 16:09:49","context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u5e02\u5185\u90e8 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac"},{"areaName":"\u5317\u4eac\u5e02\u5185\u90e8","time":"2014-03-29 04:01:52","ftime":"2014-03-29 04:01:52","context":"\u5feb\u4ef6\u79bb\u5f00 \u5317\u4eac\u5e02\u5185\u90e8 \u5df2\u53d1\u5f80\u5317\u4eac\u4e2d\u5173\u6751"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 06:57:35","ftime":"2014-03-29 06:57:35","context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u4e2d\u5173\u6751 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 08:33:08","ftime":"2014-03-29 08:33:08","context":"\u4f55\u4e49\u6625 \u6b63\u5728\u6d3e\u4ef6\u4e2d"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 09:47:45","ftime":"2014-03-29 09:47:45","context":"\u7b7e\u6536\u4eba\u662f \u62cd\u7167\u7b7e\u6536"}]';
$json = '[{"context":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u76f4\u8425\u7ec4\u5206\u90e8:\u5feb\u4ef6\u5df2\u88ab  \u7b7e\u6536","time":"2013-11-30 14:58:35","status":"\u7b7e\u6536","areaCode":"","ftime":"2013-11-30 14:58:35","areaName":""},{"context":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u76f4\u8425\u7ec4\u5206\u90e8:\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u738b\u4f20\u7ede\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a18823451942","time":"2013-11-30 14:49:23","status":"\u6d3e\u4ef6","areaCode":"440304000000","ftime":"2013-11-30 14:49:23","areaName":"\u5e7f\u4e1c\u7701,\u6df1\u5733\u5e02,\u798f\u7530\u533a"},{"context":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u76f4\u8425\u7ec4\u5206\u90e8:\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001","time":"2013-11-30 14:26:11","status":"\u6d3e\u4ef6","areaCode":"440304000000","ftime":"2013-11-30 14:26:11","areaName":"\u5e7f\u4e1c\u7701,\u6df1\u5733\u5e02,\u798f\u7530\u533a"},{"context":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u9ad8\u65b0\u5206\u90e8:\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf","time":"2013-11-30 07:26:56","status":"\u5728\u9014","areaCode":"440305000000","ftime":"2013-11-30 07:26:56","areaName":"\u5e7f\u4e1c\u7701,\u6df1\u5733\u5e02,\u5357\u5c71\u533a"},{"context":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8:\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf","time":"2013-11-29 22:35:06","status":"\u5728\u9014","areaCode":"440300000000","ftime":"2013-11-29 22:35:06","areaName":"\u5e7f\u4e1c\u7701,\u6df1\u5733\u5e02"},{"context":"\u5e7f\u4e1c\u6df1\u5733\u5206\u62e8\u4e2d\u5fc3:\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-29 21:09:10","status":"\u5728\u9014","areaCode":"440300000000","ftime":"2013-11-29 21:09:10","areaName":"\u5e7f\u4e1c\u7701,\u6df1\u5733\u5e02"},{"context":"\u5e7f\u4e1c\u6df1\u5733\u5206\u62e8\u4e2d\u5fc3:\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf","time":"2013-11-29 08:45:55","status":"\u5728\u9014","areaCode":"","ftime":"2013-11-29 08:45:55","areaName":""},{"context":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3\u82b3\u6751\u5206\u62e8\u70b9:\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u5206\u62e8\u4e2d\u5fc3","time":"2013-11-28 23:56:07","status":"\u5728\u9014","areaCode":"","ftime":"2013-11-28 23:56:07","areaName":""},{"context":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3\u82b3\u6751\u5206\u62e8\u70b9:\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf","time":"2013-11-28 23:49:43","status":"\u5728\u9014","areaCode":"","ftime":"2013-11-28 23:49:43","areaName":""},{"context":"\u5e7f\u4e1c\u5e7f\u5dde\u6d77\u73e0\u533a\u6c5f\u71d5\u516c\u53f8:\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u5206\u62e8\u4e2d\u5fc3","time":"2013-11-28 22:26:56","status":"\u5728\u9014","areaCode":"","ftime":"2013-11-28 22:26:56","areaName":""},{"context":"\u5e7f\u4e1c\u5e7f\u5dde\u6d77\u73e0\u533a\u6c5f\u71d5\u516c\u53f8:\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf","time":"2013-11-28 21:50:08","status":"\u5728\u9014","areaCode":"440105000000","ftime":"2013-11-28 21:50:08","areaName":"\u5e7f\u4e1c\u7701,\u5e7f\u5dde\u5e02,\u6d77\u73e0\u533a"},{"context":"\u5e7f\u4e1c\u5e7f\u5dde\u6d77\u73e0\u533a\u6c5f\u71d5\u516c\u53f8:\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf","time":"2013-11-28 19:59:43","status":"\u5728\u9014","areaCode":"440105000000","ftime":"2013-11-28 19:59:43","areaName":"\u5e7f\u4e1c\u7701,\u5e7f\u5dde\u5e02,\u6d77\u73e0\u533a"}]';
$json = '[{"areaName":"\u6d59\u6c5f\u5b81\u6ce2\u911e\u5dde\u533a\u4e1c\u94b1\u6e56\u516c\u53f8","time":"2013-10-24 18:33:35","ftime":"2013-10-24 18:33:35","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-10-25 13:59:10","ftime":"2013-10-25 13:59:10","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5c71\u4e1c\u6d4e\u5357\u5206\u62e8\u4e2d\u5fc3","time":"2013-10-25 21:38:55","ftime":"2013-10-25 21:38:55","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2013-10-26 21:36:17","ftime":"2013-10-26 21:36:17","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u56db\u5ddd\u6210\u90fd\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-10-30 12:01:01","ftime":"2013-10-30 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-10-30 16:02:40","ftime":"2013-10-30 16:02:40","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-11-02 12:01:01","ftime":"2013-11-02 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6df1\u60e0\u4e1c\u65b9\u5353\u8d8a\u5206\u90e8","time":"2013-11-01 13:59:52","ftime":"2013-11-01 13:59:52","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u65b0\u4e2d\u5fc3\u5206\u90e8","time":"2013-11-03 12:01:01","ftime":"2013-11-03 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6c11\u6cbb\u5b9d\u5c71\u5206\u90e8","time":"2013-11-03 12:01:01","ftime":"2013-11-03 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u65f6\u4ee3\u5206\u90e8","time":"2013-11-02 16:55:02","ftime":"2013-11-02 16:55:02","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6c11\u6cbb\u4e0a\u6cb3\u574a\u5206\u90e8","time":"2013-11-06 15:08:45","ftime":"2013-11-06 15:08:45","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u83b2\u4e30\u5206\u90e8","time":"2013-11-09 10:15:28","ftime":"2013-11-09 10:15:28","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u4fdd\u5229\u5206\u90e8","time":"2013-11-11 12:01:01","ftime":"2013-11-11 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 00:20:16","ftime":"2013-11-19 00:20:16","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 01:40:15","ftime":"2013-11-19 01:40:15","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 02:17:29","ftime":"2013-11-19 02:17:29","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:01:01","ftime":"2013-11-20 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 20:14:12","ftime":"2013-11-19 20:14:12","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 20:18:57","ftime":"2013-11-19 20:18:57","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:01:01","ftime":"2013-11-21 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:01:01","ftime":"2013-11-21 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:01:01","ftime":"2013-11-21 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:01:01","ftime":"2013-11-21 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:01:01","ftime":"2013-11-21 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-23 12:01:01","ftime":"2013-11-23 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-23 12:01:01","ftime":"2013-11-23 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-22 17:43:53","ftime":"2013-11-22 17:43:53","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-24 12:01:01","ftime":"2013-11-24 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-23 10:47:13","ftime":"2013-11-23 10:47:13","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u9f99\u80dc\u5206\u90e8","time":"2013-11-25 11:23:19","ftime":"2013-11-25 11:23:19","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u9f99\u80dc\u5206\u90e8","time":"2013-11-26 12:01:01","ftime":"2013-11-26 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u77f3\u5ca9\u7530\u5fc3\u77f3\u9f99\u4ed4\u5206\u90e8","time":"2013-11-26 12:01:01","ftime":"2013-11-26 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u65b0\u6d32\u56fd\u901a\u5206\u90e8","time":"2013-11-25 16:11:10","ftime":"2013-11-25 16:11:10","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u4eac\u57fa\u5206\u90e8","time":"2013-11-27 12:01:01","ftime":"2013-11-27 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u4eac\u57fa\u5206\u90e8","time":"2013-11-26 11:48:55","ftime":"2013-11-26 11:48:55","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u4e0a\u6d77\u5d07\u660e\u53bf\u516c\u53f8","time":"2013-11-27 10:56:08","ftime":"2013-11-27 10:56:08","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5e02\u573a\u5f00\u53d1\u90e8-KH0013","time":"2013-11-27 15:16:29","ftime":"2013-11-27 15:16:29","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u77f3\u5ca9\u7530\u5fc3\u6c34\u7530\u5206\u90e8","time":"2013-11-27 17:58:28","ftime":"2013-11-27 17:58:28","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u77f3\u5ca9\u7530\u5fc3\u6c34\u7530\u5206\u90e8","time":"2013-11-27 18:11:20","ftime":"2013-11-27 18:11:20","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u8fbd\u5b81\u9526\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2013-11-28 06:58:53","ftime":"2013-11-28 06:58:53","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u534e\u7f8e\u5206\u90e8","time":"2013-11-29 12:01:01","ftime":"2013-11-29 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u534e\u7f8e\u5206\u90e8","time":"2013-11-29 12:01:01","ftime":"2013-11-29 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-28 10:20:45","ftime":"2013-11-28 10:20:45","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u5e7f\u5dde\u603b\u516c\u53f8"},{"areaName":"\u4e0a\u6d77\u5d07\u660e\u53bf\u516c\u53f8","time":"2013-11-29 11:19:26","ftime":"2013-11-29 11:19:26","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u5357\u95e8\u5927\u8d27\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a13816261357"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u91d1\u7a3b\u7530\u5206\u90e8","time":"2013-11-29 14:09:49","ftime":"2013-11-29 14:09:49","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6c11\u6cbb\u534e\u666f\u5206\u90e8","time":"2013-11-29 14:15:47","ftime":"2013-11-29 14:15:47","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2013-11-29 15:32:36","ftime":"2013-11-29 15:32:36","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u5e03\u5409\u9f99\u6cc9\u5206\u90e8","time":"2013-11-29 16:01:55","ftime":"2013-11-29 16:01:55","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-01 12:01:01","ftime":"2013-12-01 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-01 12:01:01","ftime":"2013-12-01 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u77f3\u5ca9\u7530\u5fc3\u6c34\u7530\u5206\u90e8","time":"2013-11-30 22:33:13","ftime":"2013-11-30 22:33:13","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u8d35\u5dde\u60e0\u6c34\u53bf\u516c\u53f8","time":"2013-12-02 22:08:10","ftime":"2013-12-02 22:08:10","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u7231\u534e\u666e\u6dd8\u5b9d\u5206\u90e8","time":"2013-12-03 16:30:34","ftime":"2013-12-03 16:30:34","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u95ee\u9898\u4ef6\u5904\u7406","time":"2013-12-03 17:40:02","ftime":"2013-12-03 17:40:02","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u7f51\u70b9\u5206\u62e8\u70b9"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u56fa\u620d\u5206\u90e8","time":"2013-12-03 22:57:55","ftime":"2013-12-03 22:57:55","context":"\u8fdb\u884c\u53d1\u51fa\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-04 19:50:07","ftime":"2013-12-04 19:50:07","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-12-06 12:01:01","ftime":"2013-12-06 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-12-06 12:01:01","ftime":"2013-12-06 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-07 12:01:01","ftime":"2013-12-07 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u4e2d\u5fc3\u5929\u8679\u5206\u90e8","time":"2013-12-08 12:01:01","ftime":"2013-12-08 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-08 12:01:01","ftime":"2013-12-08 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-08 12:01:01","ftime":"2013-12-08 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6c5f\u897f\u5357\u660c\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-07 10:22:20","ftime":"2013-12-07 10:22:20","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u65b0\u6d32\u56fd\u901a\u5206\u90e8","time":"2013-12-09 10:45:49","ftime":"2013-12-09 10:45:49","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u8349\u57d4\u5206\u90e8","time":"2013-12-10 12:01:01","ftime":"2013-12-10 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u7535\u5b50\u79d1\u6280\u5206\u90e8","time":"2013-12-10 17:10:21","ftime":"2013-12-10 17:10:21","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u6d77\u4e0a\u4e16\u754c\u5206\u90e8","time":"2013-12-10 17:22:15","ftime":"2013-12-10 17:22:15","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5409\u6797\u957f\u6625\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-12 02:06:48","ftime":"2013-12-12 02:06:48","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u9ed1\u9f99\u6c5f\u54c8\u5c14\u6ee8\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-16 16:23:48","ftime":"2013-12-16 16:23:48","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u9ed1\u9f99\u6c5f\u5927\u5e86\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u5e73\u6e56\u534e\u5357\u5206\u90e8","time":"2013-12-22 12:01:01","ftime":"2013-12-22 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u9ec4\u9ebb\u5e03\u5206\u90e8","time":"2013-12-25 13:17:54","ftime":"2013-12-25 13:17:54","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5929\u6d25\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-30 04:04:51","ftime":"2013-12-30 04:04:51","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5929\u6d25\u897f\u9752\u533a\u6d77\u6cf0\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u5e03\u5409\u5357\u5cad\u5206\u90e8","time":"2014-01-02 12:01:01","ftime":"2014-01-02 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-01 22:31:53","ftime":"2014-01-01 22:31:53","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u5927\u6da6\u53d1\u4e2d\u5fc3\u5206\u90e8","time":"2014-01-03 16:33:02","ftime":"2014-01-03 16:33:02","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-08 12:01:01","ftime":"2014-01-08 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6e05\u8fdc\u516c\u53f8","time":"2014-01-10 13:31:50","ftime":"2014-01-10 13:31:50","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a400-821-6789"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-16 12:01:01","ftime":"2014-01-16 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-18 12:01:01","ftime":"2014-01-18 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-17 17:19:45","ftime":"2014-01-17 17:19:45","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 10:45:41","ftime":"2014-01-20 10:45:41","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 11:29:32","ftime":"2014-01-20 11:29:32","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 11:49:17","ftime":"2014-01-20 11:49:17","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 16:03:22","ftime":"2014-01-20 16:03:22","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 16:18:29","ftime":"2014-01-20 16:18:29","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:16:28","ftime":"2014-01-20 17:16:28","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:19:56","ftime":"2014-01-20 17:19:56","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:30:00","ftime":"2014-01-20 17:30:00","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:42:03","ftime":"2014-01-20 17:42:03","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u6d59\u6c5f\u8427\u5c71\u5206\u62e8\u4e2d\u5fc3","time":"2014-01-20 21:39:07","ftime":"2014-01-20 21:39:07","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u6d59\u6c5f\u676d\u5dde\u8427\u5c71\u533a\u65b0\u8857\u516c\u53f8"},{"areaName":"\u6c5f\u82cf\u5b9c\u5174\u516c\u53f8","time":"2014-01-27 12:01:01","ftime":"2014-01-27 12:01:01","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2014-02-10 20:20:33","ftime":"2014-02-10 20:20:33","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2014-02-10 20:22:43","ftime":"2014-02-10 20:22:43","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u5e03\u5409\u767e\u76db\u5206\u90e8","time":"2014-02-11 12:01:01","ftime":"2014-02-11 12:01:01","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-02-12 15:20:12","ftime":"2014-02-12 15:20:12","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u5927\u65b0\u4e00\u7532\u5206\u90e8","time":"2014-02-14 12:17:29","ftime":"2014-02-14 12:17:29","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-02-18 02:33:45","ftime":"2014-02-18 02:33:45","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5c71\u4e1c\u6d4e\u5357\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u798f\u5efa\u798f\u6e05\u5e02\u516c\u53f8","time":"2014-02-21 15:41:49","ftime":"2014-02-21 15:41:49","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u798f\u5efa\u798f\u6e05\u5e02\u516c\u53f8\u5b8f\u8def\u5206\u90e8"},{"areaName":"\u6d59\u6c5f\u53f0\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-02-23 20:22:56","ftime":"2014-02-23 20:22:56","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u6cb3\u5357\u90d1\u5dde\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-02-26 15:10:45","ftime":"2014-02-26 15:10:45","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u89c2\u5170\u6c7d\u8f66\u7ad9\u5206\u90e8","time":"2014-03-01 13:17:22","ftime":"2014-03-01 13:17:22","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6e56\u5357\u957f\u6c99\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-08 01:48:36","ftime":"2014-03-08 01:48:36","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u6e56\u5357\u957f\u6c99\u5929\u5fc3\u533a\u91d1\u76c6\u5cad\u516c\u53f8"},{"areaName":"\u5c71\u4e1c\u9752\u5c9b\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-09 18:13:46","ftime":"2014-03-09 18:13:46","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u65b0\u5927\u9e4f\u5206\u90e8","time":"2014-03-17 15:37:41","ftime":"2014-03-17 15:37:41","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"}]';
*/
// $json = '[{"areaName":"\u6d59\u6c5f\u5b81\u6ce2\u911e\u5dde\u533a\u4e1c\u94b1\u6e56\u516c\u53f8","time":"2013-10-24 18:33:35","ftime":"2013-10-24 18:33:35","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-10-25 13:59:10","ftime":"2013-10-25 13:59:10","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5c71\u4e1c\u6d4e\u5357\u5206\u62e8\u4e2d\u5fc3","time":"2013-10-25 21:38:55","ftime":"2013-10-25 21:38:55","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2013-10-26 21:36:17","ftime":"2013-10-26 21:36:17","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u56db\u5ddd\u6210\u90fd\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-10-30 12:06:06","ftime":"2013-10-30 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-10-30 16:02:40","ftime":"2013-10-30 16:02:40","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-11-02 12:06:06","ftime":"2013-11-02 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6df1\u60e0\u4e1c\u65b9\u5353\u8d8a\u5206\u90e8","time":"2013-11-01 13:59:52","ftime":"2013-11-01 13:59:52","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u65b0\u4e2d\u5fc3\u5206\u90e8","time":"2013-11-03 12:06:06","ftime":"2013-11-03 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6c11\u6cbb\u5b9d\u5c71\u5206\u90e8","time":"2013-11-03 12:06:06","ftime":"2013-11-03 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u65f6\u4ee3\u5206\u90e8","time":"2013-11-02 16:55:02","ftime":"2013-11-02 16:55:02","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6c11\u6cbb\u4e0a\u6cb3\u574a\u5206\u90e8","time":"2013-11-06 15:08:45","ftime":"2013-11-06 15:08:45","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u83b2\u4e30\u5206\u90e8","time":"2013-11-09 10:15:28","ftime":"2013-11-09 10:15:28","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u4fdd\u5229\u5206\u90e8","time":"2013-11-11 12:06:06","ftime":"2013-11-11 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 00:20:16","ftime":"2013-11-19 00:20:16","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 01:40:15","ftime":"2013-11-19 01:40:15","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 02:17:29","ftime":"2013-11-19 02:17:29","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-20 12:06:06","ftime":"2013-11-20 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 20:14:12","ftime":"2013-11-19 20:14:12","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-19 20:18:57","ftime":"2013-11-19 20:18:57","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:06:06","ftime":"2013-11-21 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:06:06","ftime":"2013-11-21 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:06:06","ftime":"2013-11-21 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:06:06","ftime":"2013-11-21 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-21 12:06:06","ftime":"2013-11-21 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-23 12:06:06","ftime":"2013-11-23 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-23 12:06:06","ftime":"2013-11-23 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-22 17:43:53","ftime":"2013-11-22 17:43:53","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-24 12:06:06","ftime":"2013-11-24 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2013-11-23 10:47:13","ftime":"2013-11-23 10:47:13","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u9f99\u80dc\u5206\u90e8","time":"2013-11-25 11:23:19","ftime":"2013-11-25 11:23:19","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u9f99\u80dc\u5206\u90e8","time":"2013-11-26 12:06:06","ftime":"2013-11-26 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u77f3\u5ca9\u7530\u5fc3\u77f3\u9f99\u4ed4\u5206\u90e8","time":"2013-11-26 12:06:06","ftime":"2013-11-26 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u65b0\u6d32\u56fd\u901a\u5206\u90e8","time":"2013-11-25 16:11:10","ftime":"2013-11-25 16:11:10","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u4eac\u57fa\u5206\u90e8","time":"2013-11-27 12:06:06","ftime":"2013-11-27 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u4eac\u57fa\u5206\u90e8","time":"2013-11-26 11:48:55","ftime":"2013-11-26 11:48:55","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u4e0a\u6d77\u5d07\u660e\u53bf\u516c\u53f8","time":"2013-11-27 10:56:08","ftime":"2013-11-27 10:56:08","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5e02\u573a\u5f00\u53d1\u90e8-KH0013","time":"2013-11-27 15:16:29","ftime":"2013-11-27 15:16:29","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u77f3\u5ca9\u7530\u5fc3\u6c34\u7530\u5206\u90e8","time":"2013-11-27 17:58:28","ftime":"2013-11-27 17:58:28","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u77f3\u5ca9\u7530\u5fc3\u6c34\u7530\u5206\u90e8","time":"2013-11-27 18:11:20","ftime":"2013-11-27 18:11:20","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u8fbd\u5b81\u9526\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2013-11-28 06:58:53","ftime":"2013-11-28 06:58:53","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u534e\u7f8e\u5206\u90e8","time":"2013-11-29 12:06:06","ftime":"2013-11-29 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u534e\u7f8e\u5206\u90e8","time":"2013-11-29 12:06:06","ftime":"2013-11-29 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-11-28 10:20:45","ftime":"2013-11-28 10:20:45","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u5e7f\u5dde\u603b\u516c\u53f8"},{"areaName":"\u4e0a\u6d77\u5d07\u660e\u53bf\u516c\u53f8","time":"2013-11-29 11:19:26","ftime":"2013-11-29 11:19:26","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u5357\u95e8\u5927\u8d27\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a13816261357"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u91d1\u7a3b\u7530\u5206\u90e8","time":"2013-11-29 14:09:49","ftime":"2013-11-29 14:09:49","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u6c11\u6cbb\u534e\u666f\u5206\u90e8","time":"2013-11-29 14:15:47","ftime":"2013-11-29 14:15:47","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2013-11-29 15:32:36","ftime":"2013-11-29 15:32:36","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u5e03\u5409\u9f99\u6cc9\u5206\u90e8","time":"2013-11-29 16:01:55","ftime":"2013-11-29 16:01:55","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-01 12:06:06","ftime":"2013-12-01 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-01 12:06:06","ftime":"2013-12-01 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u77f3\u5ca9\u7530\u5fc3\u6c34\u7530\u5206\u90e8","time":"2013-11-30 22:33:13","ftime":"2013-11-30 22:33:13","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u8d35\u5dde\u60e0\u6c34\u53bf\u516c\u53f8","time":"2013-12-02 22:08:10","ftime":"2013-12-02 22:08:10","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u7231\u534e\u666e\u6dd8\u5b9d\u5206\u90e8","time":"2013-12-03 16:30:34","ftime":"2013-12-03 16:30:34","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u95ee\u9898\u4ef6\u5904\u7406","time":"2013-12-03 17:40:02","ftime":"2013-12-03 17:40:02","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u7f51\u70b9\u5206\u62e8\u70b9"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u56fa\u620d\u5206\u90e8","time":"2013-12-03 22:57:55","ftime":"2013-12-03 22:57:55","context":"\u8fdb\u884c\u53d1\u51fa\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-04 19:50:07","ftime":"2013-12-04 19:50:07","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-12-06 12:06:06","ftime":"2013-12-06 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2013-12-06 12:06:06","ftime":"2013-12-06 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-07 12:06:06","ftime":"2013-12-07 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u4e2d\u5fc3\u5929\u8679\u5206\u90e8","time":"2013-12-08 12:06:06","ftime":"2013-12-08 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-08 12:06:06","ftime":"2013-12-08 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2013-12-08 12:06:06","ftime":"2013-12-08 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6c5f\u897f\u5357\u660c\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-07 10:22:20","ftime":"2013-12-07 10:22:20","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u65b0\u6d32\u56fd\u901a\u5206\u90e8","time":"2013-12-09 10:45:49","ftime":"2013-12-09 10:45:49","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u7f57\u6e56\u533a\u8349\u57d4\u5206\u90e8","time":"2013-12-10 12:06:06","ftime":"2013-12-10 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u7535\u5b50\u79d1\u6280\u5206\u90e8","time":"2013-12-10 17:10:21","ftime":"2013-12-10 17:10:21","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u6d77\u4e0a\u4e16\u754c\u5206\u90e8","time":"2013-12-10 17:22:15","ftime":"2013-12-10 17:22:15","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5409\u6797\u957f\u6625\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-12 02:06:48","ftime":"2013-12-12 02:06:48","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u9ed1\u9f99\u6c5f\u54c8\u5c14\u6ee8\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-16 16:23:48","ftime":"2013-12-16 16:23:48","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u9ed1\u9f99\u6c5f\u5927\u5e86\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u5e73\u6e56\u534e\u5357\u5206\u90e8","time":"2013-12-22 12:06:06","ftime":"2013-12-22 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5b9d\u5b89\u533a\u9ec4\u9ebb\u5e03\u5206\u90e8","time":"2013-12-25 13:17:54","ftime":"2013-12-25 13:17:54","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5929\u6d25\u5206\u62e8\u4e2d\u5fc3","time":"2013-12-30 04:04:51","ftime":"2013-12-30 04:04:51","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5929\u6d25\u897f\u9752\u533a\u6d77\u6cf0\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u5e03\u5409\u5357\u5cad\u5206\u90e8","time":"2014-01-02 12:06:06","ftime":"2014-01-02 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-01 22:31:53","ftime":"2014-01-01 22:31:53","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u9f99\u534e\u5927\u6da6\u53d1\u4e2d\u5fc3\u5206\u90e8","time":"2014-01-03 16:33:02","ftime":"2014-01-03 16:33:02","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-08 12:06:06","ftime":"2014-01-08 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6e05\u8fdc\u516c\u53f8","time":"2014-01-10 13:31:50","ftime":"2014-01-10 13:31:50","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a400-821-6789"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-16 12:06:06","ftime":"2014-01-16 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-01-18 12:06:06","ftime":"2014-01-18 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-17 17:19:45","ftime":"2014-01-17 17:19:45","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 10:45:41","ftime":"2014-01-20 10:45:41","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 11:29:32","ftime":"2014-01-20 11:29:32","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 11:49:17","ftime":"2014-01-20 11:49:17","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 16:03:22","ftime":"2014-01-20 16:03:22","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 16:18:29","ftime":"2014-01-20 16:18:29","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:16:28","ftime":"2014-01-20 17:16:28","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:19:56","ftime":"2014-01-20 17:19:56","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:30:00","ftime":"2014-01-20 17:30:00","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u7f51\u70b9\u7a0b\u5e8f\u6d4b\u8bd5","time":"2014-01-20 17:42:03","ftime":"2014-01-20 17:42:03","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"},{"areaName":"\u6d59\u6c5f\u8427\u5c71\u5206\u62e8\u4e2d\u5fc3","time":"2014-01-20 21:39:07","ftime":"2014-01-20 21:39:07","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u6d59\u6c5f\u676d\u5dde\u8427\u5c71\u533a\u65b0\u8857\u516c\u53f8"},{"areaName":"\u6c5f\u82cf\u5b9c\u5174\u516c\u53f8","time":"2014-01-27 12:06:06","ftime":"2014-01-27 12:06:06","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2014-02-10 20:20:33","ftime":"2014-02-10 20:20:33","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u798f\u7530\u533a\u660e\u901a\u5206\u90e8","time":"2014-02-10 20:22:43","ftime":"2014-02-10 20:22:43","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u5e03\u5409\u767e\u76db\u5206\u90e8","time":"2014-02-11 12:06:06","ftime":"2014-02-11 12:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-02-12 15:20:12","ftime":"2014-02-12 15:20:12","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u5357\u5c71\u533a\u5927\u65b0\u4e00\u7532\u5206\u90e8","time":"2014-02-14 12:17:29","ftime":"2014-02-14 12:17:29","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-02-18 02:33:45","ftime":"2014-02-18 02:33:45","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5c71\u4e1c\u6d4e\u5357\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u798f\u5efa\u798f\u6e05\u5e02\u516c\u53f8","time":"2014-02-21 15:41:49","ftime":"2014-02-21 15:41:49","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u798f\u5efa\u798f\u6e05\u5e02\u516c\u53f8\u5b8f\u8def\u5206\u90e8"},{"areaName":"\u6d59\u6c5f\u53f0\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-02-23 20:22:56","ftime":"2014-02-23 20:22:56","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u6cb3\u5357\u90d1\u5dde\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8","time":"2014-02-26 15:10:45","ftime":"2014-02-26 15:10:45","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u533a\u89c2\u5170\u6c7d\u8f66\u7ad9\u5206\u90e8","time":"2014-03-01 13:17:22","ftime":"2014-03-01 13:17:22","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6e56\u5357\u957f\u6c99\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-08 01:48:36","ftime":"2014-03-08 01:48:36","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u6e56\u5357\u957f\u6c99\u5929\u5fc3\u533a\u91d1\u76c6\u5cad\u516c\u53f8"},{"areaName":"\u5c71\u4e1c\u9752\u5c9b\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-09 18:13:46","ftime":"2014-03-09 18:13:46","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u6df1\u5733\u516c\u53f8\u9f99\u5c97\u65b0\u5927\u9e4f\u5206\u90e8","time":"2014-03-17 15:37:41","ftime":"2014-03-17 15:37:41","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"}]';
// $json = '[{"areaName":"\u5317\u4eac\u901a\u5dde\u6f5e\u57ce","time":"2014-04-14 19:53:00","ftime":"2014-04-14 19:53:00","context":"\u5317\u4eac\u901a\u5dde\u6f5e\u57ce(\u5218\u5c0f\u4e4918001275181) \u5df2\u6536\u4ef6 \u8fdb\u5165\u516c\u53f8\u5206\u6361"},{"areaName":"\u5317\u4eac\u901a\u5dde\u6f5e\u57ce","time":"2014-04-14 20:35:13","ftime":"2014-04-14 20:35:13","context":"\u5feb\u4ef6\u79bb\u5f00 \u5317\u4eac\u901a\u5dde\u6f5e\u57ce \u5df2\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5317\u4eac\u5e02\u5185\u90e8","time":"2014-04-14 22:05:01","ftime":"2014-04-14 22:05:01","context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u5e02\u5185\u90e8 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac\u901a\u5dde\u6f5e\u57ce"},{"areaName":"\u5317\u4eac\u5e02\u5185\u90e8","time":"2014-04-14 22:37:48","ftime":"2014-04-14 22:37:48","context":"\u5feb\u4ef6\u79bb\u5f00 \u5317\u4eac\u5e02\u5185\u90e8 \u5df2\u53d1\u5f80\u5317\u4eac\u4e2d\u5173\u6751"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-04-15 06:47:11","ftime":"2014-04-15 06:47:11","context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u4e2d\u5173\u6751 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-04-15 08:26:14","ftime":"2014-04-15 08:26:14","context":"\u6768\u6653\u5b87 \u6b63\u5728\u6d3e\u4ef6\u4e2d"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-04-15 10:45:46","ftime":"2014-04-15 10:45:46","context":"\u7b7e\u6536\u4eba\u662f \u62cd\u7167\u7b7e\u6536"}]';
// $json = '[{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 19:06:06","ftime":"2014-03-27 19:06:06","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 19:45:49","ftime":"2014-03-27 19:45:49","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u7f51\u70b9\u5305"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 19:53:15","ftime":"2014-03-27 19:53:15","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:26:21","ftime":"2014-03-28 00:26:21","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:27:07","ftime":"2014-03-28 00:27:07","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 00:48:20","ftime":"2014-03-29 00:48:20","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 02:20:57","ftime":"2014-03-29 02:20:57","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 02:40:54","ftime":"2014-03-29 02:40:54","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5317\u4eac\u6d77\u6dc0\u533a\u4e2d\u5173\u6751\u516c\u53f8"},{"areaName":"\u5317\u4eac\u6d77\u6dc0\u533a\u4e2d\u5173\u6751\u516c\u53f8","time":"2014-03-29 04:59:04","ftime":"2014-03-29 04:59:04","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf"},{"areaName":"\u5317\u4eac\u6d77\u6dc0\u533a\u4e2d\u5173\u6751\u516c\u53f8","time":"2014-03-29 07:56:36","ftime":"2014-03-29 07:56:36","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5317\u4eac\u6d77\u6dc0\u533a\u4e2d\u5173\u6751\u516c\u53f8","time":"2014-03-31 08:22:52","ftime":"2014-03-31 08:22:52","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u5f20\u4e1c\u6ce2\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a13146735677"},{"areaName":"\u5317\u4eac\u6d77\u6dc0\u533a\u4e2d\u5173\u6751\u516c\u53f8","time":"2014-03-31 20:20:30","ftime":"2014-03-31 20:20:30","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"}]';
// $json = '[{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 19:12:41","ftime":"2014-03-27 19:12:41","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 20:10:36","ftime":"2014-03-27 20:10:36","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u7f51\u70b9\u5305"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 20:18:33","ftime":"2014-03-27 20:18:33","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:26:26","ftime":"2014-03-28 00:26:26","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:27:13","ftime":"2014-03-28 00:27:13","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:10:49","ftime":"2014-03-29 01:10:49","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:14:14","ftime":"2014-03-29 01:14:14","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:23:06","ftime":"2014-03-29 01:23:06","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 01:57:37","ftime":"2014-03-29 01:57:37","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 01:58:16","ftime":"2014-03-29 01:58:16","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 08:31:35","ftime":"2014-03-29 08:31:35","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u845b\u4f1a\u5efa\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a15810992871"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 14:19:15","ftime":"2014-03-29 14:19:15","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"}]';
// $json = '[{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u82b1\u90fd\u533a\u65b0\u534e\u516c\u53f8","time":"2014-04-22 21:22:21","ftime":"2014-04-22 21:22:21","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u82b1\u90fd\u533a\u65b0\u534e\u516c\u53f8","time":"2014-04-23 01:42:18","ftime":"2014-04-23 01:42:18","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u6d59\u6c5f\u676d\u5dde\u7f51\u70b9\u5305"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-23 03:10:07","ftime":"2014-04-23 03:10:07","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-23 03:13:29","ftime":"2014-04-23 03:13:29","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u6d59\u6c5f\u676d\u5dde\u5206\u62e8\u4e2d\u5fc3"}]';
// $json = '[{"areaName":"\u5927\u540c","time":"2014-03-20 20:49:36","ftime":"2014-03-20 20:49:36","context":"\u5feb\u4ef6\u5230\u8fbe \u5927\u540c \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5e7f\u5dde\u4e2d\u5fc3"}]';
// $json = '[{"areaName":"\u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9","time":"2014-04-24 23:32:01","ftime":"2014-04-24 23:32:01","context":"\u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9(\u4f58\u559c\u5f6c) \u5df2\u6536\u4ef6 \u8fdb\u5165\u516c\u53f8\u5206\u6361"},{"areaName":"\u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9","time":"2014-04-25 00:42:24","ftime":"2014-04-25 00:42:24","context":"\u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9() \u5df2\u6536\u4ef6 \u8fdb\u5165\u516c\u53f8\u5206\u6361"},{"areaName":"\u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9","time":"2014-04-25 00:43:54","ftime":"2014-04-25 00:43:54","context":"\u5feb\u4ef6\u79bb\u5f00 \u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9 \u5df2\u53d1\u5f80\u5e7f\u4e1c\u4e2d\u5fc3"},{"areaName":"\u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9","time":"2014-04-25 00:44:55","ftime":"2014-04-25 00:44:55","context":"\u5728 \u65b0\u5e7f\u5dde\u4e2d\u4fe1\u7ad9 \u88c5\u5305\u5e76\u53d1\u5f80\u5e7f\u5dde\u4e2d\u5fc3"},{"areaName":"\u5e7f\u5dde\u4e2d\u5fc3","time":"2014-04-25 05:19:32","ftime":"2014-04-25 05:19:32","context":"\u5728 \u5e7f\u5dde\u4e2d\u5fc3 \u88c5\u5305\u5e76\u53d1\u5f80\u5e7f\u4e1c\u4e2d\u5fc3"},{"areaName":"\u5e7f\u5dde\u4e2d\u5fc3","time":"2014-04-25 06:42:45","ftime":"2014-04-25 06:42:45","context":"\u5feb\u4ef6\u79bb\u5f00 \u5e7f\u5dde\u4e2d\u5fc3 \u5df2\u53d1\u5f80\u90d1\u5dde\u4e2d\u8f6c"},{"areaName":"\u5e7f\u5dde\u4e2d\u5fc3","time":"2014-04-25 06:46:53","ftime":"2014-04-25 06:46:53","context":"\u5feb\u4ef6\u79bb\u5f00 \u5e7f\u5dde\u4e2d\u5fc3 \u5df2\u53d1\u5f80\u90d1\u5dde"},{"areaName":"\u5e7f\u5dde\u4e2d\u5fc3","time":"2014-04-25 06:47:34","ftime":"2014-04-25 06:47:34","context":"\u5728 \u5e7f\u5dde\u4e2d\u5fc3 \u88c5\u5305\u5e76\u53d1\u5f80\u90d1\u5dde\u4e2d\u8f6c"},{"areaName":"\u5e7f\u5dde\u4e2d\u5fc3","time":"2014-04-25 06:48:07","ftime":"2014-04-25 06:48:07","context":"\u5728 \u5e7f\u5dde\u4e2d\u5fc3 \u88c5\u5305\u5e76\u53d1\u5f80\u90d1\u5dde\u4e2d\u8f6c"}]';
// $json = '[{"areaName":"\u6cb3\u5357\u5357\u9633\u516c\u53f8\u6dc5\u5ddd\u53bf\u5206\u90e8","time":"2014-04-24 12:59:13","ftime":"2014-04-24 12:59:13","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6cb3\u5357\u5357\u9633\u516c\u53f8","time":"2014-04-24 19:26:58","ftime":"2014-04-24 19:26:58","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u6c5f\u82cf\u82cf\u5dde\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u6cb3\u5357\u5357\u9633\u516c\u53f8","time":"2014-04-24 19:36:04","ftime":"2014-04-24 19:36:04","context":"\u8fdb\u884c\u53d1\u51fa\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u6cb3\u5357\u90d1\u5dde\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u6cb3\u5357\u5357\u9633\u516c\u53f8","time":"2014-04-24 19:36:42","ftime":"2014-04-24 19:36:42","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6cb3\u5357\u90d1\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-25 01:43:37","ftime":"2014-04-25 01:43:37","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u6cb3\u5357\u90d1\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-25 01:45:07","ftime":"2014-04-25 01:45:07","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u6c5f\u82cf\u82cf\u5dde\u5206\u62e8\u4e2d\u5fc3"}]';
// $json = '{"mailno":"1201260015053","result":"true","time":"2014-04-25 14:55:11","remark":"韵达快运 SERVER-R,查询接口中仅保留最近30天内的数据，如需要查询更早的记录，请访问韵达官方网站：www.yundaex.com ，谢谢！","status":"transit","weight":"","steps":[{"time":"2014-04-24 12:59:13","address":"河南南阳公司淅川县分部","station":"473013","station_phone":"0377-65051599","status":"got","remark":"进行揽件扫描","next":"","next_name":""},{"time":"2014-04-24 19:26:58","address":"河南南阳公司","station":"473000","station_phone":"0377-63063500","status":"next","remark":"进行下级地点扫描，将发往：江苏苏州分拨中心","next":"215120","next_name":"江苏苏州分拨中心"},{"time":"2014-04-24 19:36:04","address":"河南南阳公司","station":"473000","station_phone":"0377-63063500","status":"out","remark":"进行发出扫描，将发往：河南郑州分拨中心","next":"450000","next_name":"河南郑州分拨中心"},{"time":"2014-04-24 19:36:42","address":"河南南阳公司","station":"473000","station_phone":"0377-63063500","status":"got","remark":"进行揽件扫描","next":"","next_name":""},{"time":"2014-04-25 01:43:37","address":"河南郑州分拨中心","station":"450000","station_phone":"","status":"weight","remark":"在分拨中心进行称重扫描","next":"","next_name":""},{"time":"2014-04-25 01:45:07","address":"河南郑州分拨中心","station":"450000","station_phone":"","status":"out","remark":"进行装车扫描，即将发往：江苏苏州分拨中心","next":"215120","next_name":"江苏苏州分拨中心"}]}';
// $json = '{"mailno":"1201270313491","result":"true","time":"2014-04-25 15:22:01","remark":"韵达快运,未查询到记录！查询接口中仅保留最近30天内的数据，如需要查询更早的记录，请访问韵达官方网站：www.yundaex.com ，谢谢！","status":"","weight":"","steps":[]}';
// $json =  '{"traces":[{"acceptAddress":"","acceptTime":"","remark":""}]}';
// $json = '[{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5434\u4e2d\u533a\u8d8a\u6eaa\u9547\u516c\u53f8","time":"2014-04-25 19:53:21","ftime":"2014-04-25 19:53:21","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5434\u4e2d\u533a\u8d8a\u6eaa\u9547\u516c\u53f8","time":"2014-04-25 20:35:05","ftime":"2014-04-25 20:35:05","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u6d59\u6c5f\u676d\u5dde\u7f51\u70b9\u5305"},{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5434\u4e2d\u533a\u8d8a\u6eaa\u9547\u516c\u53f8","time":"2014-04-25 20:40:43","ftime":"2014-04-25 20:40:43","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-25 22:36:00","ftime":"2014-04-25 22:36:00","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u6c5f\u82cf\u82cf\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-25 22:38:31","ftime":"2014-04-25 22:38:31","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u6d59\u6c5f\u676d\u5dde\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-26 03:03:05","ftime":"2014-04-26 03:03:05","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-26 03:05:09","ftime":"2014-04-26 03:05:09","context":"\u5feb\u4ef6\u8fdb\u5165\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5206\u62e8"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-26 04:14:39","ftime":"2014-04-26 04:14:39","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8","time":"2014-04-26 06:21:03","ftime":"2014-04-26 06:21:03","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8\u4e16\u8d38\u5206\u90e8"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8\u4e16\u8d38\u5206\u90e8","time":"2014-04-26 08:20:26","ftime":"2014-04-26 08:20:26","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8\u4e16\u8d38\u5206\u90e8","time":"2014-04-26 08:27:49","ftime":"2014-04-26 08:27:49","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8\u4e16\u8d38\u5206\u90e8"},{"areaName":"\u6d59\u6c5f\u676d\u5dde\u6c5f\u5e72\u533a\u4e0b\u6c99\u52a0\u5de5\u533a\u516c\u53f8\u4e16\u8d38\u5206\u90e8","time":"2014-04-26 12:42:29","ftime":"2014-04-26 12:42:29","context":"\u5feb\u4ef6\u5df2\u88ab \u90ae\u4ef6\u6536\u53d1\u7ae0 \u7b7e\u6536"}]';
// $json = '[{"areaName":"\u5e7f\u4e1c\u9ad8\u660e\u533a\u516c\u53f8\u4e5d\u6c5f\u5206\u90e8","time":"2014-04-26 19:38:50","ftime":"2014-04-26 19:38:50","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-27 00:11:26","ftime":"2014-04-27 00:11:26","context":"\u5feb\u4ef6\u8fdb\u5165\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5206\u62e8"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-27 06:48:19","ftime":"2014-04-27 06:48:19","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5e7f\u4e1c\u5e7f\u5dde\u767d\u4e91\u533a\u516c\u53f8"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u767d\u4e91\u533a\u516c\u53f8","time":"2014-04-27 11:39:02","ftime":"2014-04-27 11:39:02","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u767d\u4e91\u533a\u516c\u53f8","time":"2014-04-27 12:53:10","ftime":"2014-04-27 12:53:10","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u6731\u6d69\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a15913190504"},{"areaName":"\u5e7f\u4e1c\u5e7f\u5dde\u767d\u4e91\u533a\u516c\u53f8","time":"2014-04-27 18:18:16","ftime":"2014-04-27 18:18:16","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"}]';
// $json = '[{"areaName":"\u6d4f\u9633","time":"2014-04-23 19:58:00","ftime":"2014-04-23 19:58:00","context":"\u5feb\u4ef6\u5230\u8fbe \u6d4f\u9633 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u6d4f\u9633\u4e00\u90e8"},{"areaName":"\u957f\u6c99\u4e2d\u8f6c\u90e8","time":"2014-04-24 00:00:18","ftime":"2014-04-24 00:00:18","context":"\u5feb\u4ef6\u5230\u8fbe \u957f\u6c99\u4e2d\u8f6c\u90e8 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u6d4f\u9633"},{"areaName":"\u957f\u6c99\u4e2d\u8f6c\u90e8","time":"2014-04-24 00:04:34","ftime":"2014-04-24 00:04:34","context":"\u5feb\u4ef6\u79bb\u5f00 \u957f\u6c99\u4e2d\u8f6c\u90e8 \u5df2\u53d1\u5f80\u91d1\u534e\u4e2d\u8f6c\u90e8"},{"areaName":"\u957f\u6c99\u4e2d\u8f6c\u90e8","time":"2014-04-24 00:07:46","ftime":"2014-04-24 00:07:46","context":"\u5728 \u957f\u6c99\u4e2d\u8f6c\u90e8 \u88c5\u5305\u5e76\u53d1\u5f80\u91d1\u534e\u4e2d\u8f6c\u90e8"},{"areaName":"\u957f\u6c99\u4e2d\u8f6c\u90e8","time":"2014-04-24 00:38:47","ftime":"2014-04-24 00:38:47","context":"\u5728 \u957f\u6c99\u4e2d\u8f6c\u90e8 \u88c5\u5305\u5e76\u53d1\u5f80\u91d1\u534e\u4e2d\u8f6c\u90e8"},{"areaName":"\u91d1\u534e\u4e2d\u8f6c\u90e8","time":"2014-04-24 19:06:35","ftime":"2014-04-24 19:06:35","context":"\u6240\u5728\u5305 \u5230\u8fbe\u91d1\u534e\u4e2d\u8f6c\u90e8 "},{"areaName":"\u91d1\u534e\u4e2d\u8f6c\u90e8","time":"2014-04-24 19:18:49","ftime":"2014-04-24 19:18:49","context":"\u5feb\u4ef6\u5230\u8fbe \u91d1\u534e\u4e2d\u8f6c\u90e8 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u91d1\u534e\u4e2d\u8f6c\u90e8"},{"areaName":"\u91d1\u534e\u4e2d\u8f6c\u90e8","time":"2014-04-24 19:26:20","ftime":"2014-04-24 19:26:20","context":"\u5feb\u4ef6\u79bb\u5f00 \u91d1\u534e\u4e2d\u8f6c\u90e8 \u5df2\u53d1\u5f80\u8862\u5dde"},{"areaName":"\u8862\u5dde","time":"2014-04-25 07:59:15","ftime":"2014-04-25 07:59:15","context":"\u5feb\u4ef6\u5230\u8fbe \u8862\u5dde \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u91d1\u534e\u4e2d\u8f6c\u90e8"},{"areaName":"\u8862\u5dde","time":"2014-04-25 08:38:57","ftime":"2014-04-25 08:38:57","context":"\u4e1c\u6e2f\u6c88\u5bb6\u5206\u90e8 \u6b63\u5728\u6d3e\u4ef6\u4e2d"},{"areaName":"\u8862\u5dde","time":"2014-04-25 13:05:11","ftime":"2014-04-25 13:05:11","context":"\u7b7e\u6536\u4eba\u662f \u62cd\u7167\u7b7e\u6536"}]';
// $json = '[{"areaName":"\u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8","time":"2014-03-27 20:26:24","ftime":"2014-03-27 20:26:24","context":"\u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8(\u7ee3\u574a) \u5df2\u6536\u4ef6 \u8fdb\u5165\u516c\u53f8\u5206\u6361"},{"areaName":"\u5357\u4eac\u6c5f\u5b81\u533a","time":"2014-03-27 20:26:56","ftime":"2014-03-27 20:26:56","context":"\u5feb\u4ef6\u5230\u8fbe \u5357\u4eac\u6c5f\u5b81\u533a \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u6c5f\u5b81\u5f00\u53d1\u533a\u4e09\u90e8"},{"areaName":"\u5357\u4eac\u6c5f\u5b81\u533a","time":"2014-03-27 21:30:36","ftime":"2014-03-27 21:30:36","context":"\u5feb\u4ef6\u79bb\u5f00 \u5357\u4eac\u6c5f\u5b81\u533a \u5df2\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5357\u4eac\u6c5f\u5b81\u533a","time":"2014-03-27 21:35:58","ftime":"2014-03-27 21:35:58","context":"\u5728 \u5357\u4eac\u6c5f\u5b81\u533a \u88c5\u5305\u5e76\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5357\u4eac\u4e2d\u8f6c\u90e8","time":"2014-03-27 22:59:42","ftime":"2014-03-27 22:59:42","context":"\u6240\u5728\u5305 \u5230\u8fbe\u5357\u4eac\u4e2d\u8f6c\u90e8 "},{"areaName":"\u5357\u4eac\u4e2d\u8f6c\u90e8","time":"2014-03-27 23:00:27","ftime":"2014-03-27 23:00:27","context":"\u5728 \u5357\u4eac\u4e2d\u8f6c\u90e8 \u88c5\u5305\u5e76\u53d1\u5f80\u5317\u4eac"},{"areaName":"\u5317\u4eac\u5e02\u5185\u90e8","time":"2014-03-28 16:09:49","ftime":"2014-03-28 16:09:49","context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u5e02\u5185\u90e8 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac"},{"areaName":"\u5317\u4eac\u5e02\u5185\u90e8","time":"2014-03-29 04:01:52","ftime":"2014-03-29 04:01:52","context":"\u5feb\u4ef6\u79bb\u5f00 \u5317\u4eac\u5e02\u5185\u90e8 \u5df2\u53d1\u5f80\u5317\u4eac\u4e2d\u5173\u6751"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 06:57:35","ftime":"2014-03-29 06:57:35","context":"\u5feb\u4ef6\u5230\u8fbe \u5317\u4eac\u4e2d\u5173\u6751 \u6b63\u5728\u5206\u6361\u4e2d \u4e0a\u4e00\u7ad9\u662f \u5317\u4eac"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 08:33:08","ftime":"2014-03-29 08:33:08","context":"\u4f55\u4e49\u6625 \u6b63\u5728\u6d3e\u4ef6\u4e2d"},{"areaName":"\u5317\u4eac\u4e2d\u5173\u6751","time":"2014-03-29 09:47:45","ftime":"2014-03-29 09:47:45","context":"\u7b7e\u6536\u4eba\u662f \u62cd\u7167\u7b7e\u6536"}]';
// $json = '[{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 19:12:41","ftime":"2014-03-27 19:12:41","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 20:10:36","ftime":"2014-03-27 20:10:36","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u7f51\u70b9\u5305"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 20:18:33","ftime":"2014-03-27 20:18:33","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:26:26","ftime":"2014-03-28 00:26:26","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:27:13","ftime":"2014-03-28 00:27:13","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:10:49","ftime":"2014-03-29 01:10:49","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:14:14","ftime":"2014-03-29 01:14:14","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:23:06","ftime":"2014-03-29 01:23:06","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 01:57:37","ftime":"2014-03-29 01:57:37","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 01:58:16","ftime":"2014-03-29 01:58:16","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 08:31:35","ftime":"2014-03-29 08:31:35","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u845b\u4f1a\u5efa\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a15810992871"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 14:19:15","ftime":"2014-03-29 14:19:15","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"}]';
// $json = '[{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 19:12:41","ftime":"2014-03-27 19:12:41","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 20:10:36","ftime":"2014-03-27 20:10:36","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u7f51\u70b9\u5305"},{"areaName":"\u4e0a\u6d77\u5f90\u6c47\u533a\u9f99\u534e\u516c\u53f8","time":"2014-03-27 20:18:33","ftime":"2014-03-27 20:18:33","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:26:26","ftime":"2014-03-28 00:26:26","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u4e0a\u6d77\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-28 00:27:13","ftime":"2014-03-28 00:27:13","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:10:49","ftime":"2014-03-29 01:10:49","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:14:14","ftime":"2014-03-29 01:14:14","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-03-29 01:23:06","ftime":"2014-03-29 01:23:06","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 01:57:37","ftime":"2014-03-29 01:57:37","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 01:58:16","ftime":"2014-03-29 01:58:16","context":"\u8fdb\u884c\u5feb\u4ef6\u626b\u63cf"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 08:31:35","ftime":"2014-03-29 08:31:35","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u845b\u4f1a\u5efa\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a15810992871"},{"areaName":"\u5317\u4eac\u897f\u57ce\u533a\u5fb7\u80dc\u95e8\u516c\u53f8","time":"2014-03-29 14:19:15","ftime":"2014-03-29 14:19:15","context":"\u5feb\u4ef6\u5df2\u88ab \u56fe\u7247 \u7b7e\u6536"}]';
// $json = '[{"areaName":"\u6e56\u5317\u6b66\u6c49\u6c5f\u6c49\u533a\u65b0\u6b66\u5e7f\u516c\u53f8","time":"2014-04-27 22:47:09","ftime":"2014-04-27 22:47:09","context":"\u8fdb\u884c\u63fd\u4ef6\u626b\u63cf"},{"areaName":"\u6e56\u5317\u6b66\u6c49\u6c5f\u6c49\u533a\u65b0\u6b66\u5e7f\u516c\u53f8","time":"2014-04-27 23:55:00","ftime":"2014-04-27 23:55:00","context":"\u8fdb\u884c\u4e0b\u7ea7\u5730\u70b9\u626b\u63cf\uff0c\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u7f51\u70b9\u5305"},{"areaName":"\u6e56\u5317\u6b66\u6c49\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-28 02:41:15","ftime":"2014-04-28 02:41:15","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u79f0\u91cd\u626b\u63cf"},{"areaName":"\u6e56\u5317\u6b66\u6c49\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-28 02:43:48","ftime":"2014-04-28 02:43:48","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a"},{"areaName":"\u6e56\u5317\u6b66\u6c49\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-28 02:44:24","ftime":"2014-04-28 02:44:24","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u6cb3\u5317\u77f3\u5bb6\u5e84\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u6cb3\u5317\u77f3\u5bb6\u5e84\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-28 19:50:14","ftime":"2014-04-28 19:50:14","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u6cb3\u5317\u77f3\u5bb6\u5e84\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-28 20:33:01","ftime":"2014-04-28 20:33:01","context":"\u8fdb\u884c\u88c5\u8f66\u626b\u63cf\uff0c\u5373\u5c06\u53d1\u5f80\uff1a\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-29 04:55:12","ftime":"2014-04-29 04:55:12","context":"\u5728\u5206\u62e8\u4e2d\u5fc3\u8fdb\u884c\u5378\u8f66\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-29 07:06:09","ftime":"2014-04-29 07:06:09","context":"\u8fdb\u884c\u5927\u5305\u62c6\u5305\u626b\u63cf"},{"areaName":"\u5317\u4eac\u5206\u62e8\u4e2d\u5fc3","time":"2014-04-29 08:06:52","ftime":"2014-04-29 08:06:52","context":"\u4ece\u7ad9\u70b9\u53d1\u51fa\uff0c\u672c\u6b21\u8f6c\u8fd0\u76ee\u7684\u5730\uff1a\u5317\u4eac\u901a\u5dde\u533a\u4eac\u9a70\u516c\u53f8"},{"areaName":"\u5317\u4eac\u901a\u5dde\u533a\u4eac\u9a70\u516c\u53f8","time":"2014-04-29 12:54:15","ftime":"2014-04-29 12:54:15","context":"\u5230\u8fbe\u76ee\u7684\u5730\u7f51\u70b9\uff0c\u5feb\u4ef6\u5c06\u5f88\u5feb\u8fdb\u884c\u6d3e\u9001"},{"areaName":"\u5317\u4eac\u901a\u5dde\u533a\u4eac\u9a70\u516c\u53f8","time":"2014-04-29 13:14:44","ftime":"2014-04-29 13:14:44","context":"\u8fdb\u884c\u6d3e\u4ef6\u626b\u63cf\uff1b\u6d3e\u9001\u4e1a\u52a1\u5458\uff1a\u675c\u6d0b\uff1b\u8054\u7cfb\u7535\u8bdd\uff1a13311267612"}]';
$var = json_decode($json,1);

// echo count($var['traces']);

// if($var['steps'])
// {
// 	echo '有值';
// }
// else  {
// 	echo '无值';
// }
printInfo($var);
exit;




$a = 0;
if(isset($a)) { 
	echo 'isset true';
}
if (empty($a)) {
	echo 'empty is true';
}
exit;

var_dump(file_exists("/Users/cui/Downloads/280105276554264.jpg"));
exit;


$str = '{"data":{"code":"0","info":[{"shop_id":"100421","shop_name":"\u82b1\u975e\u82b1","count":1,"goods":[{"sid":"19738374","amount":"1","user_id":"49068371","goods_id":"103559885","twitter_id":"2742538605","goods_title":"\u6d4b\u8bd5\u5e73\u53f0\u4f18\u60e0\u5238\u8d2d\u4e70\u529f\u80fd\u6d4b\u8bd5\u5b9d\u8d1d\u4e4b2 1000-1","b_pic_url":"http:\/\/imgst-dl.meilishuo.net\/pic\/b\/bb\/a9\/b05a357e7bc719d36b4a27a3f92f_640_900.c6.jpg","goods_activity_price":"0.01","prop":[{"name":"\u79cd\u7c7b","value":"\u6ee1100\u51cf30","is_show":"1"},{"name":"\u8bf4\u660e","value":"\u6bcf\u7528\u6237ID\u9650\u8d2d\u4e00\u4ef6","is_show":"1"}],"stock":"1","shelf":"1","discount":"10.0","ac_type":"1","goods_promote":{"promote":{"type":"\u9650\u65f6\u6298\u6263","current_time":1397468059,"end_time":1399477041}}}],"total_price":"0.01","qq":"2035362761","im":{"qq":"2035362761","type":2,"shop_id":"100421"},"coupon_info":[],"shop_promote":{"coupon_promote":{"type":"\u5e97\u94fa\u4f18\u60e0\u5238","text":"\u672c\u5e97\u4f18\u60e0\uff1a\u53ef\u98862\u5f20\u4f18\u60e0\u5238 \u6700\u591a\u53ef\u77015\u5143"}},"freight":"\u514d\u8fd0\u8d39"}],"total_num":"1","url":"meilishuo:\/\/openURL.meilishuo?json_params=%7B%22url%22%3A%22http%3A%5C%2F%5C%2Fmlab2.meilishuo.com%5C%2Factivity%5C%2Fsummer_match%5C%2Fmatch%5C%2F%3Fac_id%3D1%26channel_id%3D2%22%2C%22inApp%22%3A%221%22%2C%22require_app_info%22%3A%221%22%7D"},"r":"cart-list"}';
$str = '{"data":{"code":"0","info":[{"shop_id":"100421","shop_name":"\u82b1\u975e\u82b1","count":1,"goods":[{"sid":"19738374","amount":"1","user_id":"49068371","goods_id":"103559885","twitter_id":"2742538605","goods_title":"\u6d4b\u8bd5\u5e73\u53f0\u4f18\u60e0\u5238\u8d2d\u4e70\u529f\u80fd\u6d4b\u8bd5\u5b9d\u8d1d\u4e4b2 1000-1","b_pic_url":"http:\/\/imgst-dl.meilishuo.net\/pic\/b\/bb\/a9\/b05a357e7bc719d36b4a27a3f92f_640_900.c6.jpg","goods_activity_price":"0.01","prop":[{"name":"\u79cd\u7c7b","value":"\u6ee1100\u51cf30","is_show":"1"},{"name":"\u8bf4\u660e","value":"\u6bcf\u7528\u6237ID\u9650\u8d2d\u4e00\u4ef6","is_show":"1"}],"stock":"1","shelf":"1","discount":"10.0","ac_type":"1","goods_promote":[{"type":"\u9650\u65f6\u6298\u6263","current_time":1397469810,"end_time":1399477041}]}],"total_price":"0.01","qq":"2035362761","im":{"qq":"2035362761","type":2,"shop_id":"100421"},"coupon_info":[],"shop_promote":[{"type":"\u5e97\u94fa\u4f18\u60e0\u5238","text":"\u672c\u5e97\u4f18\u60e0\uff1a\u53ef\u98862\u5f20\u4f18\u60e0\u5238 \u6700\u591a\u53ef\u77015\u5143"}],"freight":"\u514d\u8fd0\u8d39"}],"total_num":"1","url":"meilishuo:\/\/openURL.meilishuo?json_params=%7B%22url%22%3A%22http%3A%5C%2F%5C%2Fmlab2.meilishuo.com%5C%2Factivity%5C%2Fsummer_match%5C%2Fmatch%5C%2F%3Fac_id%3D1%26channel_id%3D2%22%2C%22inApp%22%3A%221%22%2C%22require_app_info%22%3A%221%22%7D"},"r":"cart-list"}';
$str = '{"data":{"code":"0","info":[{"shop_id":"100421","shop_name":"\u82b1\u975e\u82b1","count":1,"goods":[{"sid":"19738374","amount":"1","user_id":"49068371","goods_id":"103559885","twitter_id":"2742538605","goods_title":"\u6d4b\u8bd5\u5e73\u53f0\u4f18\u60e0\u5238\u8d2d\u4e70\u529f\u80fd\u6d4b\u8bd5\u5b9d\u8d1d\u4e4b2 1000-1","b_pic_url":"http:\/\/imgst-dl.meilishuo.net\/pic\/b\/bb\/a9\/b05a357e7bc719d36b4a27a3f92f_640_900.c6.jpg","goods_activity_price":"0.01","prop":[{"name":"\u79cd\u7c7b","value":"\u6ee1100\u51cf30","is_show":"1"},{"name":"\u8bf4\u660e","value":"\u6bcf\u7528\u6237ID\u9650\u8d2d\u4e00\u4ef6","is_show":"1"}],"stock":"1","shelf":"1","discount":"10.0","ac_type":"1","goods_promote":[{"type":"discount","title":"\u9650\u65f610.0\u6298\uff1a","current_time":1397476067,"end_time":1399477041}]}],"total_price":"0.01","qq":"2035362761","im":{"qq":"2035362761","type":2,"shop_id":"100421"},"coupon_info":[],"shop_promote":[{"type":"shop_coupon","text":"\u672c\u5e97\u4f18\u60e0\uff1a\u53ef\u98862\u5f20\u4f18\u60e0\u5238 \u6700\u591a\u53ef\u77015\u5143"}],"freight":"\u514d\u8fd0\u8d39"}],"total_num":"1","url":"meilishuo:\/\/openURL.meilishuo?json_params=%7B%22url%22%3A%22http%3A%5C%2F%5C%2Fmlab2.meilishuo.com%5C%2Factivity%5C%2Fsummer_match%5C%2Fmatch%5C%2F%3Fac_id%3D1%26channel_id%3D2%22%2C%22inApp%22%3A%221%22%2C%22require_app_info%22%3A%221%22%7D"},"r":"cart-list"}';
print_r(json_decode($str,TRUE));
exit;

$arr = array('a'=>array('0'=>12),'b'=>array('0'=>11),'2'=>array('0'=>11),'3'=>array('0'=>11),'4'=>array('0'=>11),'5'=>array('0'=>11),);
$tmp = array_keys($arr);
printInfo($tmp);
exit;


$sql = "SELECT t2.shop_id,count(t1.record_id) AS refund_num FROM t_bat_mpay_record t1
				LEFT JOIN t_bat_order_refund t2
				ON t1.record_id = t2.rid
				WHERE t1.ctime > ". strtotime(date("Y-m-d", strtotime("-41 day"))) ."
				AND t1.ctime < ". strtotime(date("Y-m-d", strtotime("-40 day"))) ."
				AND t1.type IN (3,4)
				GROUP BY t2.shop_id";
echo $sql ;
exit;

echo date('Ymd His', strtotime('-1 day'));
echo '</br>';
echo strtotime('-1 day');
exit;

// new stdClass()

// 时间戳转换为 天时分秒
function secToHIS($time)
{
$day = floor($time/86400);
$hour = floor(($time-$day*86400)/3600);
$minute = floor(($time - $day*86400 - $hour*3600)/60);
$second = $time - $day*86400 -$hour*3600 - $minute*60;
$result = sprintf("%02d天%02d时%02d分%02d秒",$day, $hour, $minute, $second);
return $result;
}
echo secToHIS(123456);


exit;

$str  = '<html>asdfasdf中国</html>';
$tmp = json_encode($str);
$tmp = json_decode(strip_tags($tmp));
print_r($tmp);
exit;


/**
 * array_merge() 的用法
 */
function eg_array_merge1(){
	$arr1 = array('a'=>array(101,array(1,3,5)),'b'=>array(103,104));
	$arr2 = array('a'=>array(201,202),'b'=>array(203,204));
	$arr3 = array('e'=>array(301,302),'0'=>array(303,304,305,array(123,456)),'g'=>array(307,308));
	$tmp= array_merge($arr1,$arr2,$arr3);
	// 	$tmp = array_merge($arr1);//如果只有一个数组并且key是数字类型,那么会将此key从０开始重新排
	printInfo($tmp);//使用print_r格式化输出
}
eg_array_merge1();	//打开注释看一下结果,结果是,把这三个数组里面的所有项a,b,c,d,e,0,g都取出来,换成一个大数组,而a-g的结构保持不变

exit;


echo date('Ymd his', strtotime('-1 day'));
echo '</br>';
echo strtotime('-1 day');
// echo date('Ymdhis', strtotime('-2 day'));
exit;


function test($v1,$v2) {
	echo $v1;
	echo $v2;
	echo $v3;
}
test(1,2,3);//结果12
exit;

function getPicWH ($value) {
	if (empty($value)){
		return false;
	}
	$pos = strrpos($value,"/");
	$tmp = substr($value, $pos);
	$_pos = strpos($tmp, ".");
// 	echo $pos ;
	$_tmp = substr($tmp, 0, $_pos);

	return explode("_", $_tmp);
}
$value = 'http://124.202.144.17/pic/_o/30/f1/2710faf7a2246c74f97b67da2ed0_210_350.c6.jpg';

$re = getPicWH($value);
printInfo($re);
exit;


// $a = 1;
// $b = $a + $a++;
// echo $b;
// exit;

$a = 1;
$c = $a + $a + $a++;
echo $c;
exit;

$str = '{"ip":"127.0.0.1","COOKIE":{"SEASHELL":"fMqQ lJyMLARpQ0CTdcFAg=="},"headers":{"X-Real-Ip":"211.99.254.39","X-Forwarded-For":"211.99.254.39"}}';
// printInfo(json_decode($str,true));

$tmp = (json_decode($str,true));
// printInfo($tmp);
// exit;
$obj = new \stdClass();
$obj->ip = $tmp['ip'];
$obj->COOKIE = $tmp['COOKIE'];
$obj->headers = $tmp['headers'];
echo  '<pre>';
print_r($obj);
echo '</pre>';

exit;


$str = 'a:12:{s:10:"busiTypeId";s:5:"DOOTA";s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140306203311";s:7:"orderNo";s:12:"140306225671";s:9:"refAmount";s:4:"0.01";s:10:"refOrderNo";i:280615;s:10:"refReqTime";s:14:"20140306203406";s:9:"refRetUrl";s:60:"http://dootapc.devlab2.meilishuo.com/mpay/mpay_refund_notify";s:10:"refundMode";s:4:"BANK";s:9:"shareData";s:104:"[{"merchantCode":"MLS_D_00090001","amount":"0.01","freight":"0.00","coupon":0,"orderId":"140306225671"}]";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"89e8976069fed86dd05479502fa32d22";}';
printInfo(unserialize($str));
exit;

$str = 'a:12:{s:10:"busiTypeId";s:5:"DOOTA";s:10:"merchantId";s:14:"MLS_I_00000002";s:9:"orderDate";s:14:"20140210191740";s:7:"orderNo";s:12:"140210288307";s:9:"refAmount";s:5:"75.00";s:10:"refOrderNo";s:6:"214377";s:10:"refReqTime";s:14:"20140225202159";s:9:"refRetUrl";s:49:"http://doota.meilishuo.com/2.0/mpay/refund_notify";s:10:"refundMode";s:4:"BANK";s:9:"shareData";s:105:"[{"merchantCode":"MLS_D_00094315","amount":"75.00","freight":"0.00","coupon":0,"orderId":"140210288307"}]";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"fcfefd744f73f1804f03922264961cd8";}';
printInfo(unserialize($str));
exit;


$str = 'a:13:{s:10:"busiTypeId";s:5:"DOOTA";s:12:"cancelAmount";s:6:"440.00";s:8:"cancelNo";i:126173;s:13:"cancelReqTime";s:14:"20140123121039";s:12:"cancelRetUrl";s:59:"http://dootapc.meilishuo.com/mpay/mpay_danbao_cancel_notify";s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140113131101";s:7:"orderNo";s:12:"140113203153";s:10:"refundMode";s:4:"BANK";s:9:"shareData";s:111:"[{"merchantCode":"MLS_D_00090037","amount":"440.00","freight":"0.00","coupon":"0.00","orderId":"140113203153"}]";s:7:"totalNo";s:14:"20140113203153";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"50151c6a5ebc0ac41c83537cd9ed476d";}';
printInfo(unserialize($str));
exit;

$str = 'a:10:{s:10:"busiTypeId";s:5:"DOOTA";s:13:"confirmAmount";s:6:"106.00";s:9:"confirmNo";i:1687042;s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140112152501";s:7:"orderNo";s:12:"140112999656";s:9:"shareData";s:111:"[{"merchantCode":"MLS_D_00091453","amount":"106.00","freight":"0.00","coupon":"0.00","orderId":"140112999656"}]";s:7:"totalNo";s:12:"140112999656";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"8a78700f8a676b15c3d9f1842a2f86ca";}';
printInfo(unserialize($str));
exit;


$arr = [1=>array(11=>111),2=>array(22=>222)];
printInfo($arr);
exit;

if(0.00 == 0){
	echo 1;//√
}
if(0.00=='0') {
	echo 2;//√
}
if(0 == '0.00'){
	echo 3;//√
}
if (1==1.00) {
	echo 4;//√
}
if('0' == '0.00') {
	echo 5;//√
}
if((1-null) == 1 ){
	echo 6;//√
}
exit;

// echo date('Y-m-d');
echo $start_time = strtotime(date('Y-m-d'));
exit;

$str = '20140101';
echo strtotime($str);
exit;

$str = 'bcd';
$a  = $str[0];//b
switch ($a) {
		default:
			echo $a;//b
			break;
}
exit;

// 获取数据最后一个元素的三种方法
$arr = [array(1),array(2),array(3),array(4,5,6)];
print_r(end($arr));//Array ( [0] => 4 [1] => 5 [2] => 6 )
print_r(current($arr));//Array ( [0] => 4 [1] => 5 [2] => 6 )
// print_r(current($arr));//获到当前元素
// print_r(array_slice($arr,-1,1,true)); //Array ( [3] => Array ( [0] => 4 [1] => 5 [2] => 6 ) )	,　//结果是一维数组
// print_r(end($arr));	//Array ( [0] => 4 [1] => 5 [2] => 6 )
// print_r(array_pop($arr)); //Array ( [0] => 4 [1] => 5 [2] => 6 ),并删除最后一个元素,  与其相反的是array_shift()删除数组的第一个元素
// printInfo($arr);
exit;


$arr = array(
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,
1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0);
printInfo(array_chunk($arr, 70));
exit;

$arr1 = [1,2,3,4,6,7];
$arr2 = [2,3,4,5];
print_r(array_diff($arr1, $arr2));//Array ( [0] => 1 [4] => 6 [5] => 7 )
exit;


$str = 'a:13:{s:10:"busiTypeId";s:5:"DOOTA";s:12:"cancelAmount";s:4:"0.01";s:8:"cancelNo";i:111415;s:13:"cancelReqTime";s:14:"20140120152428";s:12:"cancelRetUrl";s:62:"http://dootalabpc.meilishuo.com/mpay/mpay_danbao_cancel_notify";s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140120151129";s:7:"orderNo";s:12:"140120354441";s:10:"refundMode";s:4:"BANK";s:9:"shareData";s:109:"[{"merchantCode":"MLS_D_00090001","amount":"0.01","freight":"0.00","coupon":"0.00","orderId":"140120354441"}]";s:7:"totalNo";s:12:"140120354441";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"7efd7e707c5f9836a198168c9c4d778e";}';
printInfo(unserialize($str));
exit;



$str = 'a:12:{s:10:"busiTypeId";s:5:"DOOTA";s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140120151129";s:7:"orderNo";s:12:"140120354441";s:9:"refAmount";s:4:"0.01";s:10:"refOrderNo";i:111487;s:10:"refReqTime";s:14:"20140120153625";s:9:"refRetUrl";s:55:"http://dootalabpc.meilishuo.com/mpay/mpay_refund_notify";s:10:"refundMode";s:4:"BANK";s:9:"shareData";s:109:"[{"merchantCode":"MLS_D_00090001","amount":"0.01","freight":"0.00","coupon":"0.00","orderId":"140120354441"}]";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"cc80cc097d4e7ac10a4e05299b34a744";}';
printInfo(unserialize($str));
exit;


$arr = array(array(1),array(1),array(1),array(1),array(1),array(1),);
$arr = array_keys($arr);
// printInfo($arr);
exit;

$str = 'a:13:{s:10:"busiTypeId";s:5:"DOOTA";s:12:"cancelAmount";s:4:"0.01";s:8:"cancelNo";i:111373;s:13:"cancelReqTime";s:14:"20140120151354";s:12:"cancelRetUrl";s:62:"http://dootalabpc.meilishuo.com/mpay/mpay_danbao_cancel_notify";s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140120151129";s:7:"orderNo";s:12:"140120354441";s:10:"refundMode";s:4:"BANK";s:9:"shareData";s:109:"[{"merchantCode":"MLS_D_00090001","amount":"0.01","freight":"0.00","coupon":"0.00","orderId":"140120354441"}]";s:7:"totalNo";s:12:"140120354441";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"19d378d6564d2a0db34fdbb5cc51588e";}';
printInfo(unserialize($str));
exit;

$arr = array('');
if($arr){
	echo 1;//√√√
}else {
	echo 2;
}
exit;


/**
 * 支付对账文件内容入库
 */
function importPayment($date) {
	echo 'start';
// 	$file = $this->path.'orderinfo-'.$date.'.csv';
	//默认可以重复入库，只是多较验一次
	// 		$handle = fopen($file,"r");
	$handle = fopen("orderinfo-20140210.csv","r");
	printInfo($handle,1);
	if($handle){
		$insert = "INSERT INTO t_bat_checking_payment (order_no,order_time,order_amount,merchant_code,amount,freight,coupon,order_id,`status`,ctime) VALUES";
		$valuesArr = array();
		$tmpStr = "";
		$i = 0;
		while(!feof($handle)) {//这种形式会有空行产生。拼sql时会有问题
			$i++;
			$data = fgetcsv ($handle);
			$paramStr = "";
			foreach ($data as $val){
				if(is_numeric($val)){
					$paramStr .= $val.",";
				}else{
					$paramStr .= "'$val'".",";
				}
			}
			$tmpStr .= "(".$paramStr."UNIX_TIMESTAMP()),";
			if(($i%200)==0){//每200条记录存放进数据
				$valuesArr[] = rtrim($tmpStr,',');
				$tmpStr = "";
			}
		}
		if($tmpStr){
			$valuesArr[] = rtrim($tmpStr,',');
		}
		fclose($handle);
		printInfo($valuesArr);
		foreach ($valuesArr as $values){//批次插入对账数据
			if($values){
				$insertSql = $insert.$values;
				echo $insertSql.'<br/>';
// 				\Virus\Package\Order\Helper\DBOrderHelper::getConn()->write($insertSql);
			}
		}
	}
}

if(is_numeric(123.11)){
	echo 'is_numeric<br/>';
}
importPayment(1);
exit;




$arr = array('a'=>1234,'b'=>222,'c'=>333,'d'=>'ddd,ddd,ddd,','e'=>555,'f'=>666,'g'=>777);
$a=array("a"=>"Cat","b"=>"Dog","c"=>"Horse","d"=>"Cow");
printInfo(array_chunk($arr,20));//array_chunk() 函数把一个数组分割为新的数组块。
exit;


//mpay_record 里面的data分账数据
$str = 'a:10:{s:10:"busiTypeId";s:5:"DOOTA";s:13:"confirmAmount";s:6:"178.00";s:9:"confirmNo";i:1545735;s:10:"merchantId";s:14:"MLS_I_00000001";s:9:"orderDate";s:14:"20140107222108";s:7:"orderNo";s:12:"140107863745";s:9:"shareData";s:111:"[{"merchantCode":"MLS_D_00092039","amount":"178.00","freight":"0.00","coupon":"0.00","orderId":"140107863745"}]";s:7:"totalNo";s:12:"140107863745";s:7:"version";s:8:"20131111";s:4:"HMAC";s:32:"d36402fa06da70daa822332279c34a76";}'; 
printInfo(unserialize($str));
exit;

$str = '[{"80797629":"/pic/_o/00/3f/6a94191ca703d83210087e6eff48_400_540.c6.jpg"},{"83508921":"/pic/_o/a0/f3/f41f66b0eb22a5274c74b3e8bb3d_450_540.c6.jpg"},{"79660369":"/pic/_o/ae/c3/e4d001a52683158b4a1d42fcac74_504_756.c6.jpg"},{"79660813":"/pic/_o/8b/1f/c58b9a12a2b936e098c2627f44cc_468_702.c6.jpg"}]';
printInfo(json_decode($str,true));
exit;
$str = array('1234'=>'asdfdsaf');
// echo array_values($str)[0];exit;
echo array_shift($str);exit;
printInfo(json_decode($str));
exit;

$arr = array(1234,12334,1234);
var_dump(json_encode($arr));
exit;
// echo (int)date('H',time());
// if(date('H',time())<6){
// 	echo '<';
// }else{
// 	echo '>';
// }
// exit;

// echo substr('123456',0,-1);
// exit;


//PHP获取当天零点的时间戳
echo strtotime(date('Y-m-d',time()));
echo '<br>';
echo strtotime(date('2014-01-26 00:00:00'));
echo '<br>';
echo time();

$tmp = array(
		'a'=>array('a1'=>'123','a2'=>'456','a3'=>'111','a4'=>'ssd'),
		'b'=>array('b1'=>'123','b2'=>'456','b3'=>'111','b4'=>'ssd'),
		'c'=>array('c1'=>'123','c2'=>'456','c3'=>'111','c4'=>'ssd'),
		'd'=>array('d1'=>'123','d2'=>'456','d3'=>'111','d4'=>'ssd'),
);

// printInfo(array_keys($tmp));
exit;


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
	echo dirname(__FILE__);		//输出	/Users/cui/Sites/git/demo		所以在新版本的php中，可以使用__DIR__，要兼容老版本的话php的话还是用dirname(__FILE__)这个吧。
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
	
	if($a){
		echo '1';
	}else{
		echo '0';
	}
	if($b){
		echo '1';
	}else{
		echo '0';
	}
	if($c){
		echo '1';
	}else{
		echo '0';
	}
	if($d){
		echo '1';
	}else{
		echo '0';
	}
	if($e){
		echo '1';
	}else{
		echo '0';
	}
	if($f){
		echo '1';
	}else{
		echo '0';
	}
	if(!$gg){
		echo '0';
	}
	else {
		echo '1';
	}
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

