<?php
//phpinfo();


// var_dump(extension_loaded('mysqli'));
// var_dump(extension_loaded('curl'));

// var_dump(function_exists('mysqli_connect'));



// print_r(get_loaded_extensions());


$host = '127.0.0.1';//用localhost会报错。。。。
$user = 'root';
$password = '';
$database = 'test';
$port = '3306';
$mysqli = new mysqli($host, $user, $password);
print_r($mysqli);

$mysqli->select_db($database); 
