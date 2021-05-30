<?php

if(!file_exists("output/plot26${lang}.png")) {
	console_debug("output/plot26${lang}.png");
	$data=import_file("middle/datanew-ok8.csv");
	array_unshift($data,array($textos["plot26"]["fecha1"][$lang],$textos["plot26"]["fecha2"][$lang],$textos["plot26"]["diff"][$lang]));
	export_file("middle/plot26${lang}.csv",$data);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["26"][$lang]."\"",
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
		"set xtics '2020-06-01',86400*30,'2021-06-01'",
		"set xrange ['2020-05-01':'2021-07-01']",
		"set ytic center rotate by 90",
		"set datafile separator '".SEPARADOR."'",
		"set colors classic",
		"set output 'output/plot26${lang}.png'",
		"plot 'middle/plot26${lang}.csv' u 2:3 w l ti col",
	))."\n";
	file_put_contents("middle/plot26${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot26${lang}.gnu 2>&1");
	unset($gnuplot);
	console_debug();
}

?>