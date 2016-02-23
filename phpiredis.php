<?php

$redis = phpiredis_connect('127.0.0.1', 6379);  

//$response = phpiredis_command_bs($redis, array('DEL', 'test'));

$response = phpiredis_multi_command_bs($redis, array(
    array('SET', 'test', '1'),
	array('GET', 'test'),
	));


//print_r($redis);
print_r($response);
