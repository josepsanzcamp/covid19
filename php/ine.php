<?php

if(!file_exists("middle/02001-ok.csv")) {
	console_debug("middle/02001-ok.csv");
	$data=import_file("input/ine/02001.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/02001-ok2.csv")) {
	console_debug("middle/02001-ok2.csv");
	$data=import_file("input/ine/02001.csv.gz");
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
			$sumas[$key2][1]+=str_replace(".","",$val[4]);
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
	unset($data);
	unset($meses);
	unset($edades);
	unset($umas);
	console_debug();
}

if(!file_exists("middle/02001-ok3.csv")) {
	console_debug("middle/02001-ok3.csv");
	$data=import_file("input/ine/02001.csv.gz");
	$matrix=array();
	foreach($data as $key=>$val) {
		if($val[0]=="Total" && $val[1]=="Total" && $val[2]=="Total") {
			$matrix[$val[3]]=array($val[3],str_replace(".","",$val[4]));
		}
		unset($data[$key]);
	}
	export_file("middle/02001-ok3.csv",$matrix);
	unset($data);
	unset($matrix);
	console_debug();
}

if(!file_exists("middle/14819-ok.csv")) {
	console_debug("middle/14819-ok.csv");
	$data=import_file("input/ine/14819.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6545-ok.csv")) {
	console_debug("middle/6545-ok.csv");
	$data=import_file("input/ine/6545.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6548-ok.csv")) {
	console_debug("middle/6548-ok.csv");
	$data=import_file("input/ine/6548.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6561-ok.csv")) {
	console_debug("middle/6561-ok.csv");
	$data=import_file("input/ine/6561.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6562-ok.csv")) {
	console_debug("middle/6562-ok.csv");
	$data=import_file("input/ine/6562.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6562-ok2.csv")) {
	console_debug("middle/6562-ok2.csv");
	$data=import_file("input/ine/6562.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6566-ok.csv")) {
	console_debug("middle/6566-ok.csv");
	$data=import_file("input/ine/6566.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/6580-ok.csv")) {
	console_debug("middle/6580-ok.csv");
	$data=import_file("input/ine/6580.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/7947-ok.csv")) {
	console_debug("middle/7947-ok.csv");
	$data=import_file("input/ine/7947.csv.gz");
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
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/02002-ok.csv")) {
	console_debug("middle/02002-ok.csv");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[mb_strtoupper($val[1])]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/02002.csv.gz");
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
			$sumas[$key2][1]+=str_replace(".","",$val[5]);
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
	unset($temp);
	unset($ccaas);
	unset($data);
	unset($edades);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/02002-ok2.csv")) {
	console_debug("middle/02002-ok2.csv");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[mb_strtoupper($val[1])]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/02002.csv.gz");
	$matrix=array();
	foreach($data as $key=>$val) {
		if($val[0]=="TOTAL ESPAÑA" && $val[1]=="TOTAL EDADES" && $val[2]=="TOTAL" && $val[3]=="Ambos sexos") {
			$matrix[$val[4]]=str_replace(".","",$val[5]);
		}
		unset($data[$key]);
	}
	$matrix=array("Any"=>"Total")+$matrix;
	foreach($matrix as $key=>$val) {;
		$matrix[$key]=array($key,$val);
	}
	export_file("middle/02002-ok2.csv",$matrix);
	unset($temp);
	unset($ccaas);
	unset($data);
	unset($matrix);
	console_debug();
}

if(!file_exists("middle/6548-ok2.csv")) {
	console_debug("middle/6548-ok2.csv");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[0]." ".$val[1]]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/6548.csv.gz");
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
	unset($temp);
	unset($ccaas);
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/02005-ok.csv")) {
	console_debug("middle/02005-ok.csv");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[mb_strtoupper($val[1])]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/02005.csv.gz");
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
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	$edades=array(3=>"mas_74",2=>"65_74",1=>"menos_65");
	foreach($sumas as $key=>$val) {
		$val[0]=$edades[$val[0]];
		$sumas[$key]=$val;
	}
	export_file("middle/02005-ok.csv",$sumas);
	unset($temp);
	unset($ccaas);
	unset($data);
	unset($edades);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/35177-ok.csv")) {
	console_debug("middle/35177-ok.csv");
	$data=import_file("input/ine/35177.csv.gz");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total Nacional" && $val[1]=="Dato base" && $val[3]!="Total") {
			$key2=substr($val[2],0,4);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/35177-ok.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/35177-ok2.csv")) {
	console_debug("middle/35177-ok2.csv");
	$data=import_file("input/ine/35177.csv.gz");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total Nacional" && $val[1]=="Dato base" && $val[3]!="Total") {
			$key2=str_replace("SM","-",$val[2]);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/35177-ok2.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

if(!file_exists("middle/35177-ok3.csv")) {
	console_debug("middle/35177-ok3.csv");
	$data=import_file("input/ine/35177.csv.gz");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]!="Total Nacional" && $val[1]=="Dato base" && $val[3]!="Total") {
			$key2=str_replace("SM","-",$val[2]).";".$val[0];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[3]);
		}
		unset($data[$key]);
	}
	export_file("middle/35177-ok3.csv",$sumas);
	unset($data);
	unset($sumas);
	console_debug();
}

?>
