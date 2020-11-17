<?php

if(!file_exists("middle/dataold.csv")) {
	console_debug("middle/dataold.csv");
	$files=glob("input/momo/data.????????.csv.gz");
	sort($files);
	foreach($files as $key=>$val) {
		$temp=explode(".",$val);
		if($temp[1]>=20200527) unset($files[$key]);
	}
	$result=array();
	foreach($files as $file) {
		$data=import_file($file);
		foreach($data as $key=>$val) {
			$key2=implode("|",array_slice($val,0,8));
			$key3=$val[8];
			$result[$key2][$key3]=array_slice($val,0,10);
			unset($data[$key]);
		}
	}
	$result2=array();
	foreach($result as $key=>$val) {
		$result2=array_merge($result2,array_values($val));
		unset($result[$key]);
	}
	export_file("middle/dataold.csv",$result2);
	unset($result);
	unset($data);
	unset($result2);
	console_debug();
}

if(!file_exists("middle/dataold-ok.csv")) {
	console_debug("middle/dataold-ok.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/dataold-ok2.csv")) {
	console_debug("middle/dataold-ok2.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok2.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/dataold-ok3.csv")) {
	console_debug("middle/dataold-ok3.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok3.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/dataold-ok5.csv")) {
	console_debug("middle/dataold-ok5.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok5.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

?>