<?php
$mem = new Memcached();

$mem->addServer("127.0.0.1", 11211);

$get_news = $mem->get("test");
if($get_news) {
	echo "cache content " . $get_news;
}else {
	$mem->set("test", 123, 3);
	echo "nocache";
}
