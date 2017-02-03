<?php  

// Parse txt files with places	

function parse_file($filename, $category){
		$file     = $filename.'.txt';
		//$file_out = $filename.'.json';
		$file_out1 = 'places_med.json';

		//$json = file_get_contents($file_out);
		//$array_out = json_decode($json, true);
		$array_out = [];//json_decode($json, true);

		$string   = file_get_contents($file);
		$str_arr  = explode(PHP_EOL, $string);
		$record   = array();
		for ($i = 0; $i < count($str_arr); $i++) {
			$record = explode(';', $str_arr[$i]);
			/*for ($j = 0; $j < 6; $j++) { 
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
			}*/
		    $array_out [] = array('name'        => $record[0],
				                  'kerivnik'    => $record[5],
				                  'city'        => $record[2],
				                  'street'      => $record[3],
				                  'number'      => $record[4],
				                  'tel'         => $record[6],
				                  'email'       => '',
				                  'site'        => '',
				                  'category_id' => "$category" 
				                  );

		    //echo 'OK'.PHP_EOL;
		}
		$file_out1 = file_put_contents($file_out1,json_encode($array_out,JSON_UNESCAPED_UNICODE));
		$cnt      = count($str_arr);
		echo PHP_EOL.' '.$cnt.' records.';
	}
	parse_file("med",6);

?>