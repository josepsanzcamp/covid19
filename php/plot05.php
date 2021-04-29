<?php

if(!file_exists("output/plot05${lang}1.png")) {
	console_debug("output/plot05${lang}1.png");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[0]]=$val[0]." ".ccaa2fix($val[1]);
	}
	$momonew=import_file("middle/datanew-ok5.csv");
	$ine=import_file("middle/6562-ok2.csv");
	$matrix=array();
	$years=array(2021,2020,2018,2017,2015,2014,2012,2009,2005,2000,1999);
	foreach($years as $year) {
		foreach($ccaas as $ccaa) {
			$matrix[$ccaa][$year]=0;
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momonew as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if(!in_array($year,array(2020,2021))) continue;
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	$matrix["18 Ceuta + 19 Melilla"]=array(
		$matrix["18 Ceuta"][2021]+$matrix["19 Melilla"][2021],
		$matrix["18 Ceuta"][2020]+$matrix["19 Melilla"][2020],
		$matrix["18 Ceuta"][2018]+$matrix["19 Melilla"][2018],
		$matrix["18 Ceuta"][2017]+$matrix["19 Melilla"][2017],
		$matrix["18 Ceuta"][2015]+$matrix["19 Melilla"][2015],
		$matrix["18 Ceuta"][2014]+$matrix["19 Melilla"][2014],
		$matrix["18 Ceuta"][2012]+$matrix["19 Melilla"][2012],
		$matrix["18 Ceuta"][2009]+$matrix["19 Melilla"][2009],
		$matrix["18 Ceuta"][2005]+$matrix["19 Melilla"][2005],
		$matrix["18 Ceuta"][2000]+$matrix["19 Melilla"][2000],
		$matrix["18 Ceuta"][1999]+$matrix["19 Melilla"][1999],
	);
	unset($matrix["18 Ceuta"]);
	unset($matrix["19 Melilla"]);
	$ccaas=array(
		"03 Principado de Asturias"=>"03 Principado\\nAsturias",
		"04 Illes Balears"=>"04 Illes\\nBalears",
		"07 Castilla y León"=>"07 Castilla\\ny León",
		"08 Castilla - La Mancha"=>"08 Castilla\\nLa Mancha",
		"10 Comunitat Valenciana"=>"10 Comunitat\\nValenciana",
		"13 Comunidad de Madrid"=>"13 Comunidad\\nde Madrid",
		"14 Región de Murcia"=>"14 Región\\nde Murcia",
		"15 Comunidad Foral de Navarra"=>"15 Comunidad\\nForal de Navarra",
		"18 Ceuta + 19 Melilla"=>"18 Ceuta\\n19 Melilla",
	);
	foreach($matrix as $key=>$val) {
		$ccaa=isset($ccaas[$key])?$ccaas[$key]:$key;
		$matrix[$key]=array_merge(array($ccaa),$val);
	}
	array_unshift($matrix,array_merge(array("CCAA"),$header));
	export_file("middle/plot05${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["05"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:30000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set style histogram gap 3",
		"set ytic center rotate by 90",
		"set ytics 0,5000,25000",
		"set datafile separator '".SEPARADOR."'",
		"set colors classic",
		"set key maxrows 7",
		"set output 'output/plot05${lang}1.png'",
		"set xrange [-0.5:5.5]",
		"plot 'middle/plot05${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"set output 'output/plot05${lang}2.png'",
		"set xrange [5.5:11.5]",
		"plot 'middle/plot05${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"set output 'output/plot05${lang}3.png'",
		"set xrange [11.5:17.5]",
		"plot 'middle/plot05${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot05${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot05${lang}.gnu 2>&1");
	unset($temp);
	unset($ccaas);
	unset($momonew);
	unset($ine);
	unset($matrix);
	unset($years);
	unset($header);
	unset($gnuplot);
	console_debug();
}

?>