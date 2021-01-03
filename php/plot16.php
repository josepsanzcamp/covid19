<?php

if(!file_exists("output/plot16${lang}.png")) {
	console_debug("output/plot16${lang}.png");
	$france=import_file("middle/dc_20xx_det.csv");
	$matrix=array();
	for($i=strtotime("2020-01-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
		$fecha=date("Y-m-d",$i);
		$i=strtotime($fecha." 12:00:00");
		$matrix[$fecha]=array($fecha,"","","");
	}
	foreach($france as $key=>$val) {
		$year=strtok($val[0],"-");
		if(isset($matrix[$val[0]])) $matrix[$val[0]][1]=$val[1];
		if($year==2019) {
			$val[0]=str_replace(2019,2020,$val[0]);
			if(isset($matrix[$val[0]])) $matrix[$val[0]][2]=$val[1];
		}
		if($year==2018) {
			$val[0]=str_replace(2018,2020,$val[0]);
			if(isset($matrix[$val[0]])) $matrix[$val[0]][3]=$val[1];
		}
		unset($france[$key]);
	}
	array_unshift($matrix,array("Fecha","2020","2019","2018"));
	export_file("middle/plot16${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["16"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:3500]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,500,3000",
		"set datafile separator ';'",
		"set colors classic",
		"set output 'output/plot16${lang}.png'",
		"plot 'middle/plot16${lang}.csv' u 1:4 w l ti col,'' u 1:3 w l ti col,'' u 1:2 w l ti col",
	))."\n";
	file_put_contents("middle/plot16${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot16${lang}.gnu 2>&1");
	unset($france);
	unset($matrix);
	unset($gnuplot);
	console_debug();
}

?>