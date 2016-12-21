<?php
	require "connect.php";
	$conn->query("SET NAMES utf8");
	$sql = "TRUNCATE TABLE categories";
	$conn->query($sql);
	echo "Table truncate successfuly.".PHP_EOL;
	$sql = "INSERT INTO categories(name, comment, created_at, updated_at)
	VALUES('загальні','Загальньоосвітні навчальні заклади', now(), now()),
	  	  ('спеціальні','Спеціальні навчальні заклади', now(), now()),
		  ('позашкільні','Позашкільні навчальні заклади', now(), now()),
		  ('дошкільні','Дошкільні навчальні заклади', now(), now())";
	$conn->query($sql);
	echo PHP_EOL.' '.'All categories upload successfuly.';
	$conn->close();
?>