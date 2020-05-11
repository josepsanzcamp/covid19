<?php

ini_set("memory_limit","1024M");
ini_set("max_execution_time","3600");

function import_file($file) {
	$data=file_get_contents($file,null,null,0,1000);
	$data=explode("\n",$data);
	$sep="";
	if($sep=="" && strpos($data[0],";")!==false) $sep=";";
	if($sep=="" && strpos($data[0],",")!==false) $sep=",";
	$fd=fopen($file,"r");
	$data=array();
	while($row=fgetcsv($fd,0,$sep)) $data[]=$row;
	fclose($fd);
	return $data;
}

function export_file($file,$data) {
	foreach($data as $key=>$val) {
		$data[$key]=implode(";",$val);
	}
	$data=implode("\n",$data)."\n";
	file_put_contents($file,$data);
}

if(!file_exists("02001-ok.csv")) {
	$data=import_file("02001.csv");
	$meses=array(
		"Enero"=>"01",
		"Febrero"=>"02",
		"Marzo"=>"03",
		"Abril"=>"04",
		"Mayo"=>"05",
		"Junio"=>"06",
		"Julio"=>"07",
		"Agosto"=>"08",
		"Septiembre"=>"09",
		"Octubre"=>"10",
		"Noviembre"=>"11",
		"Diciembre"=>"12",
	);
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[1]=="Total" && $val[2]=="Total") {
			$key2=$val[3]."-".$meses[$val[0]];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
		}
		unset($data[$key]);
	}
	sort($sumas);
	export_file("02001-ok.csv",$sumas);
}

if(!file_exists("02001-ok2.csv")) {
	$data=import_file("02001.csv");
	$meses=array(
		"Enero"=>"01",
		"Febrero"=>"02",
		"Marzo"=>"03",
		"Abril"=>"04",
		"Mayo"=>"05",
		"Junio"=>"06",
		"Julio"=>"07",
		"Agosto"=>"08",
		"Septiembre"=>"09",
		"Octubre"=>"10",
		"Noviembre"=>"11",
		"Diciembre"=>"12",
	);
	$edades=array(
		"De 0 a 64 años"=>1,
		"De 65 a 69 años"=>2,
		"De 70 a 74 años"=>2,
		"De  75 a 79 años"=>3,
		"De 80 a 84 años"=>3,
		"De 85 a 89 años"=>3,
		"De 90 a 94 años"=>3,
		"De  95 y más años"=>3,
		"No consta"=>1,
	);
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[1]=="Total" && $val[2]!="Total") {
			$key2=$val[3]."-".$meses[$val[0]].";".$edades[$val[2]];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			if($val[4]=="..") $val[4]="0";
			$sumas[$key2][1]+=str_replace(".","",str_replace(".","",$val[4]));
		}
		unset($data[$key]);
	}
	sort($sumas);
	$edades=array(3=>"mas_74",2=>"65_74",1=>"menos_65");
	foreach($sumas as $key=>$val) {
		$temp=explode(";",$val[0]);
		$temp[1]=$edades[$temp[1]];
		$val[0]=implode(";",$temp);
		$sumas[$key]=$val;
	}
	export_file("02001-ok2.csv",$sumas);
}

if(!file_exists("14819-ok.csv")) {
	$data=import_file("14819.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(strtok($val[0]," ")=="001-102" && $val[1]=="Total") {
			$key2=str_replace("M","-",$val[2]);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("14819-ok.csv",$sumas);
}

if(!file_exists("6545-ok.csv")) {
	$data=import_file("6545.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total" && $val[1]=="Total") {
			$key2=$val[2];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("6545-ok.csv",$sumas);
}

if(!file_exists("6548-ok.csv")) {
	$data=import_file("6548.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total" && $val[1]=="Total") {
			$key2=$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
		}
		unset($data[$key]);
	}
	export_file("6548-ok.csv",$sumas);
}

if(!file_exists("6561-ok.csv")) {
	$data=import_file("6561.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total") {
			$key2=str_replace("M","-",$val[1]);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[2]);
		}
		unset($data[$key]);
	}
	export_file("6561-ok.csv",$sumas);
}

if(!file_exists("6562-ok.csv")) {
	$data=import_file("6562.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[2]!="Total") {
			$key2=substr($val[1],0,4);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[2]);
		}
		unset($data[$key]);
	}
	export_file("6562-ok.csv",$sumas);
}

if(!file_exists("6562-ok2.csv")) {
	$data=import_file("6562.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[2]!="Total") {
			$key2=str_replace("M","-",substr($val[1],0,7)).";".$val[0];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[2]);
		}
		unset($data[$key]);
	}
	export_file("6562-ok2.csv",$sumas);
}

if(!file_exists("6566-ok.csv")) {
	$data=import_file("6566.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(stripos($val[0],"defunci")!==false && stripos($val[1],"defunción")!==false) {
			$key2=$val[2];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("6566-ok.csv",$sumas);
}

if(!file_exists("6580-ok.csv")) {
	$data=import_file("6580.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(stripos($val[0],"defunci")!==false && stripos($val[1],"defunción")!==false) {
			$key2=$val[2];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("6580-ok.csv",$sumas);
}

if(!file_exists("7947-ok.csv")) {
	$data=import_file("7947.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(strtok($val[0]," ")=="001-102" && $val[1]=="Total" && $val[2]=="Todas las edades") {
			$key2=$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
		}
		unset($data[$key]);
	}
	export_file("7947-ok.csv",$sumas);
}

if(!file_exists("data-ok.csv")) {
	$data=import_file("data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("data-ok.csv",$sumas);
}

if(!file_exists("data-ok2.csv")) {
	$data=import_file("data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("data-ok2.csv",$sumas);
}

if(!file_exists("data-ok3.csv")) {
	$data=import_file("data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("data-ok3.csv",$sumas);
}

if(!file_exists("data-ok4.csv")) {
	$data=import_file("data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=$val[8].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("data-ok4.csv",$sumas);
}

if(!file_exists("data-ok5.csv")) {
	$data=import_file("data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("data-ok5.csv",$sumas);
}

if(!file_exists("plot1.png")) {
	$momo=import_file("data-ok.csv");
	$ine1=import_file("02001-ok.csv");
	$ine2=import_file("14819-ok.csv");
	$matrix=array();
	$years=array(2020,2019,2018,2017,2015,2014,2012,2009,2005,2000,1999);
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($years as $year) {
		foreach($months as $month) {
			$month=sprintf("%02d",$month);
			$matrix[$month][$year]="";
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momo as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	foreach($ine1 as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	foreach($ine2 as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	$meses=array(
		"01"=>"Enero",
		"02"=>"Febrero",
		"03"=>"Marzo",
		"04"=>"Abril",
		"05"=>"Mayo",
		"06"=>"Junio",
		"07"=>"Julio",
		"08"=>"Agosto",
		"09"=>"Septiembre",
		"10"=>"Octubre",
		"11"=>"Noviembre",
		"12"=>"Diciembre",
	);
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array_merge(array($meses[$key]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("plot1.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'plot1.png'",
		"set multiplot layout 2,1 title 'Defunciones por año y mes (sólo años donde algun mes ha superado los 40k muertos, los datos del 2020 son de MoMo y el resto son del INE)'",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set style histogram gap 3",
		"set datafile separator ';'",
		"plot [-0.5:5.5] 'plot1.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"plot [5.5:11.5] 'plot1.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"unset multiplot",
	))."\n";
	file_put_contents("plot1.gnu",$gnuplot);
	exec("gnuplot plot1.gnu");
}

if(!file_exists("plot2.png")) {
	$momo=import_file("data-ok.csv");
	$ine=import_file("02001-ok.csv");
	$matrix=array();
	$years=array(2018,2019,2020);
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($years as $year) {
		foreach($months as $month) {
			$month=sprintf("%02d",$month);
			$matrix[$year."-".$month]["MoMo"]="";
			$matrix[$year."-".$month]["INE"]="";
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momo as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["MoMo"])) $matrix[$year."-".$month]["MoMo"]=$val[1];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["INE"])) $matrix[$year."-".$month]["INE"]=$val[1];
	}
	$meses=array(
		"01"=>"Enero",
		"02"=>"Febrero",
		"03"=>"Marzo",
		"04"=>"Abril",
		"05"=>"Mayo",
		"06"=>"Junio",
		"07"=>"Julio",
		"08"=>"Agosto",
		"09"=>"Septiembre",
		"10"=>"Octubre",
		"11"=>"Noviembre",
		"12"=>"Diciembre",
	);
	foreach($matrix as $key=>$val) {
		$temp=explode("-",$key);
		$matrix[$key]=array_merge(array($meses[$temp[1]]." ".$temp[0]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("plot2.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'plot2.png'",
		"set multiplot layout 2,1 title 'Defunciones por año y mes de MoMo y INE entre 2018 y 2020'",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot [-0.5:14.5] 'plot2.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col",
		"plot [14.5:29.5] 'plot2.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col",
		"unset multiplot",
	))."\n";
	file_put_contents("plot2.gnu",$gnuplot);
	exec("gnuplot plot2.gnu");
}

if(!file_exists("plot3.png")) {
	$momo=import_file("data-ok2.csv");
	foreach($momo as $key=>$val) {
		list($year,$month,$day)=explode("-",$val[0]);
		if($year==2020) {
			// NOTHING TO DO
		} else {
			unset($momo[$key]);
		}
	}
	export_file("plot3.csv",$momo);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'plot3.png'",
		"set multiplot layout 3,1 title 'Defunciones por dia obtenidos de MoMo para el 2020'",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:3000]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2020-07-01']",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set xtics '2020-01-01',86400*7,'2020-07-01'",
		"plot ['2020-01-01':'2020-03-01'] 'plot3.csv' using 1:2 w l ti ''",
		"plot ['2020-03-01':'2020-05-01'] 'plot3.csv' using 1:2 w l ti ''",
		"plot ['2020-05-01':'2020-07-01'] 'plot3.csv' using 1:2 w l ti ''",
		"unset multiplot"
	))."\n";
	file_put_contents("plot3.gnu",$gnuplot);
	exec("gnuplot plot3.gnu");
}

if(!file_exists("plot4.png")) {
	$momo=import_file("data-ok3.csv");
	$ine=import_file("02001-ok2.csv");
	$matrix=array();
	$years=array(2020,2019,2018);
	$edades=array("mas_74","65_74","menos_65");
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($edades as $edad) {
		foreach($years as $year) {
			foreach($months as $month) {
				$month=sprintf("%02d",$month);
				$matrix[$month][$edad."-".$year]="";
			}
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momo as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$edad=$val[1];
		if(isset($matrix[$month][$edad."-".$year])) $matrix[$month][$edad."-".$year]=$val[2];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		$edad=$val[1];
		if(isset($matrix[$month][$edad."-".$year])) $matrix[$month][$edad."-".$year]=$val[2];
	}
	$meses=array(
		"01"=>"Enero",
		"02"=>"Febrero",
		"03"=>"Marzo",
		"04"=>"Abril",
		"05"=>"Mayo",
		"06"=>"Junio",
		"07"=>"Julio",
		"08"=>"Agosto",
		"09"=>"Septiembre",
		"10"=>"Octubre",
		"11"=>"Noviembre",
		"12"=>"Diciembre",
	);
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array_merge(array($meses[$key]),$val);
	}
	$edades=array(
		"menos_65"=>"Menos de 65 años",
		"65_74"=>"Entre 65 y 74 años",
		"mas_74"=>"Más de 74 años",
	);
	foreach($header as $key=>$val) {
		$val=explode("-",$val);
		$val[0]=$edades[$val[0]];
		$val=implode(" ",$val);
		$header[$key]=$val;
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("plot4.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'plot4.png'",
		"set multiplot layout 2,1 title 'Defunciones por año, mes y edad (los datos del 2020 son de MoMo y el resto son del INE)'",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot [-0.5:5.5] 'plot4.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col",
		"plot [5.5:11.5] 'plot4.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("plot4.gnu",$gnuplot);
	exec("gnuplot plot4.gnu");
}

if(!file_exists("plot5.png")) {
	$momo=import_file("data-ok5.csv");
	$ine=import_file("6562-ok2.csv");
	$matrix=array();
	$years=array(2020,2018,2017,2015,2014,2012,2009,2005,2000,1999);
	$ccaas=array(
		"01 Andalucía",
		"02 Aragón",
		"03 Asturias, Principado de",
		"04 Balears, Illes",
		"05 Canarias",
		"06 Cantabria",
		"07 Castilla y León",
		"08 Castilla - La Mancha",
		"09 Cataluña",
		"10 Comunitat Valenciana",
		"11 Extremadura",
		"12 Galicia",
		"13 Madrid, Comunidad de",
		"14 Murcia, Región de",
		"15 Navarra, Comunidad Foral de",
		"16 País Vasco",
		"17 Rioja, La",
		"18 Ceuta",
		"19 Melilla",
	);
	foreach($years as $year) {
		foreach($ccaas as $ccaa) {
			$matrix[$ccaa][$year]=0;
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momo as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if($year!=2020) continue;
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	$ccaas=array(
		"03 Asturias, Principado de"=>"03 Principado\\nAsturias",
		"04 Balears, Illes"=>"04 Illes\\nBalears",
		"07 Castilla y León"=>"07 Castilla\\ny León",
		"08 Castilla - La Mancha"=>"08 Castilla\\nLa Mancha",
		"10 Comunitat Valenciana"=>"10 Comunitat\\nValenciana",
		"13 Madrid, Comunidad de"=>"13 Comunidad\\nde Madrid",
		"14 Murcia, Región de"=>"14 Región de\\nMurcia",
		"15 Navarra, Comunidad Foral de"=>"15 Comunidad\\nForal de\\nNavarra",
	);
	foreach($matrix as $key=>$val) {
		$ccaa=isset($ccaas[$key])?$ccaas[$key]:$key;
		$matrix[$key]=array_merge(array($ccaa),$val);
	}
	array_unshift($matrix,array_merge(array("Año"),$header));
	export_file("plot5.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'plot5.png'",
		"set multiplot layout 2,1 title 'Defunciones por comunidad autónoma y año (acumulados por año de marzo y abril, los datos del 2020 son de MoMo y el resto son del INE)'",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:30000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot [-0.5:9.5] 'plot5.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col",
		"plot [9.5:19.5] 'plot5.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("plot5.gnu",$gnuplot);
	exec("gnuplot plot5.gnu");
}

?>