<?php

if(count(glob("middle/data.????????.csv"))!=count(glob("input/momo/data.????????.csv.gz"))) {
	console_debug("middle/data.????????.csv");
	$files=glob("input/momo/data.????????.csv.gz");
	sort($files);
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("middle/data.${part}.csv")) continue;
		$data=import_file_with_grep($file,"grep nacional | grep -v -e hombres -e mujeres -e edad");
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

if(!file_exists("middle/datanew-ok8.csv")) {
	console_debug("middle/datanew-ok8.csv");
	$files=glob("middle/data.????????.csv");
	sort($files);
	$last=end($files);
	$prev="";
	$rows=array(array("From","To","Diff"));
	foreach($files as $key=>$val) {
		if($prev!="" && $val!=$last) {
			ob_start();
			passthru("bash -c \"diff <(head -n 365 $prev) <(head -n 365 $val) | wc -l\"");
			$diff=trim(ob_get_clean());
			$from=explode(".",$prev);
			$from=str_split($from[1],2);
			$from=$from[0].$from[1]."-".$from[2]."-".$from[3];
			$to=explode(".",$val);
			$to=str_split($to[1],2);
			$to=$to[0].$to[1]."-".$to[2]."-".$to[3];
			$rows[]=array($from,$to,$diff);
		}
		$prev=$val;
	}
	export_file("middle/datanew-ok8.csv",$rows);
	console_debug();
}

?>