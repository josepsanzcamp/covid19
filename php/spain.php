<?php

if(!file_exists("middle/35177-ok.csv")) {
	console_debug("middle/35177-ok.csv");
	$data=import_file("input/spain/35177.csv.gz");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total Nacional" && $val[1]=="Dato base" && $val[3]!="Total") {
			$key2=substr($val[2],0,4);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/35177-ok.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/35177-ok2.csv")) {
	console_debug("middle/35177-ok2.csv");
	$data=import_file("input/spain/35177.csv.gz");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total Nacional" && $val[1]=="Dato base" && $val[3]!="Total") {
			$key2=str_replace("SM","-",$val[2]);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/35177-ok2.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/35177-ok3.csv")) {
	console_debug("middle/35177-ok3.csv");
	$data=import_file("input/spain/35177.csv.gz");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total Nacional" && $val[1]=="Dato base" && $val[3]!="Total") {
			$key2=str_replace("SM","-",$val[2]).";".$val[0];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/35177-ok3.csv",$sumas);
	console_debug();
}

?>