<?php


$runDate = new \DateTime();
echo $runDate->getTimestamp();
echo '<br/>';
exit;



// 栈的实现
// $stack = new SplStack();
// //入栈
// $stack->push('a');
// $stack->push('b');
// //出栈
// echo $stack->pop();
// echo $stack->pop();


// // 队列的实现
// $queue = new SplQueue();
// //入队列
// $queue->enqueue('a');
// $queue->enqueue('b');
// $queue->enqueue('c');
// //出队列
// echo $queue->dequeue();
// echo $queue->dequeue();
// echo $queue->dequeue();


// // 最小堆的实现
// $heap = new SplMinHeap();
// //插入到堆
// $heap->insert('a');
// $heap->insert('b');
// $heap->insert('c');
// //从堆中提取数据
// echo $heap->extract();
// echo $heap->extract();
// echo $heap->extract();


// 固定长度的数组
$array = new SplFixedArray(5);
$array[1] = 5;
$array[3] = 10;
var_dump($array);


exit;







function gen1() {
    $ret = yield 'foo';
    var_dump($ret);
    yield 'bar';
}

$gen = gen1();
var_dump($gen->send('something'));
exit;



function gen() {
    $ret = (yield 'yield1');
    var_dump($ret);
    $ret = (yield 'yield2');
    var_dump($ret);
}

$gen = gen();
var_dump($gen->current());    // string(6) "yield1"
var_dump($gen->send('ret1')); // string(4) "ret1"   (the first var_dump in gen)
// string(6) "yield2" (the var_dump of the ->send() return value)
var_dump($gen->send('ret2')); // string(4) "ret2"   (again from within gen)
// NULL               (the return value of ->send())
exit;



function logger($fileName) {
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        fwrite($fileHandle, yield . "\n");
    }
}

$logger = logger(__DIR__ . '/a.log');
$logger->send('Foo');
$logger->send('Bar');
$logger->send('1');
$logger->send('s');
$logger->send('d');
exit;



function xrange($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

// foreach (xrange(1, 100) as $num) {
//     echo $num, "\n";
// }
$x = xrange(1, 10);
var_dump($x);
// $x->rewind();
var_dump($x->current());
var_dump($x->next());
var_dump($x->current());
var_dump($x->next());
var_dump($x->current());
exit;






function gen_one_to_three() {
    for ($i = 1; $i <= 5; $i++) {
        //注意变量$i的值在不同的yield之间是保持传递的。
        yield $i;
    }
}

$generator = gen_one_to_three();
var_dump($generator);
foreach ($generator as $value) {
    echo "$value\n";
    if($value == 2){
        break;
    }
}
var_dump($generator);
foreach ($generator as $value) {
    echo "$value\n";
}
exit;


class MyIterator implements Iterator {
    private $position = 0;
    private $arr = [
        'first', 'second', 'third',
    ];

    public function __construct() {
        $this->position = 0;
    }

    public function rewind() {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    public function current() {
        var_dump(__METHOD__);
        return $this->arr[$this->position];
    }

    public function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    public function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    public function valid() {
        var_dump(__METHOD__);
        return isset($this->arr[$this->position]);
    }

}

$it = new MyIterator();

foreach($it as $key => $value) {
    echo "\n";
    var_dump($key, $value);
}
exit;



Class A {
    public function aa() {
        echo 'a';
        B::bb();
    }
}

Class B {
    private $b = 1;
    public static function bb() {
        echo 'b';
//         $this->b = 1;
    }
}

$objA = new A();
$objA->aa();
$objB = new B();
$objB->bb();
B::bb();
exit;//abbb



$a = ['a' => 1];
$b = ['a' => 2];
var_dump(array_merge($a, $b));
exit;

function test()
{
    static $var = 5;  //static $var = 1+1;就会报错
    $var++;
    echo $var . ' ';
}


test(); //6
test(); //7
test(); //8



echo '<br>';
echo 'master';
echo json_encode(array('你好'),JSON_UNESCAPED_UNICODE);

exit;

$data = [];
$a = [['aa','bb'],['cc','dd']];
echo json_encode($a);
echo '<br>';
$b = [['title'=> 'aa','item'=> 'aa','c'=> 'aa','d'=> 'aa'],['title'=> 'aa','item'=> 'aa','c'=> 'aa','d'=> 'aa']];
echo $b = json_encode($b);
echo '<br>';
print_r( json_decode($b));
echo '<br>';
print_r( json_decode($b,true));
exit;



echo 'master';
print_r($_SERVER);
exit;


echo json_encode(array('你好'),JSON_UNESCAPED_UNICODE);
exit;
print_r($_SERVER);
exit;

echo microtime(1);exit;
echo $time = sprintf("%8s.%03d",date('H:i:s'),floor(microtime()*1000));
exit;
echo __DIR__;exit;
define('TT',dirname(__FILE__).'ABC');
echo TT;
exit;


// header("Location:http://oauth2.com/sso/checkticket?ticket=12345");
// header("Location:http://oauth2.com/sso/test");
$url = "http://oauth2.com/test/test?access_token=6bPJG4Dk0p6M4kE8NKLts1W59CJiZoZF4yZMr7nA1";
$a = http_get($url);
print_r(json_decode($a,1));
exit;

/**
 * GET 请求
 * @param string $url
 */
function http_get($url){
	$oCurl = curl_init();
	if(stripos($url,"https://")!==FALSE){
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
	}
	curl_setopt($oCurl, CURLOPT_URL, $url);
	curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
	$sContent = curl_exec($oCurl);
	$aStatus = curl_getinfo($oCurl);
	curl_close($oCurl);
    return $sContent;
}

exit;

function https_get() {
    $curl = curl_init();
    // 刚开始抓取了https://github.com,但是页面弹框，后来改用抓取支付宝首页测试
    curl_setopt($curl, CURLOPT_URL, 'https://www.alipay.com');
    // 设置header
    curl_setopt($curl, CURLOPT_HEADER, 1);
    // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 运行cURL，请求网页数据
    $data = curl_exec($curl);
    // 关闭cURL请求
    curl_close($curl);
    // 打印出抓取的测试数据
    var_dump($data);
}

echo 'master';
echo 'merge';

$ticket = '12345';
$tokenArr = array(1,2,3);
$server = Yii::app()->oauth2Resource;
$response = new OAuth2ServerResponse;
$redis = new RedisClient();
$data = $redis->hMSet($this->ticketKey . $ticket);
// 		$redis->hMSet($this->ticketKey . $ticket, $tokenArr);
// 		$redis->expire($this->ticketKey . $ticket, 6000);
$redis->delete($this->ticketKey . $ticket);
$data = $redis->hMGet($this->ticketKey . $ticket);
print_r($data);
exit;
exit;
