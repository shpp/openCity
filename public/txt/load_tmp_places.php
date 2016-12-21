<?php
	function load_tmp_places($file, $category_id){
		$str = file_get_contents($file);
		$arr = json_decode($str,true);
		require "connect.php";
		$conn->query("SET NAMES utf8");
		$sql = "DELETE FROM tmp_places WHERE category_id = '$category_id'";
		$conn->query($sql);
		echo "Table truncate successfuly.".PHP_EOL;
		foreach ($arr as $key) {
			$nazva    = $key['nazva'];
			$kerivnik = $key['kerivnik'];
			$adressa  = $key['adressa'];
			$tel      = $key['tel'];
			$email    = $key['email'];
			$site     = $key['site'];
			$sql = "INSERT INTO tmp_places(nazva, kerivnik, adressa, tel, email, site, category_id) 
			                    VALUES('$nazva', '$kerivnik', '$adressa', '$tel', '$email', '$site', '$category_id')";
			if($conn->query($sql))
				echo PHP_EOL.' OK';
			else
				echo PHP_EOL.$conn->error;
		}
		echo PHP_EOL." Type $category_id loaded: ".count($arr).' successfuly.';
		$conn->close();
	}

	load_tmp_places('zagalni.json', 1);
	load_tmp_places('specialni.json', 2);
	load_tmp_places('pozashkilni.json', 3);
	load_tmp_places('doshkilni.json', 4);
?>