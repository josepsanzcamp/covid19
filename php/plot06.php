<?php

if(!file_exists("output/plot06${lang}.png")) {
	console_debug("output/plot06${lang}.png");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[0]]=$val[0]." ".$val[1];
	}
	$resi=import_file("middle/residencias.csv");
	$matrix=array();
	$tipos=array("Publica","Privada","Total");
	foreach($tipos as $tipo) {
		foreach($ccaas as $ccaa) {
			$matrix[$ccaa][$tipo]=0;
		}
	}
	$header=array_keys(reset($matrix));
	foreach($resi as $key=>$val) {
		if(isset($matrix[$val[0]][$val[1]])) $matrix[$val[0]][$val[1]]+=$val[3];
	}
	$matrix["18 Ceuta + 19 Melilla"]=array(
		$matrix["18 Ceuta"]["Publica"]+$matrix["19 Melilla"]["Publica"],
		$matrix["18 Ceuta"]["Privada"]+$matrix["19 Melilla"]["Privada"],
		$matrix["18 Ceuta"]["Total"]+$matrix["19 Melilla"]["Total"],
	);
	unset($matrix["18 Ceuta"]);
	unset($matrix["19 Melilla"]);
	$ccaas=array(
		"03 Asturias, Principado de"=>"03 Principado\\nAsturias",
		"04 Balears, Illes"=>"04 Illes\\nBalears",
		"07 Castilla y León"=>"07 Castilla\\ny León",
		"08 Castilla - La Mancha"=>"08 Castilla\\nLa Mancha",
		"10 Comunitat Valenciana"=>"10 Comunitat\\nValenciana",
		"13 Madrid, Comunidad de"=>"13 Comunidad\\nde Madrid",
		"14 Murcia, Región de"=>"14 Región\\nde Murcia",
		"15 Navarra, Comunidad Foral de"=>"15 Comunidad\\nForal de Navarra",
		"18 Ceuta + 19 Melilla"=>"18 Ceuta\\n19 Melilla",
	);
	foreach($matrix as $key=>$val) {
		$ccaa=isset($ccaas[$key])?$ccaas[$key]:$key;
		$matrix[$key]=array_merge(array($ccaa),$val);
	}
	foreach($header as $key=>$val) {
		$header[$key]=$textos["tipos"][$lang][$val];
	}
	array_unshift($matrix,array_merge(array("CCAA"),$header));
	export_file("middle/plot06${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',10'",
		"set title \"".$textos["plots"]["06"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 7",
		"set lmargin 6",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45",
		"set style histogram gap 3",
		"set yrange [0:70000]",
		"set ytic center rotate by 90",
		"set ytics 0,10000,60000",
		"set datafile separator ';'",
		"set output 'output/plot06${lang}.png'",
		"plot 'middle/plot06${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot06${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot06${lang}.gnu 2>&1");
	unset($temp);
	unset($ccaas);
	unset($resi);
	unset($matrix);
	unset($tipos);
	unset($header);
	unset($gnuplot);
	console_debug();
}

?>