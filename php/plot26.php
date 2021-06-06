<?php

if(!file_exists("output/plot26${lang}.png")) {
	console_debug("output/plot26${lang}.png");
	$files=glob("middle/data.????????.csv");
	sort($files);
	$rows=array();
	foreach($files as $key=>$val) {
		if($key==0) continue;
		$prev=$files[$key-1];
		ob_start();
		passthru("bash -c 'diff <(head -n 365 $prev) <(head -n 365 $val)' | grep -e '<' -e '>' | wc -l");
		$diff=trim(ob_get_clean());
		$fecha1=explode(".",$prev);
		$fecha1=str_split($fecha1[1],2);
		$fecha1=$fecha1[0].$fecha1[1]."-".$fecha1[2]."-".$fecha1[3];
		$fecha2=explode(".",$val);
		$fecha2=str_split($fecha2[1],2);
		$fecha2=$fecha2[0].$fecha2[1]."-".$fecha2[2]."-".$fecha2[3];
		$rows[]=array($fecha1,$fecha2,$diff);
	}
	array_unshift($rows,array($textos["plot26"]["fecha1"][$lang],$textos["plot26"]["fecha2"][$lang],$textos["plot26"]["diff"][$lang]));
	export_file("middle/plot26${lang}.csv",$rows);
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