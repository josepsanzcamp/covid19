<?php

if(!file_exists("output/plot20${lang}.png")) {
	console_debug("output/plot20${lang}.png");
	$indef=import_file("middle/defunciones.csv");
	$matrix=array();
	foreach($indef as $key=>$val) {
		if(in_array($val[0],array("Fecha",2017,2018,2019,2020))) {
			foreach($val as $key2=>$val2) {
				$matrix[$key2][$key]=$val2;
			}
		}
	}
	export_file("middle/plot20${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["20"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 5",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:500000]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2019-02-01':'2021-02-01']",
		"set xtics rotate by -45",
		"set ytic center rotate by 90",
		"set ytics 0,100000,400000",
		"set datafile separator '".SEPARADOR."'",
		"set colors classic",
		"set key at '2021-02-01',185000",
		"set output 'output/plot20${lang}.png'",
		"plot 'middle/plot20${lang}.csv' u 1:2:xtic(1) w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col",
	))."\n";
	file_put_contents("middle/plot20${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot20${lang}.gnu 2>&1");
	unset($indef);
	unset($gnuplot);
	console_debug();
}

?>