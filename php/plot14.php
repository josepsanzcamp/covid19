<?php

if(!file_exists("output/plot14${lang}.png")) {
	console_debug("output/plot14${lang}.png");
	$momo=import_file("middle/datanew-ok.csv");
	$ine1=import_file("middle/02001-ok.csv");
	$ine2=import_file("middle/14819-ok.csv");
	$ine3=import_file("middle/02002-ok2.csv");
	// CREAR LLISTA AMB LES DADES DEL MOMO PER L'ANY 2020
	// LA IDEA ORIGINAL ERA FENT SERVIR OCTUBRE, NOVEMBRE I DESEMBRE DEL AL ANY ANTERIOR
	// DESPRES VA EVOLUCIONAR PER FER-HO AMB TOTS ELS MESOS DE L'ANY
	// L'ARRAY DE SORTIDA TINDRA 12 ELEMENTS QUE SON ELS SUMATORIS DELS MESOS DE L'ANY + ANY ANTERIOR PER LA POSICIO QUE TOQUI
	// PER EXEMPLE:
	// LA POSICIO 0 TE TOTES LES DADES DEL ANY QUE TOCA
	// LA POSICIO 1 TE LES DADES DE TOT EL ANY EXCEPTE PER DESEMBRE QUE FA SERVIR LES DEL ANY ANTERIOR
	// LA POSICIO 2 TE LES DADES DE TOT EL ANY EXCEPTE PER NOVEMBRE I DESEMBRE
	// LA POSICIO 3 TE LES DADES DE TOT EL ANY EXCEPTE PER OCTUBRE, NOVEMBRE I DESEMBRE
	// LA POSICIO 4 TE LES DADES DE TOT EL ANY EXCEPTE PER SETEMBRE, OCTUBRE, NOVEMBRE I DESEMBRE
	// LA POSICIO 5 TE LES DADES DE TOT EL ANY EXCEPTE PER AGOST, SETEMBRE, OCTUBRE, NOVEMBRE I DESEMBRE
	// LA POSICIO 6 TE LES DADES DE TOT EL ANY EXCEPTE PER JULIOL, AGOST, SETEMBRE, OCTUBRE, NOVEMBRE I DESEMBRE
	// LA POSICIO 7 TE LES DADES DE TOT EL ANY EXCEPTE PER JUNY, JULIOL, AGOST, SETEMBRE, OCTUBRE, NOVEMBRE I DESEMBRE
	$matrix1=array();
	foreach($momo as $key=>$val) {
		for($i=0;$i<8;$i++) {
			$year=strtok($val[0],"-");
			$month=intval(strtok(""));
			if($month>12-$i) $year++;
			if(!isset($matrix1[$year])) $matrix1[$year]=array_fill(0,8,0);
			$matrix1[$year][$i]+=$val[1];
		}
	}
	$matrix1=array(2020=>$matrix1[2020]);
	// IDEM PERO PER LES DADES DEL INE1 PER L'ANY 2019
	$matrix2=array();
	foreach($ine1 as $key=>$val) {
		for($i=0;$i<8;$i++) {
			$year=strtok($val[0],"-");
			$month=intval(strtok(""));
			if($month>12-$i) $year++;
			if(!isset($matrix2[$year])) $matrix2[$year]=array_fill(0,8,0);
			$matrix2[$year][$i]+=$val[1];
		}
	}
	$matrix2=array(2019=>$matrix2[2019]);
	// IDEM PERO PER LES DADES DEL INE2 PER LA RESTA D'ANYS (2018 A 1981)
	// HAY QUE QUITAR LOS EXTREMOS PORQUE TIENEN SOLO FRAGMENTOS DE AÑO
	$matrix3=array();
	foreach($ine2 as $key=>$val) {
		for($i=0;$i<8;$i++) {
			$year=strtok($val[0],"-");
			$month=intval(strtok(""));
			if($month>12-$i) $year++;
			if(!isset($matrix3[$year])) $matrix3[$year]=array_fill(0,8,0);
			$matrix3[$year][$i]+=$val[1];
		}
	}
	unset($matrix3[2019]);
	unset($matrix3[1980]);
	// PREPARAR PER GUARDAR LES DADES AL FITXER CSV DEL PLOT
	$matrix=array("Any"=>array())+$matrix1+$matrix2+$matrix3;
	foreach($textos["plot14"] as $texto) {
		$matrix["Any"][]=$texto[$lang];
	}
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array_merge(array($key),$val);
	}
	// AGEGIR LES DADES DE LA POBLACIO
	$ine3=array_combine(array_column($ine3,0),array_column($ine3,1));
	foreach($matrix as $key=>$val) {
		if($key=="Any") continue;
		if(isset($ine3[$key])) {
			$matrix[$key][]=$ine3[$key]/100;
		} else {
			$matrix[$key][]="";
		}
	}
	// CONTINUAR
	export_file("middle/plot14${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["14"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45",
		"set style histogram gap 3",
		"set yrange [0:600000]",
		"set ytic center rotate by 90",
		"set ytics 0,100000,500000",
		"set datafile separator ';'",
		"set colors classic",
		"set key at 2020,300000",
		"set output 'output/plot14${lang}.png'",
		"plot 'middle/plot14${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w lp ti col, '' u 1:6 w lp ti col, '' u 1:7 w lp ti col, '' u 1:8 w lp ti col, '' u 1:9 w lp ti col, '' u 1:10 w lp ti col",
	))."\n";
	file_put_contents("middle/plot14${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot14${lang}.gnu 2>&1");
	unset($momo);
	unset($ine1);
	unset($ine2);
	unset($ine3);
	unset($matrix1);
	unset($matrix2);
	unset($matrix3);
	unset($matrix);
	unset($gnuplot);
	console_debug();
}

?>