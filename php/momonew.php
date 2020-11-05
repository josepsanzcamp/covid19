<?php

if(!file_exists("middle/datanew.csv")) {
	console_debug("middle/datanew.csv");
	$files=glob("input/momo/data.????????.csv.gz");
	sort($files);
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
	export_file("middle/datanew.csv",$result2);
	console_debug();
}

if(!file_exists("middle/datanew-ok.csv")) {
	console_debug("middle/datanew-ok.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok2.csv")) {
	console_debug("middle/datanew-ok2.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok2.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok3.csv")) {
	console_debug("middle/datanew-ok3.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok3.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok4.csv")) {
	console_debug("middle/datanew-ok4.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=$val[8].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok4.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok5.csv")) {
	console_debug("middle/datanew-ok5.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok5.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok6.csv")) {
	console_debug("middle/datanew-ok6.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok6.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok7.csv")) {
	console_debug("middle/datanew-ok7.csv");
	$files=glob("input/momo/data.????????.csv.gz");
	sort($files);
	$sumas=array();
	foreach($files as $file) {
		$data=import_file($file);
		$temp=explode(".",$file);
		$temp=str_split($temp[1],2);
		$fecha=$temp[0].$temp[1]."-".$temp[2]."-".$temp[3];
		foreach($data as $key=>$val) {
			if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
				$key2=$fecha.";".substr($val[8],0,7);
				if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
				$sumas[$key2][1]+=str_replace(".","",$val[9]);
			}
			unset($data[$key]);
		}
	}
	export_file("middle/datanew-ok7.csv",$sumas);
	console_debug();
}

?>