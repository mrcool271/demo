<?php

// $a = array (1, 2, array ("a", "b", "c"));
// var_dump ($a,true);
// var_export ($a);
// echo var_export ($a,1).';';
// exit;

$local_path_xls = '/tmp/tmp.xls';
$fp_xls = fopen($local_path_xls,'a');
$summary = array("version：1","num：2", "'210422198709201279");
fwrite($fp_xls,iconv('UTF-8','GBK',implode("\t", $summary). "\t\n"));
// fwrite($fp_xls,implode("\t", $summary). "\t\n");
fclose($fp_xls);


$html .= '<td style="vnd.ms-excel.numberformat:@">'.$val.'</td>';