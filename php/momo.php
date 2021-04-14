<?php

if(count(glob("middle/data.????????.csv"))!=count(glob("input/momo/data.????????.csv.gz"))) {
	console_debug("middle/data.????????.csv");
	$files=glob("input/momo/data.????????.csv.gz");
	sort($files);
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("middle/data.${part}.csv")) continue;
		//~ $data=import_file($file);
		$temp=get_tempfile();
		passthru("zcat $file | grep -v -e hombres -e mujeres > $temp");
		$data=import_file($temp);
		unlink($temp);
		$matrix=array();
		foreach($data as $key=>$val) {
			if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
				$key2=$val[8];
				if(isset($matrix[$key2])) die("ERROR 4");
				$matrix[$key2]=array($key2,str_replace(".","",$val[9]));
			}
			unset($data[$key]);
		}
		export_file("middle/data.${part}.csv",$matrix);
	}
	unset($data);
	unset($matrix);
	console_debug();
}

?>