<?php
	$file = 'streets.json';
	$str = file_get_contents($file);
	$arr = json_decode($str,true);
	require "connect.php";
	$conn->query("SET NAMES utf8");
	$sql = "TRUNCATE TABLE streets";
	$conn->query($sql);
	echo "Table truncate successfuly.".PHP_EOL;
	foreach ($arr as $key) {
		$name = $key['name'];
		$sql = "INSERT INTO streets(name, created_at, updated_at) VALUES('$name',now(),now())";
		$conn->query($sql);
		echo '*';	
	}
	echo PHP_EOL.' '.count($arr).' upload successfuly.';
	$conn->close();
?>