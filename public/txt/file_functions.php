<?php  

// Parse txt files with places	

function parse_file($filename){
		$file     = $filename.'.txt';
		$file_out = $filename.'.json';
		//$file_out = 'places.json';
		$string   = file_get_contents($file);
		$str_arr  = explode(PHP_EOL, $string);
		$record   = array();
		for ($i = 0; $i < count($str_arr); $i = $i + 6) {
			for ($j = 0; $j < 6; $j++) { 
				$tmp_str    = explode(': ', $str_arr[$i + $j]);
				$record[$j] = trim($tmp_str[1]);
				$record[$j] = str_replace("'", "\'", $record[$j]);
			}
		    $addess = explode(',', $record[2]);
			foreach ($addess as $key => &$value) {
				$value = str_replace("вул.", "", $value);
				$value = str_replace("буд.", "", $value);
				$value = str_replace("Сел.", "", $value);
				$value = str_replace("с.", "", $value);
				$value = str_replace("Кропивницького", "Кропивницький", $value);
 				$value = trim($value);
			}
		    $array_out [] = array('name'     => $record[0],
				                  'kerivnik' => $record[1],
				                  'city'     => $addess[0],
				                  'street'   => $addess[1],
				                  'number'   => $addess[2],
				                  'tel'      => $record[3],
				                  'email'    => $record[4],
				                  'site'     => $record[5]
				                  );

		    echo 'OK'.PHP_EOL;
		}
		$file_out = file_put_contents($file_out, json_encode($array_out,JSON_UNESCAPED_UNICODE));
		$cnt      = count($str_arr) / 6;
		echo PHP_EOL.' '.$cnt.' records.';
	}

// load inf about places into table tmp_places

	function load_tmp_places($file, $category_id){
		$str = file_get_contents($file);
		$arr = json_decode($str,true);
		require "connect.php";
		$conn->query("SET NAMES utf8");
		$sql = "DELETE FROM tmp_places WHERE category_id = '$category_id'";
		$conn->query($sql);
		echo "Table truncate successfuly.".PHP_EOL;
		foreach ($arr as $key) {
			$name     = $key['name'];
			$kerivnik = $key['kerivnik'];
			$city     = $key['city'];
			$street   = $key['street'];
			$number   = $key['number'];
			$tel      = $key['tel'];
			$email    = $key['email'];
			$site     = $key['site'];
			$sql = "INSERT INTO tmp_places(name, kerivnik, city, street, number, tel, email, site, category_id) 
				VALUES('$name', '$kerivnik', '$city', '$street', '$number', '$tel', '$email', '$site', '$category_id')";
			if($conn->query($sql))
				echo PHP_EOL.' OK';
			else
				echo PHP_EOL.$conn->error;
		}
		echo PHP_EOL." Type $category_id loaded: ".count($arr).' successfuly.';
		$conn->close();
	}
?>