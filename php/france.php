<?php

if(!file_exists("middle/dc_20xx_det.csv")) {
	console_debug("middle/dc_20xx_det.csv");
	passthru("zcat input/france/DC_20??_det.csv.gz | cut -d';' -f-3 | tr ';' '-' | uniq -c | gawk '{print $2\";\"$1}'| grep -v ADEC > middle/dc_20xx_det.csv");
	console_debug();
}

if(!file_exists("middle/dc_20xx_det.csv")) {
	console_debug("middle/dc_20xx_det.csv");
	$files=glob("input/france/DC_20??_det.csv.gz");
	sort($files);
	$sumas=array();
	foreach($files as $file) {
		$data=import_file($file);
		unset($data[0]);
		foreach($data as $key=>$val) {
			$fecha=sprintf("%04d-%02d-%02d",$val[0],$val[1],$val[2]);
			if(!isset($sumas[$fecha])) $sumas[$fecha]=array($fecha,0);
			$sumas[$fecha][1]++;
			unset($data[$key]);
		}
	}
	export_file("middle/dc_20xx_det.csv",$sumas);
	unset($sumas);
	unset($data);
	console_debug();
}

?>