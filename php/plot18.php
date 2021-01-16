<?php

if(!file_exists("output/plot18${lang}01.png")) {
	console_debug("output/plot18${lang}01.png");
	$temp=import_file("input/oecd/code2country.csv");
	$countries=array();
	foreach($temp as $key=>$val) {
		$countries[$val[1]]=$val[0];
	}
	$europe=import_file("middle/demo_r_mwk_ts.csv");
	foreach($europe as $key=>$val) {
		if($key==0) {
			foreach($val as $key2=>$val2) {
				if($key2==0) {
					$val2="";
					$val[$key2]=$val2;
				} else {
					$val2=trim($val2);
					$val2=str_replace("W","-",$val2);
					$val[$key2]=$val2;
				}
			}
			$europe[$key]=$val;
		} elseif(substr($val[0],0,5)=="T,NR,") {
			foreach($val as $key2=>$val2) {
				if($key2==0) {
					$val2=substr($val2,5);
					$val[$key2]=$val2;
				} else {
					$val2=trim($val2);
					if($val2==":") $val2="";
					if(substr($val2,-2,2)==" p") $val2=substr($val2,0,-2);
					if(substr($val2,-2,2)==" e") $val2=substr($val2,0,-2);
					$val[$key2]=$val2;
				}
			}
			$europe[$key]=$val;
		} else {
			unset($europe[$key]);
		}
	}
	$paises=array();
	foreach($europe as $key=>$val) {
		if($key==0) continue;
		$paises[$val[0]]=$val[0];
		if(isset($countries[$val[0]])) $paises[$val[0]]=$countries[$val[0]];
	}
	asort($paises);
	$años=array();
	$semanas=array();
	foreach($europe[0] as $key=>$val) {
		if($key==0) continue;
		$temp=explode("-",$val);
		$años[$temp[0]]=$temp[0];
		$semanas[$temp[1]]=$temp[1];
	}
	for($i=2000;$i<2015;$i++) unset($años[$i]);
	unset($semanas[99]);
	ksort($años);
	ksort($semanas);
	$eje_y=array();
	foreach($europe as $key=>$val) {
		if($key==0) continue;
		foreach($val as $key2=>$val2) {
			if($key2==0) continue;
			$temp=explode("-",$europe[0][$key2]);
			if(!isset($eje_y[$val[0]])) $eje_y[$val[0]]=0;
			$eje_y[$val[0]]=max($eje_y[$val[0]],$val2);
		}
	}
	foreach($eje_y as $key=>$val) {
		$size=floor(log($val,10));
		$num1=10**$size*ceil($val*1.1/10**$size)/5;
		$num2=$num1*4;
		$num3=$num1*5;
		$eje_y[$key]=array($num1,$num2,$num3);
	}
	$matrix=array();
	foreach($semanas as $semana) {
		foreach($paises as $pais=>$nada) {
			foreach($años as $año) {
				$matrix[$semana][$pais."-".$año]="";
			}
		}
	}
	$header=array_keys(reset($matrix));
	foreach($europe as $key=>$val) {
		if($key==0) continue;
		foreach($val as $key2=>$val2) {
			if($key2==0) continue;
			$temp=explode("-",$europe[0][$key2]);
			if(!isset($matrix[$temp[1]][$val[0]."-".$temp[0]])) continue;
			$matrix[$temp[1]][$val[0]."-".$temp[0]]=$val2;
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
	foreach($header as $key=>$val) {
		$val=explode("-",$val);
		if(isset($countries[$val[0]])) $val[0]=$countries[$val[0]];
		$val=implode("-",$val);
		$header[$key]=$val;
	}
	array_unshift($matrix,array_merge(array("Fecha"),$header));
	export_file("middle/plot18${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal png size 1200,600 enhanced font ',11'",
		"set title \"".$textos["plots"]["18"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set datafile separator ';'",
		"set colors classic",
	))."\n";
	$paises=array_keys($paises);
	for($i=0;$i<count($paises);$i++) {
		$j=sprintf("%02d",$i+1);
		$plot=array();
		for($k=0;$k<count($años);$k++) {
			$plot[]="u 1:".($i*count($años)+2+$k)." w lp ti col";
		}
		$plot=implode(",'' ",$plot);
		list($num1,$num2,$num3)=$eje_y[$paises[$i]];
		$gnuplot.=implode("\n",array(
			"set yrange [0:$num3]",
			"set ytics 0,$num1,$num2",
			"set output 'output/plot18${lang}${j}.png'",
			"plot 'middle/plot18${lang}.csv' ${plot}",
		))."\n";
	}
	$gnuplot.="\n";
	file_put_contents("middle/plot18${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot18${lang}.gnu 2>&1");
	unset($temp);
	unset($countries);
	unset($europe);
	unset($paises);
	unset($años);
	unset($semanas);
	unset($eje_y);
	unset($matrix);
	unset($header);
	unset($gnuplot);
	console_debug();
}

?>