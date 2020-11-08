<?php

function import_file($file) {
	if(pathinfo($file,PATHINFO_EXTENSION)=="gz") $file="compress.zlib://".$file;
	$data=file($file,FILE_IGNORE_NEW_LINES);
	$sep="";
	if($sep=="" && strpos($data[0],";")!==false) $sep=";";
	if($sep=="" && strpos($data[0],",")!==false) $sep=",";
	foreach($data as $key=>$val) {
		$val=explode($sep,$val);
		$count=count($val);
		for($i=0;$i<$count;$i++) {
			if(substr($val[$i],0,1)=='"') {
				$val[$i]=substr($val[$i],1);
				for($j=$i;$j<$count;$j++) {
					if(substr($val[$j],-1,1)=='"') {
						$val[$j]=substr($val[$j],0,-1);
						for($k=$i+1;$k<=$j;$k++) {
							$val[$i].=$sep.$val[$k];
							unset($val[$k]);
						}
						$i=$j;
						break;
					}
				}
			}
		}
		$data[$key]=array_values($val);
	}
	return $data;
}

function export_file($file,$data) {
	foreach($data as $key=>$val) {
		$data[$key]=implode(";",$val);
	}
	$data=implode("\n",$data)."\n";
	file_put_contents($file,$data);
}

function get_file($file) {
	if(pathinfo($file,PATHINFO_EXTENSION)=="gz") $file="compress.zlib://".$file;
	return file_get_contents($file);
}

?>