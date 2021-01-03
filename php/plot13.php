<?php

if(!file_exists("output/plot13${lang}.png")) {
	console_debug("output/plot13${lang}.png");
	$portugal=import_file("middle/dados_sico.csv");
	$months=array(
		"Jan"=>1,
		"Fev"=>2,
		"Mar"=>3,
		"Abr"=>4,
		"Mai"=>5,
		"Jun"=>6,
		"Jul"=>7,
		"Ago"=>8,
		"Set"=>9,
		"Out"=>10,
		"Nov"=>11,
		"Dez"=>12,
	);
	$header=array_shift($portugal);
	foreach($portugal as $key=>$val) {
		$temp=explode("-",$val[0]."-2020");
		$temp[0]=$months[$temp[0]];
		$val[0]=sprintf("%04d-%02d-%02d",$temp[2],$temp[0],$temp[1]);
		//~ foreach($val as $key2=>$val2) if($val2=="0") $val[$key2]="";
		$portugal[$key]=$val;
	}
	array_unshift($portugal,$header);
	export_file("middle/plot13${lang}.csv",$portugal);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["13"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:700]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,100,600",
		"set datafile separator ';'",
		"set colors classic",
		"set output 'output/plot13${lang}.png'",
		"plot 'middle/plot13${lang}.csv' u 1:8 w l ti col,'' u 1:9 w l ti col,'' u 1:10 w l ti col,'' u 1:11 w l ti col,'' u 1:12 w l ti col,'' u 1:13 w l ti col",
	))."\n";
	file_put_contents("middle/plot13${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot13${lang}.gnu 2>&1");
	unset($portugal);
	unset($months);
	unset($header);
	unset($gnuplot);
	console_debug();
}

?>