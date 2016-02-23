<?php
//test 
$num = 10;
$sum = 100;
$local_path = "/Users/cui/Sites/test.txt";
$summary = "version:1"."\t".$num."\t".$sum;
$title = array('a','b','c');

$fp = fopen($local_path,'a');
var_dump($fp);
fputcsv($fp,$title, "\t");//utf-8
fputcsv($fp,$title, "\t");//utf-8
fputcsv($fp,$title, "\t");//utf-8
// fputs($fp, '1'."\r\n");
// fputs($fp, '2'."\r\n");

fclose($fp);

