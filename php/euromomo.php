<?php

if(count(glob("middle/component.????????.csv"))!=count(glob("input/euromomo/component.????????.js.gz"))) {
	console_debug("middle/component.????????.csv");
	$files=glob("input/euromomo/component.????????.js.gz");
	sort($files);
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("middle/component.${part}.csv")) continue;
		$buffer=get_file($file);
		$pos=strrpos($buffer,"JSON.parse");
		if($pos===false) die("ERROR 2");
		$pos=strpos($buffer,"{",$pos);
		if($pos===false) die("ERROR 3");
		$pos2=strpos($buffer,"}')",$pos);
		$buffer=substr($buffer,$pos,$pos2-$pos+1);
		$json=json_decode($buffer,true);
		$matrix=array();
		if(!isset($json["pooled"]["weeks"])) $json["pooled"]["weeks"]=$json["weeks"];
		$weeks=$json["pooled"]["weeks"];
		foreach($json["pooled"]["groups"] as $key=>$val) {
			$group=$val["group"];
			unset($val["group"]);
			foreach($val as $key2=>$val2) {
				foreach($val2 as $key3=>$val3) {
					$matrix[]=array("pooled","",$group,$key2,$weeks[$key3],$val3);
				}
			}
		}
		if(!isset($json["countries"]["countries"])) $json["countries"]["countries"]=$json["countries"];
		if(!isset($json["countries"]["weeks"])) $json["countries"]["weeks"]=$json["weeks"];
		$weeks=$json["countries"]["weeks"];
		foreach($json["countries"]["countries"] as $key=>$val) {
			$country=$val["country"];
			unset($val["country"]);
			foreach($val["groups"] as $key2=>$val2) {
				$group=$val2["group"];
				unset($val2["group"]);
				foreach($val2 as $key3=>$val3) {
					foreach($val3 as $key4=>$val4) {
						$matrix[]=array("countries",$country,$group,$key3,$weeks[$key4],$val4);
					}
				}
			}
		}
		export_file("middle/component.${part}.csv",$matrix);
	}
	unset($buffer);
	unset($json);
	unset($matrix);
	console_debug();
}

?>