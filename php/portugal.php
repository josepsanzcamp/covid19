<?php

if(!file_exists("middle/dados_sico.csv")) {
	console_debug("middle/dados_sico.csv");
	$buffer=get_file("input/portugal/Dados_SICO.js.gz");
	$key1='<script type="application/json" data-for="htmlwidget-';
	$key2='">';
	$key3="</script>";
	$pos1=strpos($buffer,$key1);
	$pos2=strpos($buffer,$key2,$pos1);
	$pos3=strpos($buffer,$key3,$pos2);
	if($pos1===false || $pos2===false || $pos3===false) die("ERROR 5");
	$len2=strlen($key2);
	$buffer=substr($buffer,$pos2+$len2,$pos3-$pos2-$len2);
	$json=json_decode($buffer,true);
	$data=$json["x"]["data"];
	$matrix=array();
	foreach($data as $key=>$val) {
		foreach($val as $key2=>$val2) {
			$matrix[$key2][$key]=$val2;
		}
		unset($data[$key]);
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
	export_file("middle/dados_sico.csv",$matrix);
	unset($buffer);
	unset($json);
	unset($data);
	unset($head);
	unset($matrix);
	console_debug();
}

?>