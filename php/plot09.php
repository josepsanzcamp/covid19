<?php

if(!file_exists("output/plot09${lang}01.gif")) {
	console_debug("output/plot09${lang}01.gif");
	$files=glob("middle/component.????????.csv");
	sort($files);
	$paises=array();
	foreach($files as $file) {
		$data=import_file($file);
		foreach($data as $key=>$val) {
			if($val[0]=="countries" && $val[2]=="Total" && $val[3]=="zscore") {
				$paises[$val[1]]=$val[1];
			}
		}
	}
	ksort($paises);
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("output/plot09${lang}01.${part}.png")) continue;
		$data=import_file($file);
		$años=array();
		$semanas=array();
		foreach($data as $key=>$val) {
			if($val[0]=="countries" && $val[2]=="Total" && $val[3]=="zscore") {
				$temp=explode("-",$val[4]);
				$años[$temp[0]]=$temp[0];
				$semanas[$temp[1]]=$temp[1];
			}
		}
		$matrix=array();
		foreach($semanas as $semana) {
			foreach($paises as $pais) {
				foreach($años as $año) {
					$matrix[$semana][$pais."-".$año]="";
				}
			}
		}
		$header=array_keys(reset($matrix));
		foreach($data as $key=>$val) {
			if($val[0]=="countries" && $val[2]=="Total" && $val[3]=="zscore") {
				$temp=explode("-",$val[4]);
				if(!isset($matrix[$temp[1]][$val[1]."-".$temp[0]])) die("ERROR 10");
				$matrix[$temp[1]][$val[1]."-".$temp[0]]=$val[5];
			}
		}
		foreach($matrix as $key=>$val) {
			$key2=date("Y-m-d",strtotime("2020W".$key)+86400*2);
			$matrix[$key]=array_merge(array($key2),$val);
		}
		foreach($header as $key=>$val) {
			if(implode("",array_column($matrix,$val))=="") {
				foreach($matrix as $key2=>$val2) {
					$matrix[$key2][$val]=-100; // TRICK
				}
			}
		}
		array_unshift($matrix,array_merge(array("Fecha"),$header));
		export_file("middle/plot09${lang}.${part}.csv",$matrix);
		$fecha=substr($part,0,4)."-".substr($part,4,2)."-".substr($part,6,2);
		$gnuplot=implode("\n",array(
			"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
			"set title \"".$textos["plots"]["09"][$lang]." (${fecha})\"",
			"set grid",
			"set tmargin 3",
			"set rmargin 6",
			"set bmargin 3",
			"set lmargin 6",
			"set auto x",
			"set yrange [-10:50]",
			"set xdata time",
			"set timefmt '%Y-%m-%d'",
			"set format x '%Y-%m-%d'",
			"set xrange ['2020-01-01':'2021-01-01']",
			"set xtics '2020-02-01',86400*30,'2020-12-01'",
			"set ytic center rotate by 90",
			"set ytics 0,10,40",
			"set datafile separator ';'",
		))."\n";
		for($i=0;$i<count($paises);$i++) {
			$col2=$i*count($años)+2;
			$col3=$i*count($años)+3;
			$col4=$i*count($años)+4;
			$col5=$i*count($años)+5;
			$col6=$i*count($años)+6;
			$col7=$i*count($años)+7;
			$j=sprintf("%02d",$i+1);
			$gnuplot.=implode("\n",array(
				"set output 'output/plot09${lang}${j}.${part}.png'",
				"plot 'middle/plot09${lang}.${part}.csv' u 1:${col2} w lp ti col,'' u 1:${col3} w lp ti col,'' u 1:${col4} w lp ti col,'' u 1:${col5} w lp ti col,'' u 1:${col6} w lp ti col,'' u 1:${col7} w lp lc 7 ti col",
			))."\n";
		}
		$gnuplot.="\n";
		file_put_contents("middle/plot09${lang}.${part}.gnu",$gnuplot);
		passthru("gnuplot middle/plot09${lang}.${part}.gnu 2>&1");
	}
	for($i=0;$i<count(glob("output/plot09${lang}??.${part}.png"));$i++) {
		$j=sprintf("%02d",$i+1);
		passthru("convert -delay 50 output/plot09${lang}${j}.????????.png output/plot09${lang}${j}.gif 1>/dev/null 2>/dev/null");
	}
	unset($paises);
	unset($data);
	unset($años);
	unset($semanas);
	unset($matrix);
	unset($headder);
	unset($gnuplot);
	console_debug();
}

?>