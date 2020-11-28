<?php

if(!file_exists("output/plot08${lang}1.png")) {
	console_debug("output/plot08${lang}1.png");
	$data=import_file("middle/datanew-ok7.csv");
	$axis0=array();
	$axis1=array();
	foreach($data as $key=>$val) {
		if(!isset($axis0[$val[0]])) $axis0[$val[0]]=$val[0];
		//~ if(!isset($axis1[$val[1]])) $axis1[$val[1]]=$val[1];
	}
	for($i=strtotime("2018-01-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
		$fecha=date("Y-m",$i);
		$axis1[$fecha]=$fecha;
	}
	$matrix=array();
	foreach($axis1 as $key=>$val) {
		$matrix[$val][$val]=$val;
		foreach($axis0 as $key2=>$val2) {
			$matrix[$val][$val2]="";
		}
	}
	foreach($data as $key=>$val) {
		if($matrix[$val[1]][$val[0]]!="") die("ERROR 9");
		$matrix[$val[1]][$val[0]]=$val[2];
	}
	$diff0=array_values(array_slice($axis0,0,-1));
	$diff1=array_values(array_slice($axis0,1));
	$axis2=array();
	foreach($diff0 as $key=>$val) {
		$val2=$diff1[$key];
		$key2=$val." - ".$val2;
		$axis2[]=$key2;
		foreach($matrix as $key3=>$val3) {
			if(is_numeric($val3[$val2]) && is_numeric($val3[$val])) {
				$matrix[$key3][$key2]=$val3[$val2]-$val3[$val];
			} else {
				$matrix[$key3][$key2]="";
			}
		}
	}
	foreach($matrix as $key=>$val) {
		$temp=explode("-",$key);
		$matrix[$key][$key]=$textos["meses"][$lang][$temp[1]]."\\n".$temp[0];
	}
	array_unshift($matrix,array_merge(array("Mes"),$axis0,$axis2));
	export_file("middle/plot08${lang}.csv",$matrix);
	$cols2plot1=array();
	for($i=0;$i<count($axis0);$i++) {
		$col=$i+2;
		$cols2plot1[]="u ${col}:xtic(1) ti col";
	}
	$cols2plot1=implode(", '' ",$cols2plot1);
	$cols2plot2=array();
	for($i=0;$i<count($axis2);$i++) {
		$col=$i+2+count($axis0);
		$cols2plot2[]="u ${col}:xtic(1) ti col";
	}
	$cols2plot2=implode(", '' ",$cols2plot2);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',10'",
		"set title \"".$textos["plots"]["08"][$lang]."\"",
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
		"set datafile separator ';'",
		"set output 'output/plot08${lang}1.png'",
		"set xrange [-0.5:11.5]",
		"plot 'middle/plot08${lang}.csv' ${cols2plot1}",
		"set output 'output/plot08${lang}2.png'",
		"set xrange [11.5:23.5]",
		"plot 'middle/plot08${lang}.csv' ${cols2plot1}",
		"set output 'output/plot08${lang}3.png'",
		"set xrange [23.5:35.5]",
		"plot 'middle/plot08${lang}.csv' ${cols2plot1}",
		"set label 1 \"".$textos["escala"][$lang]."\" at 15.5,9000 c tc lt 1",
		"set yrange [0:10000]",
		"set ytics 0,2000,8000",
		"set xtic rotate by -45",
		"set output 'output/plot08${lang}4.png'",
		"set xrange [3.5:27.5]",
		"set bmargin 5",
		"plot 'middle/plot08${lang}.csv' ${cols2plot2}",
	))."\n";
	file_put_contents("middle/plot08${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot08${lang}.gnu 2>&1");
	unset($data);
	unset($axis0);
	unset($axis1);
	unset($matrix);
	unset($diff0);
	unset($diff1);
	unset($axis2);
	unset($cols2plot1);
	unset($cols2plot2);
	unset($gnuplot);
	console_debug();
}

?>