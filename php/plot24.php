<?php

if(!file_exists("output/plot24${lang}1.png")) {
	console_debug("output/plot24${lang}1.png");
	$files=glob("middle/data.????????.csv");
	sort($files);
	$matrix1=array();
	$momoold=array();
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(in_array($part,array(20200507,20200523,20200527))) continue;
		$data=import_file($file);
		$data=array_slice($data,-90); // PER FER SERVIR NOMES LES DADES DELS DARRERS 90 DIES
		$momonew=array();
		$unused=$momoold;
		foreach($data as $key=>$val) {
			unset($unused[$val[0]]);
			$momonew[$val[0]]=$val[1];
		}
		foreach($unused as $key=>$val) {
			unset($momoold[$key]);
		}
		$old=array_sum($momoold);
		$new=array_sum($momonew);
		$diff=$new-$old;
		if(!count($momoold)) $diff=0;
		$date=substr($part,0,4)."-".substr($part,4,2)."-".substr($part,6,2);
		$matrix1[]=array($date,$diff);
		$momoold=$momonew;
	}
	$matrix2=array();
	foreach($matrix1 as $key=>$val) {
		$week=date("o-W",strtotime($val[0])+86400*3); // PER COMENÇAR LA SETMANA EN DIVENDRES
		if(!isset($matrix2[$week])) $matrix2[$week]=array($val[0],0);
		$matrix2[$week][1]+=$val[1];
	}
	$otros=import_file("middle/7947-ok.csv");
	foreach($otros as $key=>$val) {
		$year=$val[0];
		if($year!=2018) continue;
		$media=round($val[1]/365,0);
		foreach($matrix1 as $key2=>$val2) {
			$matrix1[$key2][2]=$media;
		}
		foreach($matrix2 as $key2=>$val2) {
			$matrix2[$key2][2]=$media*7;
		}
	}
	array_unshift($matrix1,array($textos["plot24"]["fecha"][$lang],$textos["plot24"]["diario"][$lang],$textos["plot24"]["media"][$lang]));
	export_file("middle/plot24${lang}1.csv",$matrix1);
	array_unshift($matrix2,array($textos["plot24"]["fecha"][$lang],$textos["plot24"]["semanal"][$lang],$textos["plot24"]["media"][$lang]));
	export_file("middle/plot24${lang}2.csv",$matrix2);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["24"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set auto y",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xtics '2020-07-01',86400*30,'2021-05-01'",
		"set xrange ['2020-06-01':'2021-06-01']",
		"set ytic center rotate by 90",
		"set datafile separator '".SEPARADOR."'",
		"set colors classic",
		"set ytics 0,2000,8000",
		"set output 'output/plot24${lang}1.png'",
		"set label 1 \"".$textos["plot24"]["escala"][$lang]."\" at '2020-09-15',7000 c tc lt 1",
		"plot 'middle/plot24${lang}1.csv' u 1:2 w l ti col, '' u 1:3 w l ti col",
		"set ytics 0,2000,20000",
		"set output 'output/plot24${lang}2.png'",
		"set label 1 \"".$textos["plot24"]["escala"][$lang]."\" at '2020-09-15',13000 c tc lt 1",
		"plot 'middle/plot24${lang}2.csv' u 1:2 w lp ti col, '' u 1:3 w l ti col",
	))."\n";
	file_put_contents("middle/plot24${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot24${lang}.gnu 2>&1");
	unset($momoold);
	unset($momonew);
	unset($data);
	unset($matrix1);
	unset($matrix2);
	unset($gnuplot);
	console_debug();
}

?>