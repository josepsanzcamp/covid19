<?php

if(!file_exists("output/plot21${lang}.png")) {
	console_debug("output/plot21${lang}.png");
	$ine1451=import_file("input/ine/1451.csv.gz");
	$ine1452=import_file("input/ine/1452.csv.gz");
	$ine3198=import_file("input/ine/3198.csv.gz");
	$ine1726=import_file("input/ine/1726.csv.gz");
	$matrix=array();
	$matrix[]=array("Fecha","1451","1452","3198","1726");
	foreach($matrix[0] as $key=>$val) {
		if(isset($textos["plot21"][$val][$lang])) {
			$matrix[0][$key]=$textos["plot21"][$val][$lang];
		}
	}
	for($i=1975;$i<=2020;$i++) {
		$matrix[$i]=array($i,"","","","");
	}
	foreach($ine1451 as $key=>$val) {
		if($val[0]=="Total Nacional" && $val[1]=="65 y más años") {
			$matrix[$val[2]][1]=str_replace(",",".",$val[3]);
		}
	}
	foreach($ine1452 as $key=>$val) {
		if($val[0]=="Total Nacional") {
			$matrix[$val[1]][2]=str_replace(",",".",$val[2]);
		}
	}
	foreach($ine3198 as $key=>$val) {
		if($val[0]=="Total Nacional" && $val[1]=="Ambos sexos") {
			$matrix[$val[2]][3]=str_replace(",",".",$val[3]);
		}
	}
	foreach($ine1726 as $key=>$val) {
		if($val[0]=="Total Nacional" && $val[1]=="Ambos sexos") {
			$matrix[$val[2]][4]=str_replace(",",".",$val[3]);
		}
	}
	export_file("middle/plot21${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["21"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45",
		"set style histogram gap 3",
		"set yrange [0:150]",
		"set ytic center rotate by 90",
		"set ytics 0,25,125",
		"set datafile separator '".SEPARADOR."'",
		"set colors classic",
		"set output 'output/plot21${lang}.png'",
		"plot 'middle/plot21${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w lp ti col",
	))."\n";
	file_put_contents("middle/plot21${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot21${lang}.gnu 2>&1");
	unset($indef);
	unset($gnuplot);
	console_debug();
}

?>