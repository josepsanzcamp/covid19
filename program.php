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

if(!file_exists("middle/02001-ok.csv")) {
	$data=import_file("input/ine/02001.csv");
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
	export_file("middle/02001-ok.csv",$sumas);
}

if(!file_exists("middle/02001-ok2.csv")) {
	$data=import_file("input/ine/02001.csv");
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
	export_file("middle/02001-ok2.csv",$sumas);
}

if(!file_exists("middle/14819-ok.csv")) {
	$data=import_file("input/ine/14819.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(strtok($val[0]," ")=="001-102" && $val[1]=="Total") {
			$key2=str_replace("M","-",$val[2]);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/14819-ok.csv",$sumas);
}

if(!file_exists("middle/6545-ok.csv")) {
	$data=import_file("input/ine/6545.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total" && $val[1]=="Total") {
			$key2=$val[2];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/6545-ok.csv",$sumas);
}

if(!file_exists("middle/6548-ok.csv")) {
	$data=import_file("input/ine/6548.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total" && $val[1]=="Total") {
			$key2=$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
		}
		unset($data[$key]);
	}
	export_file("middle/6548-ok.csv",$sumas);
}

if(!file_exists("middle/6561-ok.csv")) {
	$data=import_file("input/ine/6561.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total") {
			$key2=str_replace("M","-",$val[1]);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[2]);
		}
		unset($data[$key]);
	}
	export_file("middle/6561-ok.csv",$sumas);
}

if(!file_exists("middle/6562-ok.csv")) {
	$data=import_file("input/ine/6562.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[2]!="Total") {
			$key2=substr($val[1],0,4);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[2]);
		}
		unset($data[$key]);
	}
	export_file("middle/6562-ok.csv",$sumas);
}

if(!file_exists("middle/6562-ok2.csv")) {
	$data=import_file("input/ine/6562.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[2]!="Total") {
			$key2=str_replace("M","-",substr($val[1],0,7)).";".$val[0];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[2]);
		}
		unset($data[$key]);
	}
	export_file("middle/6562-ok2.csv",$sumas);
}

if(!file_exists("middle/6566-ok.csv")) {
	$data=import_file("input/ine/6566.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(stripos($val[0],"defunci")!==false && stripos($val[1],"defunción")!==false) {
			$key2=$val[2];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/6566-ok.csv",$sumas);
}

if(!file_exists("middle/6580-ok.csv")) {
	$data=import_file("input/ine/6580.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(stripos($val[0],"defunci")!==false && stripos($val[1],"defunción")!==false) {
			$key2=$val[2];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/6580-ok.csv",$sumas);
}

if(!file_exists("middle/7947-ok.csv")) {
	$data=import_file("input/ine/7947.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if(strtok($val[0]," ")=="001-102" && $val[1]=="Total" && $val[2]=="Todas las edades") {
			$key2=$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
		}
		unset($data[$key]);
	}
	export_file("middle/7947-ok.csv",$sumas);
}

if(!file_exists("middle/data.csv")) {
	$files=glob("input/momo/data.????????.csv");
	sort($files);
	$result=array();
	foreach($files as $file) {
		$data=import_file($file);
		foreach($data as $key=>$val) {
			$key2=implode("|",array_slice($val,0,8));
			$key3=$val[8];
			$result[$key2][$key3]=array_slice($val,0,10);
			unset($data[$key]);
		}
	}
	$result2=array();
	foreach($result as $key=>$val) {
		$result2=array_merge($result2,array_values($val));
		unset($result[$key]);
	}
	export_file("middle/data.csv",$result2);
}

if(!file_exists("middle/data-ok.csv")) {
	$data=import_file("middle/data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/data-ok.csv",$sumas);
}

if(!file_exists("middle/data-ok2.csv")) {
	$data=import_file("middle/data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/data-ok2.csv",$sumas);
}

if(!file_exists("middle/data-ok3.csv")) {
	$data=import_file("middle/data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/data-ok3.csv",$sumas);
}

if(!file_exists("middle/data-ok4.csv")) {
	$data=import_file("middle/data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=$val[8].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/data-ok4.csv",$sumas);
}

if(!file_exists("middle/data-ok5.csv")) {
	$data=import_file("middle/data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/data-ok5.csv",$sumas);
}

if(!file_exists("middle/data-ok6.csv")) {
	$data=import_file("middle/data.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/data-ok6.csv",$sumas);
}

if(!file_exists("middle/residencias.csv")) {
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[2]]=$val[0]." ".$val[1];
	}
	$files=glob("input/csic/19_*.csv");
	$sumas=array();
	foreach($files as $file) {
		$data=import_file($file);
		foreach($data as $key=>$val) {
			if($val[4]!="" && $val[7]!="" && $val[8]!="" && $val[8]!="Plazas") {
				$publica=0;
				$privada=0;
				if(stripos($val[7],"pública")!==false) $publica=1;
				if(stripos($val[7],"privada")!==false) $privada=1;
				if($publica+$privada!=1) die("ERROR 1");
				$tipo="";
				if($publica) $tipo="Publica";
				if($privada) $tipo="Privada";
				$ccaa=$ccaas[substr($val[4],0,2)];
				$key2=$ccaa.";Total";
				if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0,0);
				$sumas[$key2][1]++;
				$sumas[$key2][2]+=str_replace(".","",$val[8]);
				$key2=$ccaa.";".$tipo;
				if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0,0);
				$sumas[$key2][1]++;
				$sumas[$key2][2]+=str_replace(".","",$val[8]);
			}
 			unset($data[$key]);
		}
	}
	array_unshift($sumas,array("CCAA","Tipo","Count","Plazas"));
	export_file("middle/residencias.csv",$sumas);
}

if(!file_exists("middle/02002-ok.csv")) {
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[mb_strtoupper($val[1])]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/02002.csv");
	$edades=array(
		"0-4 años"=>1,
		"5-9 años"=>1,
		"10-14 años"=>1,
		"15-19 años"=>1,
		"20-24 años"=>1,
		"25-29 años"=>1,
		"30-34 años"=>1,
		"35-39 años"=>1,
		"40-44 años"=>1,
		"45-49 años"=>1,
		"50-54 años"=>1,
		"55-59 años"=>1,
		"60-64 años"=>1,
		"65-69 años"=>2,
		"70-74 años"=>2,
		"75-79 años"=>3,
		"80-84 años"=>3,
		"85-89 años"=>3,
		"90-94 años"=>3,
		"95-99 años"=>3,
		"100 años y más"=>3,
	);
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="TOTAL ESPAÑA" && $val[1]!="TOTAL EDADES" && $val[2]=="TOTAL" && $val[3]=="Ambos sexos") {
			$key2=$val[4].";".$ccaas[$val[0]].";".$edades[$val[1]];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",str_replace(".","",$val[5]));
		}
		unset($data[$key]);
	}
	$edades=array(3=>"mas_74",2=>"65_74",1=>"menos_65");
	foreach($sumas as $key=>$val) {
		$temp=explode(";",$val[0]);
		$temp[2]=$edades[$temp[2]];
		$val[0]=implode(";",$temp);
		$sumas[$key]=$val;
	}
	export_file("middle/02002-ok.csv",$sumas);
}

if(!file_exists("middle/6548-ok2.csv")) {
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[0]." ".$val[1]]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/6548.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total" && $val[0]!="Extranjero" && $val[1]=="Total") {
			$edad=intval($val[2]);
			if($edad<65) $edad="menos_65";
			elseif($edad>74) $edad="mas_74";
			else $edad="65_74";
			$key2=$ccaas[$val[0]].";".$edad.";".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			if($val[4]=="") $val[4]=0;
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
		}
		unset($data[$key]);
	}
	export_file("middle/6548-ok2.csv",$sumas);
}

if(!file_exists("middle/02005-ok.csv")) {
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[mb_strtoupper($val[1])]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/02005.csv");
	$edades=array(
		"0-4"=>1,
		"5-9"=>1,
		"10-14"=>1,
		"15-19"=>1,
		"20-24"=>1,
		"25-29"=>1,
		"30-34"=>1,
		"35-39"=>1,
		"40-44"=>1,
		"45-49"=>1,
		"50-54"=>1,
		"55-59"=>1,
		"60-64"=>1,
		"65-69"=>2,
		"70-74"=>2,
		"75-79"=>3,
		"80-84"=>3,
		"85-89"=>3,
		"90-94"=>3,
		"95-99"=>3,
		"100 y más"=>3,
	);
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Ambos sexos" && $val[1]!="Total" && $val[2]=="Residencias de personas mayores") {
			$key2=$edades[$val[1]];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			if($val[3]=="..") $val[3]=0;
			$sumas[$key2][1]+=str_replace(".","",str_replace(".","",$val[3]));
		}
		unset($data[$key]);
	}
	$edades=array(3=>"mas_74",2=>"65_74",1=>"menos_65");
	foreach($sumas as $key=>$val) {
		$val[0]=$edades[$val[0]];
		$sumas[$key]=$val;
	}
	export_file("middle/02005-ok.csv",$sumas);
}

if(!file_exists("middle/fake.csv")) {
	$files=glob("input/momo/data.????????.csv");
	sort($files);
	$result=array();
	foreach($files as $file) {
		$data=import_file($file);
		$temp=explode(".",$file);
		$temp=$temp[1];
		foreach($data as $key=>$val) {
			$key2=implode("|",array_slice($val,0,8));
			$key3=$val[8];
			if($temp>=20200527 && in_array(substr($key3,0,7),array("2020-03","2020-04"))) continue;
			$result[$key2][$key3]=array_slice($val,0,10);
			unset($data[$key]);
		}
	}
	$result2=array();
	foreach($result as $key=>$val) {
		$result2=array_merge($result2,array_values($val));
		unset($result[$key]);
	}
	export_file("middle/fake.csv",$result2);
}

if(!file_exists("middle/fake-ok.csv")) {
	$data=import_file("middle/fake.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/fake-ok.csv",$sumas);
}

if(!file_exists("middle/fake-ok2.csv")) {
	$data=import_file("middle/fake.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/fake-ok2.csv",$sumas);
}

if(!file_exists("middle/fake-ok3.csv")) {
	$data=import_file("middle/fake.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/fake-ok3.csv",$sumas);
}

if(!file_exists("middle/fake-ok5.csv")) {
	$data=import_file("middle/fake.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/fake-ok5.csv",$sumas);
}

$textos=array(
	"header"=>array(
		"ca"=>"Informació útil d'Espanya sobre l'impacte de covid-19: gràfics de defuncions per any, origen de les dades, acumulats diaris, per edat, per comunitat autònoma i més",
		"es"=>"Información útil de España sobre el impacto de covid-19: gráficos de defunciones por año, origen de los datos, acumulados diarios, por edad, por comunidad autónoma y más",
		"en"=>"Useful Spain information about the covid-19 impact: Graphs of deaths by year, origin of the data, daily accumulated, by age, by autonomous community, and more",
	),
	"plots"=>array(
		1=>array(
			"ca"=>"Defuncions per any i mes (només anys on algun mes ha superat els 40k morts, les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"Defunciones por año y mes (sólo años donde algún mes ha superado los 40k muertos, los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"Deaths by year and month (only years where some month has exceeded 40k deaths, 2020 data are from the MoMo and the rest are from the INE)",
		),array(
			"ca"=>"Defuncions per any i mes del MoMo i INE entre 2018 i 2020",
			"es"=>"Defunciones por año y mes del MoMo y INE entre 2018 y 2020",
			"en"=>"Deaths by year and month of the MoMo and INE between 2018 and 2020",
		),array(
			"ca"=>"Defuncions per dia obtinguts del MoMo per al 2020",
			"es"=>"Defunciones por dia obtenidos del MoMo para el 2020",
			"en"=>"Deaths per day obtained from the MoMo by 2020",
		),array(
			"ca"=>"Defuncions per any, mes i edat (les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"Defunciones por año, mes y edad (los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"Deaths by year, month and age (2020 data are from MoMo and the rest are from INE)",
		),array(
			"ca"=>"Defuncions per comunitat autònoma i any (acumulats per any de març i abril, les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"Defunciones por comunidad autónoma y año (acumulados por año de marzo y abril, los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"Deaths by autonomous community and year (accumulated by year of March and April, the data for 2020 are from the MoMo and the rest are from the INE)",
		),array(
			"ca"=>"Places de residències per tipus i comunitat autònoma (dades obtingudes de envejecimientoenred.es, del CSIC del 2019)",
			"es"=>"Plazas de residencias por tipo y comunidad autónoma (datos obtenidos de envejecimientoenred.es, del CSIC del 2019)",
			"en"=>"Places of residences by type and autonomous community (data obtained from envejecimientoenred.es, from the CSIC of 2019)",
		),array(
			"ca"=>"Relació de llits de hospital i infermeres per país en 2016 segons dades OECD",
			"es"=>"Relación de camas de hospital y enfermeras por país en 2016 segun datos OECD",
			"en"=>"Relation of hospital beds and nurses by country in 2016 according to OECD data",
		),
	),
	"footer"=>array(
		"ca"=>"Més info / fonts",
		"es"=>"Más info / fuentes",
		"en"=>"More info / sources",
	),
	"meses"=>array(
		"ca"=>array(
			"01"=>"Gener",
			"02"=>"Febrer",
			"03"=>"Març",
			"04"=>"Abril",
			"05"=>"Maig",
			"06"=>"Juny",
			"07"=>"Juliol",
			"08"=>"Agost",
			"09"=>"Setembre",
			"10"=>"Octubre",
			"11"=>"Novembre",
			"12"=>"Desembre",
		),
		"es"=>array(
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
		),
		"en"=>array(
			"01"=>"January",
			"02"=>"February",
			"03"=>"March",
			"04"=>"April",
			"05"=>"May",
			"06"=>"June",
			"07"=>"July",
			"08"=>"August",
			"09"=>"September",
			"10"=>"October",
			"11"=>"November",
			"12"=>"December",
		),
	),
	"edades"=>array(
		"ca"=>array(
			"menos_65"=>"Menys de 65 anys",
			"65_74"=>"Entre 65 i 74 anys",
			"mas_74"=>"Més de 74 anys",
		),
		"es"=>array(
			"menos_65"=>"Menos de 65 años",
			"65_74"=>"Entre 65 y 74 años",
			"mas_74"=>"Más de 74 años",
		),
		"en"=>array(
			"menos_65"=>"Under 65 years old",
			"65_74"=>"Between 65 and 74 years old",
			"mas_74"=>"Over 74 years old",
		),
	),
	"tipos"=>array(
		"ca"=>array(
			"Publica"=>"Residències de titularitat pública",
			"Privada"=>"Residències de titularitat privada",
			"Total"=>"Totes les residències",
		),
		"es"=>array(
			"Publica"=>"Residencias de titularidad pública",
			"Privada"=>"Residencias de titularidad privada",
			"Total"=>"Todas las residencias",
		),
		"en"=>array(
			"Publica"=>"Publicly owned residences",
			"Privada"=>"Privately owned residences",
			"Total"=>"All residences",
		),
	),
	"hospitalbed"=>array(
		"ca"=>"% llits d'hospital per cada 1000 habitants",
		"es"=>"% camas de hospital por cada 1000 habitantes",
		"en"=>"% of hospital beds per 1000 inhabitants",
	),
	"nurse"=>array(
		"ca"=>"% enfermeres per cada 1000 habitants",
		"es"=>"% enfermeras por cada 1000 habitantes",
		"en"=>"% nurses per 1000 inhabitants",
	),
	"fakes"=>array(
		"ca"=>"Atenció: el 27 de maig de l'any 2020 es van corregir les dades del MoMo, per poder observar aquesta correcció s'ha afegit la variable Fake que conté les dades de MoMo anteriors sense la correcció per als mesos de Març i Abril de l'any 2020",
		"es"=>"Atención: el 27 de Mayo del 2020 se corrigieron los datos de MoMo, para poder observar esta corrección se ha añadido la variable Fake que contiene los datos de MoMo anteriores sin la corrección para los meses de Marzo y Abril del 2020",
		"en"=>"Attention: on May 27, 2020 the MoMo data was corrected, in order to observe this correction we have added the Fake variable that contains the previous MoMo data without the correction for the months of March and April 2020",
	),
);

foreach(array("ca","es","en") as $lang) {

if(!file_exists("output/plot1${lang}.png")) {
	$momo=import_file("middle/data-ok.csv");
	$fake=import_file("middle/fake-ok.csv");
	$ine1=import_file("middle/02001-ok.csv");
	$ine2=import_file("middle/14819-ok.csv");
	$matrix=array();
	$years=array(2020,"Fake",2019,2018,2017,2015,2014,2012,2009,2005,2000,1999);
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
	foreach($fake as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$year="Fake";
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
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array_merge(array($textos["meses"][$lang][$key]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("middle/plot1${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'output/plot1${lang}.png'",
		"set multiplot layout 2,1 title \"".$textos["plots"][1][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set style histogram gap 3",
		"set datafile separator ';'",
		"plot [-0.5:5.5] 'middle/plot1${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
		"plot [5.5:11.5] 'middle/plot1${lang}.csv' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
		"unset multiplot",
	))."\n";
	file_put_contents("middle/plot1${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot1${lang}.gnu");
}

if(!file_exists("output/plot2${lang}.png")) {
	$momo=import_file("middle/data-ok.csv");
	$fake=import_file("middle/fake-ok.csv");
	$ine=import_file("middle/02001-ok.csv");
	$matrix=array();
	$years=array(2018,2019,2020);
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($years as $year) {
		foreach($months as $month) {
			$month=sprintf("%02d",$month);
			$matrix[$year."-".$month]["MoMo"]="";
			$matrix[$year."-".$month]["Fake"]="";
			$matrix[$year."-".$month]["INE"]="";
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momo as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["MoMo"])) $matrix[$year."-".$month]["MoMo"]=$val[1];
	}
	foreach($fake as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["Fake"])) $matrix[$year."-".$month]["Fake"]=$val[1];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["INE"])) $matrix[$year."-".$month]["INE"]=$val[1];
	}
	foreach($matrix as $key=>$val) {
		$temp=explode("-",$key);
		$matrix[$key]=array_merge(array($textos["meses"][$lang][$temp[1]]." ".$temp[0]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("middle/plot2${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'output/plot2${lang}.png'",
		"set multiplot layout 2,1 title \"".$textos["plots"][2][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot [-0.5:14.5] 'middle/plot2${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"plot [14.5:29.5] 'middle/plot2${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"unset multiplot",
	))."\n";
	file_put_contents("middle/plot2${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot2${lang}.gnu");
}

if(!file_exists("output/plot3${lang}.png")) {
	$momo=import_file("middle/data-ok2.csv");
	$fake=import_file("middle/fake-ok2.csv");
	foreach($momo as $key=>$val) {
		list($year,$month,$day)=explode("-",$val[0]);
		if($year!=2020) unset($momo[$key]);
	}
	foreach($fake as $key=>$val) {
		list($year,$month,$day)=explode("-",$val[0]);
		if($year!=2020) continue;
		if($momo[$key][0]==$val[0]) $momo[$key][2]=$val[1];
	}
	array_unshift($momo,array("Fecha","MoMo","Fake"));
	export_file("middle/plot3${lang}.csv",$momo);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'",
		"set output 'output/plot3${lang}.png'",
		"set multiplot layout 3,1 title \"".$textos["plots"][3][$lang]."\"",
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
		"plot ['2020-01-01':'2020-03-01'] 'middle/plot3${lang}.csv' using 1:2 w l ti col",
		"plot ['2020-03-01':'2020-05-01'] 'middle/plot3${lang}.csv' using 1:2 w l ti col, '' using 1:3 w l ti col",
		"plot ['2020-05-01':'2020-07-01'] 'middle/plot3${lang}.csv' using 1:2 w l ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("middle/plot3${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot3${lang}.gnu");
}

if(!file_exists("output/plot4${lang}.png")) {
	$momo=import_file("middle/data-ok3.csv");
	$fake=import_file("middle/fake-ok3.csv");
	$ine=import_file("middle/02001-ok2.csv");
	$matrix=array();
	$years=array(2020,"Fake",2019,2018);
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
	foreach($fake as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$edad=$val[1];
		$year="Fake";
		if(isset($matrix[$month][$edad."-".$year])) $matrix[$month][$edad."-".$year]=$val[2];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		$edad=$val[1];
		if(isset($matrix[$month][$edad."-".$year])) $matrix[$month][$edad."-".$year]=$val[2];
	}
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array_merge(array($textos["meses"][$lang][$key]),$val);
	}
	foreach($header as $key=>$val) {
		$val=explode("-",$val);
		$val[0]=$textos["edades"][$lang][$val[0]];
		$val=implode(" ",$val);
		$header[$key]=$val;
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("middle/plot4${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'",
		"set output 'output/plot4${lang}.png'",
		"set multiplot layout 3,1 title \"".$textos["plots"][4][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot [-0.5:11.5] 'middle/plot4${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col",
		"plot [-0.5:11.5] 'middle/plot4${lang}.csv' using 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col",
		"plot [-0.5:11.5] 'middle/plot4${lang}.csv' using 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("middle/plot4${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot4${lang}.gnu");
}

if(!file_exists("output/plot5${lang}.png")) {
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[0]]=$val[0]." ".$val[1];
	}
	$momo=import_file("middle/data-ok5.csv");
	$fake=import_file("middle/fake-ok5.csv");
	$ine=import_file("middle/6562-ok2.csv");
	$matrix=array();
	$years=array(2020,"Fake",2018,2017,2015,2014,2012,2009,2005,2000,1999);
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
	foreach($fake as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if($year!=2020) continue;
		$year="Fake";
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	$matrix["18 Ceuta + 19 Melilla"]=array(
		$matrix["18 Ceuta"][2020]+$matrix["19 Melilla"][2020],
		$matrix["18 Ceuta"]["Fake"]+$matrix["19 Melilla"]["Fake"],
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
		"03 Asturias, Principado de"=>"03 Principado\\nAsturias",
		"04 Balears, Illes"=>"04 Illes\\nBalears",
		"07 Castilla y León"=>"07 Castilla\\ny León",
		"08 Castilla - La Mancha"=>"08 Castilla\\nLa Mancha",
		"10 Comunitat Valenciana"=>"10 Comunitat\\nValenciana",
		"13 Madrid, Comunidad de"=>"13 Comunidad\\nde Madrid",
		"14 Murcia, Región de"=>"14 Región de\\nMurcia",
		"15 Navarra, Comunidad Foral de"=>"15 Comunidad\\nForal de\\nNavarra",
		"18 Ceuta + 19 Melilla"=>"18 Ceuta\\n19 Melilla",
	);
	foreach($matrix as $key=>$val) {
		$ccaa=isset($ccaas[$key])?$ccaas[$key]:$key;
		$matrix[$key]=array_merge(array($ccaa),$val);
	}
	array_unshift($matrix,array_merge(array("CCAA"),$header));
	export_file("middle/plot5${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1800 enhanced font 'Segoe UI,10'",
		"set output 'output/plot5${lang}.png'",
		"set multiplot layout 3,1 title \"".$textos["plots"][5][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:30000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot [-0.5:5.5] 'middle/plot5${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"plot [5.5:11.5] 'middle/plot5${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"plot [11.5:17.5] 'middle/plot5${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("middle/plot5${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot5${lang}.gnu");
}

if(!file_exists("output/plot6${lang}.png")) {
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
		"14 Murcia, Región de"=>"14 Región de\\nMurcia",
		"15 Navarra, Comunidad Foral de"=>"15 Comunidad\\nForal de\\nNavarra",
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
	export_file("middle/plot6${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set output 'output/plot6${lang}.png'",
		"set multiplot layout 1,1 title \"".$textos["plots"][6][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:90000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot 'middle/plot6${lang}.csv' using 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("middle/plot6${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot6${lang}.gnu");
}

if(!file_exists("output/plot7${lang}.png")) {
	$temp=import_file("input/oecd/code2country.csv");
	$paises=array();
	foreach($temp as $key=>$val) {
		$paises[$val[0]]=$val[1];
	}
	$bed=import_file("input/oecd/DP_LIVE_13052020195801818.csv");
	$nurse=import_file("input/oecd/DP_LIVE_13052020195843630.csv");
	$matrix=array();
	foreach($bed as $key=>$val) {
		if($val[1]=="HOSPITALBED" && $val[2]=="TOT" && $val[5]=="2016") {
			if(isset($matrix[$val[0]])) die("ERROR 2");
			$matrix[$val[0]]=$val[6];
		}
	}
	arsort($matrix);
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array($paises[$key],$val);
	}
	array_unshift($matrix,array("Pais",$textos["hospitalbed"][$lang]));
	export_file("middle/plot7${lang}1.csv",$matrix);
	$matrix=array();
	foreach($nurse as $key=>$val) {
		if($val[1]=="NURSE" && $val[2]=="TOT" && $val[5]=="2016") {
			if(isset($matrix[$val[0]])) die("ERROR 3");
			$matrix[$val[0]]=$val[6];
		}
	}
	arsort($matrix);
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array($paises[$key],$val);
	}
	array_unshift($matrix,array("Pais",$textos["nurse"][$lang]));
	export_file("middle/plot7${lang}2.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,1200 enhanced font 'Segoe UI,10'",
		"set output 'output/plot7${lang}.png'",
		"set multiplot layout 2,1 title \"".$textos["plots"][7][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"plot 'middle/plot7${lang}1.csv' using 2:xtic(1) ti col",
		"plot 'middle/plot7${lang}2.csv' using 2:xtic(1) ti col",
		"unset multiplot"
	))."\n";
	file_put_contents("middle/plot7${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot7${lang}.gnu");
}

if(!file_exists("index.${lang}.html")) {
	$html=implode("\n",array(
		"<!DOCTYPE html>",
		"<html>",
		"<head>",
		"<title>".$textos["header"][$lang]."</title>",
		"<style>",
		"body { font-family:Arial,Helvetica,sans-serif; }",
		"div { width:100%; max-width:1200px; margin: 0 auto; }",
		"img { width:100%; border: 1px solid #000; }",
		"h3,h4,h5 { text-align: center; border: 1px solid #000; padding:1em; background:#000; color:#fff; font-size:1em; }",
		"h3 { clear:both; }",
		"h4 { float:right; margin-left:1em; }",
		"h3.ca,h4.ca { border:1px solid #0a0; background:#0a0; }",
		"h3.es,h4.es,h5 { border:1px solid #a00; background:#a00; }",
		"h3.en,h4.en { border:1px solid #00a; background:#00a; }",
		"a { color:#fff; }",
		"</style>",
		"</head>",
		"<body>",
		"<div>",
	))."\n";
	foreach(array("en","es","ca") as $temp) {
		$html.=implode("\n",array(
			"<h4 class='${temp}'><a href='index.${temp}.html'>".strtoupper($temp)."</a></h4>",
		))."\n";
	}
	$html.=implode("\n",array(
		"<h3 class='${lang}'>".$textos["header"][$lang]."</h3>",
		"<h5>".$textos["fakes"][$lang]."</h5>",
	))."\n";
	for($i=1;$i<=7;$i++) {
		$html.=implode("\n",array(
			"<h3>".$textos["plots"][$i][$lang]."</h3>",
			"<img src='output/plot${i}${lang}.png'/>",
		))."\n";
	}
	$html.=implode("\n",array(
		"<h3 class='${lang}'>".$textos["footer"][$lang].": <a href='https://github.com/josepsanzcamp/covid19/'>https://github.com/josepsanzcamp/covid19/</a></h3>",
		"</div>",
		"</body>",
		"</html>",
	))."\n";
	file_put_contents("index.${lang}.html",$html);
}

}

if(!file_exists("index.html")) {
	$html=implode("\n",array(
		"<!DOCTYPE html>",
		"<html>",
		"<head>",
		"<title>".$textos["header"]["ca"]."</title>",
		"<style>",
		"body { font-family:Arial,Helvetica,sans-serif; }",
		"div { width:100%; max-width:1200px; margin: 0 auto; }",
		"img { width:100%; border: 1px solid #000; }",
		"h3,h4,h5 { text-align: center; border: 1px solid #000; padding:1em; background:#000; color:#fff; font-size:1em; }",
		"h3 { clear:both; }",
		"h4 { float:right; margin-left:1em; }",
		"h3.ca,h4.ca { border:1px solid #0a0; background:#0a0; }",
		"h3.es,h4.es,h5 { border:1px solid #a00; background:#a00; }",
		"h3.en,h4.en { border:1px solid #00a; background:#00a; }",
		"a { color:#fff; }",
		"</style>",
		"</head>",
		"<body>",
		"<div>",
	))."\n";
	foreach(array("en","es","ca") as $lang) {
		$html.=implode("\n",array(
			"<h4 class='${lang}'><a href='index.${lang}.html'>".strtoupper($lang)."</a></h4>",
		))."\n";
	}
	foreach(array("ca","es","en") as $lang) {
		$html.=implode("\n",array(
			"<h3 class='${lang}'><a href='index.${lang}.html'>".$textos["header"][$lang]."</a></h3>",
			"<h3 class='${lang}'>".$textos["footer"][$lang].": <a href='https://github.com/josepsanzcamp/covid19/'>https://github.com/josepsanzcamp/covid19/</a></h3>",
		))."\n";
	}
	$html.=implode("\n",array(
		"</div>",
	))."\n";
	$html.=implode("\n",array(
		"<script>",
		"var lang=navigator.language || navigator.systemLanguage;",
		"lang=lang.toLowerCase();",
		"lang=lang.substr(0,2);",
		"if(lang=='ca') window.location.href='index.ca.html';",
		"else if(lang=='es') window.location.href='index.es.html';",
		"else if(lang=='en') window.location.href='index.en.html';",
		"else window.location.href='index.ca.html';",
		"</script>",
	))."\n";
	$html.=implode("\n",array(
		"</body>",
		"</html>",
	))."\n";
	file_put_contents("index.html",$html);
}

?>