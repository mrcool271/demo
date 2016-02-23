<?php

echo mb_strtoupper('abc');
exit;

function hourGenerate($hours, $minutes, $seconds) {
	return implode(':', array($hours, $minutes, $seconds));
}


$date = date('Y-m-d');
$tab = explode(' ', $date);
if (!isset($tab[1]))
	$date .= ' ' . hourGenerate(23, 59, 59);

echo $date;
