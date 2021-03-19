<?php

if(!file_exists("output/plot15${lang}.gif")) {
	console_debug("output/plot15${lang}.gif");
	$momonew=import_file("middle/datanew-ok2.csv");
	$files=glob("middle/data.????????.csv");
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if($part<"20201002" || $part>"20210111") continue;
		if(file_exists("output/plot15${lang}.${part}.gif")) continue;
		$momo=import_file($file);
		if(!isset($otros)) $otros=import_file("middle/7947-ok.csv");
		$matrix=array();
		for($i=strtotime("2020-10-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
			$fecha=date("Y-m-d",$i);
			$i=strtotime($fecha." 12:00:00");
			$matrix[$fecha]=array($fecha,"","","","");
		}
		foreach($momo as $key=>$val) {
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
			unset($momo[$key]);
		}
		foreach($otros as $key=>$val) {
			$year=$val[0];
			if($year!=2018) continue;
			$media=round($val[1]/365,0);
			foreach($matrix as $key2=>$val2) {
				$matrix[$key2][4]=$media;
			}
		}
		// CORRECCIO FALTA DE DADES DEL 2018
		foreach($momonew as $key=>$val) {
			$year=strtok($val[0],"-");
			if($year==2018) {
				$val[0]=str_replace(2018,2020,$val[0]);
				if(isset($matrix[$val[0]]) && $matrix[$val[0]][3]=="") $matrix[$val[0]][3]=$val[1];
			}
		}
		// CONTINUAR
		array_unshift($matrix,array("Fecha","2020","2019","2018","INE2018"));
		export_file("middle/plot15${lang}.${part}.csv",$matrix);
		$fecha=substr($part,0,4)."-".substr($part,4,2)."-".substr($part,6,2);
		$gnuplot=implode("\n",array(
			"set terminal gif size 1200,600 enhanced font ',11'",
			"set title \"".$textos["plots"]["15"][$lang]." (${fecha})\"",
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
			"set xtics '2020-01-06',86400*14,'2021-01-01'",
			"set ytic center rotate by 90",
			"set ytics 0,500,3000",
			"set datafile separator '".SEPARADOR."'",
			"set colors classic",
			"set output 'output/plot15${lang}.${part}.gif'",
			"set xrange ['2020-10-01':'2021-01-01']",
			"plot 'middle/plot15${lang}.${part}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w l ti col",
		))."\n";
		file_put_contents("middle/plot15${lang}.${part}.gnu",$gnuplot);
		passthru("gnuplot middle/plot15${lang}.${part}.gnu 2>&1");
	}
	passthru("convert -delay 25 -loop 1 output/plot15${lang}.????????.gif output/plot15${lang}.gif 2>&1");
	unset($momonew);
	unset($momo);
	unset($otros);
	unset($matrix);
	unset($gnuplot);
	console_debug();
}

?>