<?php

if(!file_exists("output/plot10${lang}.png")) {
	console_debug("output/plot10${lang}.png");
	$sweden=import_file("middle/preliminar_statistik_over_doda_inkl_eng.csv");
	$months=array(
		"januari"=>1,
		"februari"=>2,
		"mars"=>3,
		"april"=>4,
		"maj"=>5,
		"juni"=>6,
		"juli"=>7,
		"augusti"=>8,
		"september"=>9,
		"oktober"=>10,
		"november"=>11,
		"december"=>12,
	);
	$header=array_shift($sweden);
	foreach($sweden as $key=>$val) {
		$temp=explode(" ",$val[0]." 2020");
		$temp[1]=$months[$temp[1]];
		$val[0]=sprintf("%04d-%02d-%02d",$temp[2],$temp[1],$temp[0]);
		foreach($val as $key2=>$val2) if($val2=="0") $val[$key2]="";
		$sweden[$key]=$val;
	}
	array_unshift($sweden,$header);
	export_file("middle/plot10${lang}.csv",$sweden);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',10'",
		"set title \"".$textos["plots"]["10"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:500]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,100,400",
		"set datafile separator ';'",
		"set output 'output/plot10${lang}.png'",
		"plot 'middle/plot10${lang}.csv' u 1:2 w l ti col,'' u 1:3 w l ti col,'' u 1:4 w l ti col,'' u 1:5 w l ti col,'' u 1:6 w l ti col,'' u 1:7 w l lc 7 ti col",
	))."\n";
	file_put_contents("middle/plot10${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot10${lang}.gnu 2>&1");
	unset($sweden);
	unset($months);
	unset($header);
	unset($gnuplot);
	console_debug();
}

?>