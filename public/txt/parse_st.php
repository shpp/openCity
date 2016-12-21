<?php
	$file = 'streets.txt';
	$file_out = 'streets.json';
	$string = file_get_contents($file);
	$str_arr = explode(PHP_EOL, $string);
	$record= array();
	echo count($str_arr);
	for ($i = 0; $i < count($str_arr); $i++) {
	 	$array_out [] = array('name' => $str_arr[$i]);
	}
	$file_out = file_put_contents($file_out, json_encode($array_out,JSON_UNESCAPED_UNICODE));
?>