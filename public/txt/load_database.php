<?php 
	require "file_functions.php";
	require "connect.php";

	$sql = "DROP TABLE tmp_places";
	$conn->query($sql);
	$sql = "CREATE TABLE tmp_places (
				  id int(10) AUTO_INCREMENT,
				  name varchar(300) NOT NULL,
				  kerivnik varchar(150) NOT NULL,
				  city varchar(150) NOT NULL,
				  street varchar(150) NOT NULL,
				  number varchar(10) NOT NULL,
				  tel varchar(150) NOT NULL,
				  email varchar(150) NOT NULL,
				  site varchar(150) NOT NULL,
				  category_id int(10) DEFAULT NULL,
				  PRIMARY KEY (id))";
	$conn->query($sql);		

	/*parse_file("zagalni");
	parse_file("specialni");
	parse_file("pozashkilni");
	parse_file("doshkilni");
	load_tmp_places('zagalni.json', 1);
	load_tmp_places('specialni.json', 2);
	load_tmp_places('pozashkilni.json', 3);*/
	load_tmp_places('places_med.json', 6);
 ?>