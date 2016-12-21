<?php
	$file = 'places.json';
	$str = file_get_contents($file);
	$arr = json_decode($str,true);
	//echo 'count= '.count($arr).PHP_EOL;
	//echo $str.PHP_EOL;
	foreach ($arr as $key) {
		echo $key['name'].PHP_EOL;
		echo $key['kerivnik'].PHP_EOL;
		echo $key['city'].PHP_EOL;
		echo $key['street'].PHP_EOL;
		echo $key['number'].PHP_EOL;
		echo $key['tel'].PHP_EOL;
		echo $key['email'].PHP_EOL;
		echo $key['site'].PHP_EOL;
		echo $key['category_id'].PHP_EOL;
	}
	//echo json_encode($arr,JSON_UNESCAPED_UNICODE,JSON_PRETTY_PRINT)
?>