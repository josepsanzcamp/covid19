<?php

if(!file_exists("output/plot01${lang}1.png")) {
	console_debug("output/plot01${lang}1.png");
	$momonew=import_file("middle/datanew-ok.csv");
	$ine1=import_file("middle/02001-ok.csv");
	$ine2=import_file("middle/14819-ok.csv");
	$matrix=array();
	$years=array(2021,2020,2019,2018,2017,2015,2014,2012,2009,2005,2000,1999);
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($years as $year) {
		foreach($months as $month) {
			$month=sprintf("%02d",$month);
			$matrix[$month][$year]="";
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momonew as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($year,array(2020,2021))) continue;
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	foreach($ine1 as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	foreach($ine2 as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array_merge(array($textos["meses"][$lang][$key]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("middle/plot01${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["01"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set style histogram gap 3",
		"set ytic center rotate by 90",
		"set ytics 0,10000,50000",
		"set datafile separator '".SEPARADOR."'",
		"set colors classic",
		"set key maxrows 6",
		"set output 'output/plot01${lang}1.png'",
		"set xrange [-0.5:5.5]",
		"plot 'middle/plot01${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
		"set output 'output/plot01${lang}2.png'",
		"set xrange [5.5:11.5]",
		"plot 'middle/plot01${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot01${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot01${lang}.gnu 2>&1");
	unset($momonew);
	unset($ine1);
	unset($ine2);
	unset($matrix);
	unset($years);
	unset($months);
	unset($header);
	unset($gnuplot);
	console_debug();
}

?>