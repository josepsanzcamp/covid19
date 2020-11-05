<?php

if(!file_exists("output/plot17${lang}.png")) {
	console_debug("output/plot17${lang}.png");
	$files=glob("input/germany/*.csv");
	rsort($files);
	$germany=import_file($files[0]);
	foreach($germany as $key=>$val) {
		unset($val[6]);
		$germany[$key]=$val;
	}
	$header=array_shift($germany);
	foreach($germany as $key=>$val) {
		$val[0]=sprintf("%02d",$val[0]);
		$val[0]=date("Y-m-d",strtotime("2020W".$val[0])+86400*2);
		$germany[$key]=$val;
	}
	array_unshift($germany,$header);
	export_file("middle/plot17${lang}.csv",$germany);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["17"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:35000]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,5000,30000",
		"set datafile separator ';'",
		"set output 'output/plot17${lang}.png'",
		"plot 'middle/plot17${lang}.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col",
	))."\n";
	file_put_contents("middle/plot17${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot17${lang}.gnu 2>&1");
	console_debug();
}

?>