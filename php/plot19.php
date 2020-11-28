<?php

if(!file_exists("output/plot19${lang}.png")) {
	console_debug("output/plot19${lang}.png");
	$ine=import_file("middle/35177-ok2.csv");
	$matrix=array();
	for($i=1;$i<=53;$i++) {
		$j=sprintf("%02d",$i);
		$k=date("Y-m-d",strtotime("2020W".$j)+86400*2);
		$matrix[$j]=array($k,"","","","","","");
	}
	foreach($ine as $key=>$val) {
		$year=strtok($val[0],"-");
		$week=strtok("");
		$offset=$year-2014;
		if($offset>0 && isset($matrix[$week])) {
			$matrix[$week][$offset]=$val[1];
		}
		unset($ine[$key]);
	}
	array_unshift($matrix,array("Fecha","2015","2016","2017","2018","2019","2020"));
	export_file("middle/plot19${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',10'",
		"set title \"".$textos["plots"]["19"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:30000]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,6000,24000",
		"set datafile separator ';'",
		"set output 'output/plot19${lang}.png'",
		"plot 'middle/plot19${lang}.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp ti col",
	))."\n";
	file_put_contents("middle/plot19${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot19${lang}.gnu 2>&1");
	unset($ine);
	unset($matrix);
	unset($gnuplot);
	console_debug();
}

?>