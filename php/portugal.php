<?php

if(!file_exists("middle/Dados_SICO.csv")) {
	console_debug("middle/Dados_SICO.csv");
	$buffer=get_file("input/portugal/Dados_SICO.js.gz");
	$key1='<script type="application/json" data-for="htmlwidget-5abfcfeac25bac676711">';
	$key2="</script>";
	$pos1=strpos($buffer,$key1);
	$pos2=strpos($buffer,$key2);
	if($pos1===false || $pos2===false) die("ERROR 5");
	$len1=strlen($key1);
	$buffer=substr($buffer,$pos1+$len1,$pos2-$pos1-$len1);
	$json=json_decode($buffer,true);
	$data=$json["x"]["data"];
	$matrix=array();
	foreach($data as $key=>$val) {
		foreach($val as $key2=>$val2) {
			$matrix[$key2][$key]=$val2;
		}
	}
	$head=$json["x"]["container"];
	$head=explode("\n",$head);
	foreach($head as $key=>$val) {
		$val=trim($val);
		if(strpos($val,"<th>")!==false || strpos($val,"<td>")!==false) {
			$head[$key]=str_replace(array("<th>","</th>","<td>","</td>"),"",$val);
		} else {
			unset($head[$key]);
		}
	}
	array_unshift($matrix,$head);
	export_file("middle/Dados_SICO.csv",$matrix);
	console_debug();
}

?>