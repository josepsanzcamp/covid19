<?php

ini_set("memory_limit","1024M");
ini_set("max_execution_time","3600");

function import_file($file) {
	$data=file($file,FILE_IGNORE_NEW_LINES);
	$sep="";
	if($sep=="" && strpos($data[0],";")!==false) $sep=";";
	if($sep=="" && strpos($data[0],",")!==false) $sep=",";
	foreach($data as $key=>$val) {
		$val=explode($sep,$val);
		$count=count($val);
		for($i=0;$i<$count;$i++) {
			if(substr($val[$i],0,1)=='"') {
				$val[$i]=substr($val[$i],1);
				for($j=$i;$j<$count;$j++) {
					if(substr($val[$j],-1,1)=='"') {
						$val[$j]=substr($val[$j],0,-1);
						for($k=$i+1;$k<=$j;$k++) {
							$val[$i].=$sep.$val[$k];
							unset($val[$k]);
						}
						$i=$j;
						break;
					}
				}
			}
		}
		$data[$key]=array_values($val);
	}
	return $data;
}

function export_file($file,$data) {
	foreach($data as $key=>$val) {
		$data[$key]=implode(";",$val);
	}
	$data=implode("\n",$data)."\n";
	file_put_contents($file,$data);
}

function console_debug($file="") {
	static $start;
	if($file!="") {
		echo "Building ${file} ... ";
		$start=microtime(true);
		ob_start();
	} else {
		$output=trim(ob_get_clean());
		$used=microtime(true)-$start;
		if($used>=1) $used=round($used,2)."sec";
		elseif($used>=0.001) $used=round($used*1000,2)."msec";
		elseif($used>=0.000001) $used=round($used*1000000,2)."usec";
		if($output=="") echo "ok";
		if($output!="") echo "ko";
		echo " (${used})\n";
	}
}

if(!file_exists("middle/02001-ok.csv")) {
	console_debug("middle/02001-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/02001-ok2.csv")) {
	console_debug("middle/02001-ok2.csv");
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
	console_debug();
}

if(!file_exists("middle/14819-ok.csv")) {
	console_debug("middle/14819-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/6545-ok.csv")) {
	console_debug("middle/6545-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/6548-ok.csv")) {
	console_debug("middle/6548-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/6561-ok.csv")) {
	console_debug("middle/6561-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/6562-ok.csv")) {
	console_debug("middle/6562-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/6562-ok2.csv")) {
	console_debug("middle/6562-ok2.csv");
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
	console_debug();
}

if(!file_exists("middle/6566-ok.csv")) {
	console_debug("middle/6566-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/6580-ok.csv")) {
	console_debug("middle/6580-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/7947-ok.csv")) {
	console_debug("middle/7947-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/datanew.csv")) {
	console_debug("middle/datanew.csv");
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
	export_file("middle/datanew.csv",$result2);
	console_debug();
}

if(!file_exists("middle/datanew-ok.csv")) {
	console_debug("middle/datanew-ok.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok2.csv")) {
	console_debug("middle/datanew-ok2.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok2.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok3.csv")) {
	console_debug("middle/datanew-ok3.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok3.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok4.csv")) {
	console_debug("middle/datanew-ok4.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=$val[8].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok4.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok5.csv")) {
	console_debug("middle/datanew-ok5.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok5.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok6.csv")) {
	console_debug("middle/datanew-ok6.csv");
	$data=import_file("middle/datanew.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3].";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/datanew-ok6.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/residencias.csv")) {
	console_debug("middle/residencias.csv");
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
	console_debug();
}

if(!file_exists("middle/02002-ok.csv")) {
	console_debug("middle/02002-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/02002-ok2.csv")) {
	console_debug("middle/02002-ok2.csv");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[mb_strtoupper($val[1])]=$val[0]." ".$val[1];
	}
	$data=import_file("input/ine/02002.csv");
	$matrix=array();
	foreach($data as $key=>$val) {
		if($val[0]=="TOTAL ESPAÑA" && $val[1]=="TOTAL EDADES" && $val[2]=="TOTAL" && $val[3]=="Ambos sexos") {
			$matrix[$val[4]]=str_replace(".","",str_replace(".","",$val[5]));
		}
		unset($data[$key]);
	}
	$matrix=array("Any"=>"Total")+$matrix;
	foreach($matrix as $key=>$val) {;
		$matrix[$key]=array($key,$val);
	}
	export_file("middle/02002-ok2.csv",$matrix);
	console_debug();
}

if(!file_exists("middle/6548-ok2.csv")) {
	console_debug("middle/6548-ok2.csv");
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
	console_debug();
}

if(!file_exists("middle/02005-ok.csv")) {
	console_debug("middle/02005-ok.csv");
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
	console_debug();
}

if(!file_exists("middle/dataold.csv")) {
	console_debug("middle/dataold.csv");
	$files=glob("input/momo/data.????????.csv");
	sort($files);
	foreach($files as $key=>$val) {
		$temp=explode(".",$val);
		if($temp[1]>=20200527) unset($files[$key]);
	}
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
	export_file("middle/dataold.csv",$result2);
	console_debug();
}

if(!file_exists("middle/dataold-ok.csv")) {
	console_debug("middle/dataold-ok.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7);
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/dataold-ok2.csv")) {
	console_debug("middle/dataold-ok2.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
			$key2=$val[8];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok2.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/dataold-ok3.csv")) {
	console_debug("middle/dataold-ok3.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="nacional" && $val[4]=="all" && $val[6]!="all") {
			$key2=substr($val[8],0,7).";".$val[6];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok3.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/dataold-ok5.csv")) {
	console_debug("middle/dataold-ok5.csv");
	$data=import_file("middle/dataold.csv");
	$sumas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="ccaa" && $val[4]=="all" && $val[6]=="all") {
			$key2=substr($val[8],0,7).";".sprintf("%02d",$val[2])." ".$val[3];
			if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
			$sumas[$key2][1]+=str_replace(".","",$val[9]);
		}
		unset($data[$key]);
	}
	export_file("middle/dataold-ok5.csv",$sumas);
	console_debug();
}

if(!file_exists("middle/datanew-ok7.csv")) {
	console_debug("middle/datanew-ok7.csv");
	$files=glob("input/momo/data.????????.csv");
	sort($files);
	$sumas=array();
	foreach($files as $file) {
		$data=import_file($file);
		$temp=explode(".",$file);
		$temp=str_split($temp[1],2);
		$fecha=$temp[0].$temp[1]."-".$temp[2]."-".$temp[3];
		foreach($data as $key=>$val) {
			if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
				$key2=$fecha.";".substr($val[8],0,7);
				if(!isset($sumas[$key2])) $sumas[$key2]=array($key2,0);
				$sumas[$key2][1]+=str_replace(".","",$val[9]);
			}
			unset($data[$key]);
		}
	}
	export_file("middle/datanew-ok7.csv",$sumas);
	console_debug();
}

if(count(glob("middle/euromomo.????????.csv"))!=count(glob("input/euromomo/component.????????.js"))) {
	console_debug("middle/euromomo.????????.csv");
	$files=glob("input/euromomo/component.????????.js");
	sort($files);
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("middle/euromomo.${part}.csv")) continue;
		$buffer=file_get_contents($file);
		$pos=strrpos($buffer,"JSON.parse");
		if($pos===false) die("ERROR 2");
		$pos=strpos($buffer,"{",$pos);
		if($pos===false) die("ERROR 3");
		$pos2=strpos($buffer,"}')",$pos);
		$buffer=substr($buffer,$pos,$pos2-$pos+1);
		$json=json_decode($buffer,true);
		$matrix=array();
		if(!isset($json["pooled"]["weeks"])) $json["pooled"]["weeks"]=$json["weeks"];
		$weeks=$json["pooled"]["weeks"];
		foreach($json["pooled"]["groups"] as $key=>$val) {
			$group=$val["group"];
			unset($val["group"]);
			foreach($val as $key2=>$val2) {
				foreach($val2 as $key3=>$val3) {
					$matrix[]=array("pooled","",$group,$key2,$weeks[$key3],$val3);
				}
			}
		}
		if(!isset($json["countries"]["countries"])) $json["countries"]["countries"]=$json["countries"];
		if(!isset($json["countries"]["weeks"])) $json["countries"]["weeks"]=$json["weeks"];
		$weeks=$json["countries"]["weeks"];
		foreach($json["countries"]["countries"] as $key=>$val) {
			$country=$val["country"];
			unset($val["country"]);
			foreach($val["groups"] as $key2=>$val2) {
				$group=$val2["group"];
				unset($val2["group"]);
				foreach($val2 as $key3=>$val3) {
					foreach($val3 as $key4=>$val4) {
						$matrix[]=array("countries",$country,$group,$key3,$weeks[$key4],$val4);
					}
				}
			}
		}
		export_file("middle/euromomo.${part}.csv",$matrix);
	}
	console_debug();
}

if(!file_exists("middle/dc_20xx_det.csv")) {
	console_debug("middle/dc_20xx_det.csv");
	$files=glob("input/france/DC_20??_det.csv");
	sort($files);
	$sumas=array();
	foreach($files as $file) {
		$data=import_file($file);
		unset($data[0]);
		foreach($data as $key=>$val) {
			$fecha=sprintf("%04d-%02d-%02d",$val[0],$val[1],$val[2]);
			if(!isset($sumas[$fecha])) $sumas[$fecha]=array($fecha,0);
			$sumas[$fecha][1]++;
			unset($data[$key]);
		}
	}
	export_file("middle/dc_20xx_det.csv",$sumas);
	console_debug();
}

if(count(glob("middle/data.????????.csv"))!=count(glob("input/momo2/data.????????.csv"))) {
	console_debug("middle/data.????????.csv");
	$files=glob("input/momo2/data.????????.csv");
	sort($files);
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("middle/data.${part}.csv")) continue;
		$data=import_file($file);
		$matrix=array();
		foreach($data as $key=>$val) {
			if($val[0]=="nacional" && $val[4]=="all" && $val[6]=="all") {
				$key2=$val[8];
				if(isset($matrix[$key2])) die("ERROR 4");
				$matrix[$key2]=array($key2,str_replace(".","",$val[9]));
			}
			unset($data[$key]);
		}
		export_file("middle/data.${part}.csv",$matrix);
	}
	console_debug();
}

$textos=array(
	"header"=>array(
		"ca"=>"Informació útil d'Espanya sobre l'impacte de covid-19: gràfics de defuncions per any, origen de les dades, acumulats diaris, per edat, per comunitat autònoma i més",
		"es"=>"Información útil de España sobre el impacto de covid-19: gráficos de defunciones por año, origen de los datos, acumulados diarios, por edad, por comunidad autónoma y más",
		"en"=>"Useful Spain information about the covid-19 impact: Graphs of deaths by year, origin of the data, daily accumulated, by age, by autonomous community, and more",
	),
	"plots"=>array(
		"01"=>array(
			"ca"=>"1. Defuncions per any i mes (només anys on algun mes ha superat els 40k morts, les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"1. Defunciones por año y mes (sólo años donde algún mes ha superado los 40k muertos, los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"1. Deaths by year and month (only years where some month has exceeded 40k deaths, 2020 data are from the MoMo and the rest are from the INE)",
		),
		"02"=>array(
			"ca"=>"2. Defuncions per any i mes del MoMo i INE entre 2018 i 2020",
			"es"=>"2. Defunciones por año y mes del MoMo y INE entre 2018 y 2020",
			"en"=>"2. Deaths by year and month of the MoMo and INE between 2018 and 2020",
		),
		"03"=>array(
			"ca"=>"3. Defuncions per dia obtinguts del MoMo per al 2020, 2019, 2018 i el promig del 2018",
			"es"=>"3. Defunciones por dia obtenidos del MoMo para el 2020, 2019, 2018 y el promedio del 2018",
			"en"=>"3. Deaths per day obtained from the MoMo by 2020, 2019, 2018 and the 2018 average",
		),
		"04"=>array(
			"ca"=>"4. Defuncions per any, mes i edat (les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"4. Defunciones por año, mes y edad (los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"4. Deaths by year, month and age (2020 data are from MoMo and the rest are from INE)",
		),
		"05"=>array(
			"ca"=>"5. Defuncions per comunitat autònoma i any (acumulats per any de març i abril, les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"5. Defunciones por comunidad autónoma y año (acumulados por año de marzo y abril, los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"5. Deaths by autonomous community and year (accumulated by year of March and April, the data for 2020 are from the MoMo and the rest are from the INE)",
		),
		"06"=>array(
			"ca"=>"6. Places de residències per tipus i comunitat autònoma (dades obtingudes de envejecimientoenred.es, del CSIC del 2019)",
			"es"=>"6. Plazas de residencias por tipo y comunidad autónoma (datos obtenidos de envejecimientoenred.es, del CSIC del 2019)",
			"en"=>"6. Places of residences by type and autonomous community (data obtained from envejecimientoenred.es, from the CSIC of 2019)",
		),
		"07"=>array(
			"ca"=>"7. Relació de llits de hospital, infermeres y metges per país en 2019 o darrer any on existeixin dades segons dades OECD",
			"es"=>"7. Relación de camas de hospital, enfermeras y médicos por país en 2019 o ultimo año donde existan datos segun datos OECD",
			"en"=>"7. Relation of hospital beds, nurses and doctors by country in 2019 or latest year where data is found according to OECD data",
		),
		"08"=>array(
			"ca"=>"8. Defuncions per any i mes del MoMo segons la data de descarrega del fitxer de dades i diferencia entre cada fitxer",
			"es"=>"8. Defunciones por año i mes del MoMo según la fecha de descarga del fichero de datos y diferencia entre cada fichero",
			"en"=>"8. Deaths by year and month of the MoMo related to the download date of the data file and difference between each file",
		),
		"09"=>array(
			"ca"=>"9. Defuncions per setmana del any y per pais obtingudes del EuroMoMo (el valor que es mostra es el zscore)",
			"es"=>"9. Defunciones por semana del año y por país obtenidas del EuroMoMo (el valor que se muestra es el zscore)",
			"en"=>"9. Deaths by week of year and by country obtained from the EuroMoMo (the value used to plot is the zscore)",
		),
		"10"=>array(
			"ca"=>"10. Defuncions per dia obtinguts del Statistics Sweden",
			"es"=>"10. Defunciones por dia obtenidos del Statistics Sweden",
			"en"=>"10. Deaths by day obtained from Statistics Sweden",
		),
		"11"=>array(
			"ca"=>"11. Defuncions per setmana obtinguts del Statistics Norway",
			"es"=>"11. Defunciones por semana obtenidos del Statistics Norway",
			"en"=>"11. Deaths by week obtained from Statistics Norway",
		),
		"12"=>array(
			"ca"=>"12. Defuncions per dia obtinguts del MoMo Spain",
			"es"=>"12. Defunciones por dia obtenidos del MoMo Spain",
			"en"=>"12. Deaths per day obtained from the MoMo Spain",
		),
		"13"=>array(
			"ca"=>"13. Defuncions per dia obtinguts del SICO Portugal",
			"es"=>"13. Defunciones por dia obtenidos del SICO Portugal",
			"en"=>"13. Deaths by day obtained from SICO Portugal",
		),
		"14"=>array(
			"ca"=>"14. Defuncions per anys del MoMo i del INE (combinant dades del mateix any actual i del any anterior)",
			"es"=>"14. Defunciones por año del MoMo y del INE (combinando datos del mismo año y del año anterior)",
			"en"=>"14. Deaths by year obtained from MoMo and INE (combining data from the same year and the previous year)",
		),
		"15"=>array(
			"ca"=>"15. Evolucio de defuncions per dia obtinguts del MoMo per al 2020, 2019, 2018 i el promig del 2018",
			"es"=>"15. Evolución de las defunciones por dia obtenidos del MoMo para el 2020, 2019, 2018 y el promedio del 2018",
			"en"=>"15. Evolution of the deaths per day obtained from the MoMo by 2020, 2019, 2018 and the 2018 average",
		),
		"16"=>array(
			"ca"=>"16. Defuncions per dia obtinguts del Institut National de la statistique et des études économiques",
			"es"=>"16. Defunciones por dia obtenidos del Institut National de la statistique et des études économiques",
			"en"=>"16. Deaths per day obtained from the Institut National de la statistique et des études économiques",
		),
		"17"=>array(
			"ca"=>"17. Defuncions per setmana obtinguts del Statistisches Bundesamt",
			"es"=>"17. Defunciones por semana obtenidos del Statistisches Bundesamt",
			"en"=>"17. Deaths by week obtained from Statistisches Bundesamt",
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
	"doctor"=>array(
		"ca"=>"% metges per cada 1000 habitants",
		"es"=>"% médicos por cada 1000 habitantes",
		"en"=>"% doctors per 1000 inhabitants",
	),
	"momoold"=>array(
		"ca"=>"Atenció: el 27 de maig de l'any 2020 es van corregir les dades del MoMo, per poder observar aquesta correcció, he anomenat MoMoOld a les dades anteriors a la correcció i MoMoNew a les darreres dades oficials",
		"es"=>"Atención: el 27 de mayo del año 2020 se corrigieron los datos del MoMo, para poder observar esta corrección, he llamado MoMoOld a los datos anteriores a la corrección y MoMoNew a los últimos datos oficiales",
		"en"=>"Attention: on May 27, 2020 the MoMo data was corrected, in order to observe this correction, I have used MoMoOld for the previously data to the correction and MoMoNew for the latest oficial data",
	),
	"escala"=>array(
		"ca"=>"Atenció: aquesta gràfica te l'escala diferent que la gràfica anterior del mateix grup",
		"es"=>"Atención: esta gráfica tiene la escala diferente que la gráfica anterior del mismo grupo",
		"en"=>"Atencion: this plot has a different scale related to the previous plot of the same group",
	),
	"plot14"=>array(
		0=>array(
			"ca"=>"Gener a Desembre del mateix any",
			"es"=>"Enero a Diciembre del mismo año",
			"en"=>"January to December of the same year",
		),
		1=>array(
			"ca"=>"Desembre de l'any anterior + Gener a Novembre del mateix any",
			"es"=>"Diciembre del año anterior + Enero a Noviembre del mismo año",
			"en"=>"December of the previous year + January to November of the same year",
		),
		2=>array(
			"ca"=>"Novembre i Desembre de l'any anterior + Gener a Octubre del mateix any",
			"es"=>"Noviembre y Diciembre del año anterior + Enero a Octubre del mismo año",
			"en"=>"November and December of the previous year + January to October of the same year",
		),
		3=>array(
			"ca"=>"Octubre a Desembre de l'any anterior + Gener a Setembre del mateix any",
			"es"=>"Octubre a Diciembre del año anterior + Enero a Setiembre del mismo año",
			"en"=>"October to December of the previous year + January to September of the same year",
		),
		4=>array(
			"ca"=>"Setembre a Desembre de l'any anterior + Gener a Agost del mateix any",
			"es"=>"Setiembre a Diciembre del año anterior + Enero a Agosto del mismo año",
			"en"=>"September to December of the previous year + January to August of the same year",
		),
		5=>array(
			"ca"=>"Agost a Desembre de l'any anterior + Gener a Juliol del mateix any",
			"es"=>"Agosto a Diciembre del año anterior + Enero a Julio del mismo año",
			"en"=>"August to December of the previous year + January to July of the same year",
		),
		6=>array(
			"ca"=>"Juliol a Desembre de l'any anterior + Gener a Juny del mateix any",
			"es"=>"Julio a Diciembre del año anterior + Enero a Junio del mismo año",
			"en"=>"July to December of the previous year + January to June of the same year",
		),
		7=>array(
			"ca"=>"Juny a Desembre de l'any anterior + Gener a Maig del mateix any",
			"es"=>"Junio a Diciembre del año anterior + Enero a Mayo del mismo año",
			"en"=>"June to December of the previous year + January to May of the same year",
		),
		8=>array(
			"ca"=>"1/100 de la població total, per comparar la mortalitat respecte la població",
			"es"=>"1/100 de la población total, para comparar la mortalidad respecto la población",
			"en"=>"1/100 of the total population, for compare the deathly vs population",
		),
	),
);

foreach(array("ca","es","en") as $lang) {

if(!file_exists("output/plot01${lang}1.png")) {
	console_debug("output/plot01${lang}1.png");
	$momoold=import_file("middle/dataold-ok.csv");
	$momonew=import_file("middle/datanew-ok.csv");
	$ine1=import_file("middle/02001-ok.csv");
	$ine2=import_file("middle/14819-ok.csv");
	$matrix=array();
	$years=array("MoMoOld","MoMoNew",2019,2018,2017,2015,2014,2012,2009,2005,2000,1999);
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($years as $year) {
		foreach($months as $month) {
			$month=sprintf("%02d",$month);
			$matrix[$month][$year]="";
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momoold as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$year="MoMoOld";
		if(isset($matrix[$month][$year])) $matrix[$month][$year]=$val[1];
	}
	foreach($momonew as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$year="MoMoNew";
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
	export_file("middle/plot01${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["01"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set style histogram gap 3",
		"set ytic center rotate by 90",
		"set ytics 0,10000,50000",
		"set datafile separator ';'",
		"set output 'output/plot01${lang}1.png'",
		"set xrange [-0.5:5.5]",
		"plot 'middle/plot01${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
		"set output 'output/plot01${lang}2.png'",
		"set xrange [5.5:11.5]",
		"plot 'middle/plot01${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot01${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot01${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot02${lang}1.png")) {
	console_debug("output/plot02${lang}1.png");
	$momoold=import_file("middle/dataold-ok.csv");
	$momonew=import_file("middle/datanew-ok.csv");
	$ine=import_file("middle/02001-ok.csv");
	$matrix=array();
	$years=array(2018,2019,2020);
	$months=array(1,2,3,4,5,6,7,8,9,10,11,12);
	foreach($years as $year) {
		foreach($months as $month) {
			$month=sprintf("%02d",$month);
			$matrix[$year."-".$month]["MoMoOld"]="";
			$matrix[$year."-".$month]["MoMoNew"]="";
			$matrix[$year."-".$month]["INE"]="";
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momoold as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["MoMoOld"])) $matrix[$year."-".$month]["MoMoOld"]=$val[1];
	}
	foreach($momonew as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["MoMoNew"])) $matrix[$year."-".$month]["MoMoNew"]=$val[1];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(isset($matrix[$year."-".$month]["INE"])) $matrix[$year."-".$month]["INE"]=$val[1];
	}
	foreach($matrix as $key=>$val) {
		$temp=explode("-",$key);
		$matrix[$key]=array_merge(array($textos["meses"][$lang][$temp[1]]."\\n".$temp[0]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("middle/plot02${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["02"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set style histogram gap 3",
		"set ytic center rotate by 90",
		"set ytics 0,10000,50000",
		"set datafile separator ';'",
		"set output 'output/plot02${lang}1.png'",
		"set xrange [-0.5:11.5]",
		"plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"set output 'output/plot02${lang}2.png'",
		"set xrange [11.5:23.5]",
		"plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"set output 'output/plot02${lang}3.png'",
		"set xrange [23.5:35.5]",
		"plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot02${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot02${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot03${lang}1.png")) {
	console_debug("output/plot03${lang}1.png");
	$momoold=import_file("middle/dataold-ok2.csv");
	$momonew=import_file("middle/datanew-ok2.csv");
	$otros=import_file("middle/7947-ok.csv");
	$matrix=array();
	for($i=strtotime("2020-01-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
		$fecha=date("Y-m-d",$i);
		$i=strtotime($fecha." 12:00:00");
		$matrix[$fecha]=array($fecha,"","","","","");
	}
	foreach($momoold as $key=>$val) {
		if(isset($matrix[$val[0]])) $matrix[$val[0]][1]=$val[1];
		unset($momoold[$key]);
	}
	foreach($momonew as $key=>$val) {
		$year=strtok($val[0],"-");
		if(isset($matrix[$val[0]])) $matrix[$val[0]][2]=$val[1];
		if($year==2019) {
			$val[0]=str_replace(2019,2020,$val[0]);
			if(isset($matrix[$val[0]])) $matrix[$val[0]][3]=$val[1];
		}
		if($year==2018) {
			$val[0]=str_replace(2018,2020,$val[0]);
			if(isset($matrix[$val[0]])) $matrix[$val[0]][4]=$val[1];
		}
		unset($momonew[$key]);
	}
	foreach($otros as $key=>$val) {
		$year=$val[0];
		if($year!=2018) continue;
		$media=round($val[1]/365,0);
		foreach($matrix as $key2=>$val2) {
			$matrix[$key2][5]=$media;
		}
	}
	array_unshift($matrix,array("Fecha","MoMoOld","MoMoNew","MoMo2019","MoMo2018","INE2018"));
	export_file("middle/plot03${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["03"][$lang]."\"",
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
		"set xtics '2020-01-06',86400*7,'2021-01-01'",
		"set ytic center rotate by 90",
		"set ytics 0,500,3000",
		"set datafile separator ';'",
		"set output 'output/plot03${lang}1.png'",
		"set xrange ['2020-01-01':'2020-03-01']",
		"plot 'middle/plot03${lang}.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:6 w l lc 9 ti col",
		"set output 'output/plot03${lang}2.png'",
		"set xrange ['2020-03-01':'2020-05-01']",
		"plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:6 w l lc 9 ti col",
		"set output 'output/plot03${lang}3.png'",
		"set xrange ['2020-05-01':'2020-07-01']",
		"plot 'middle/plot03${lang}.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col",
		"set output 'output/plot03${lang}4.png'",
		"set xrange ['2020-07-01':'2020-09-01']",
		"plot 'middle/plot03${lang}.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col",
		"set output 'output/plot03${lang}5.png'",
		"set xrange ['2020-09-01':'2020-11-01']",
		"plot 'middle/plot03${lang}.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col",
		"set output 'output/plot03${lang}6.png'",
		"set xrange ['2020-11-01':'2021-01-01']",
		"plot 'middle/plot03${lang}.csv' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w l lc 9 ti col",
 	))."\n";
	file_put_contents("middle/plot03${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot03${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot04${lang}1.png")) {
	console_debug("output/plot04${lang}1.png");
	$momoold=import_file("middle/dataold-ok3.csv");
	$momonew=import_file("middle/datanew-ok3.csv");
	$ine=import_file("middle/02001-ok2.csv");
	$matrix=array();
	$years=array("MoMoOld","MoMoNew",2019,2018);
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
	foreach($momoold as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$edad=$val[1];
		$year="MoMoOld";
		if(isset($matrix[$month][$edad."-".$year])) $matrix[$month][$edad."-".$year]=$val[2];
	}
	foreach($momonew as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if($year!=2020) continue;
		$edad=$val[1];
		$year="MoMoNew";
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
	export_file("middle/plot04${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["04"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set style histogram gap 3",
		"set ytic center rotate by 90",
		"set ytics 0,10000,50000",
		"set datafile separator ';'",
		"set output 'output/plot04${lang}1.png'",
		"set xrange [-0.5:11.5]",
		"plot 'middle/plot04${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col",
		"set yrange [0:20000]",
		"set ytics 0,5000,15000",
		"set label 1 \"".$textos["escala"][$lang]."\" at 5.5,17500 c tc lt 1",
		"set output 'output/plot04${lang}2.png'",
		"set xrange [-0.5:11.5]",
		"plot 'middle/plot04${lang}.csv' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col",
		"set output 'output/plot04${lang}3.png'",
		"set xrange [-0.5:11.5]",
		"plot 'middle/plot04${lang}.csv' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot04${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot04${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot05${lang}1.png")) {
	console_debug("output/plot05${lang}1.png");
	$temp=import_file("input/csic/prov2ccaa.csv");
	$ccaas=array();
	foreach($temp as $key=>$val) {
		$ccaas[$val[0]]=$val[0]." ".$val[1];
	}
	$momoold=import_file("middle/dataold-ok5.csv");
	$momonew=import_file("middle/datanew-ok5.csv");
	$ine=import_file("middle/6562-ok2.csv");
	$matrix=array();
	$years=array("MoMoOld","MoMoNew",2018,2017,2015,2014,2012,2009,2005,2000,1999);
	foreach($years as $year) {
		foreach($ccaas as $ccaa) {
			$matrix[$ccaa][$year]=0;
		}
	}
	$header=array_keys(reset($matrix));
	foreach($momoold as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if($year!=2020) continue;
		$year="MoMoOld";
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	foreach($momonew as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if($year!=2020) continue;
		$year="MoMoNew";
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	foreach($ine as $key=>$val) {
		list($year,$month)=explode("-",$val[0]);
		if(!in_array($month,array(3,4))) continue;
		if(isset($matrix[$val[1]][$year])) $matrix[$val[1]][$year]+=$val[2];
	}
	$matrix["18 Ceuta + 19 Melilla"]=array(
		$matrix["18 Ceuta"]["MoMoOld"]+$matrix["19 Melilla"]["MoMoOld"],
		$matrix["18 Ceuta"]["MoMoNew"]+$matrix["19 Melilla"]["MoMoNew"],
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
		"14 Murcia, Región de"=>"14 Región\\nde Murcia",
		"15 Navarra, Comunidad Foral de"=>"15 Comunidad\\nForal de Navarra",
		"18 Ceuta + 19 Melilla"=>"18 Ceuta\\n19 Melilla",
	);
	foreach($matrix as $key=>$val) {
		$ccaa=isset($ccaas[$key])?$ccaas[$key]:$key;
		$matrix[$key]=array_merge(array($ccaa),$val);
	}
	array_unshift($matrix,array_merge(array("CCAA"),$header));
	export_file("middle/plot05${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
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
		"set datafile separator ';'",
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
	console_debug();
}

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
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
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
	console_debug();
}

if(!file_exists("output/plot07${lang}1.png")) {
	console_debug("output/plot07${lang}1.png");
	$temp=import_file("input/oecd/code2country.csv");
	$paises=array();
	foreach($temp as $key=>$val) {
		$paises[$val[0]]=$val[1];
	}
	$bed=import_file("input/oecd/DP_LIVE_19082020091144018.csv");
	$nurse=import_file("input/oecd/DP_LIVE_19082020092133263.csv");
	$doctor=import_file("input/oecd/DP_LIVE_19082020092144951.csv");
	$matrix=array();
	foreach($bed as $key=>$val) {
		if($val[1]=="HOSPITALBED" && $val[2]=="TOT") {
			if(!isset($matrix[$val[0]])) $matrix[$val[0]]=$paises[$val[0]];
		}
	}
	foreach($nurse as $key=>$val) {
		if($val[1]=="NURSE" && $val[2]=="TOT") {
			if(!isset($matrix[$val[0]])) $matrix[$val[0]]=$paises[$val[0]];
		}
	}
	foreach($doctor as $key=>$val) {
		if($val[1]=="MEDICALDOC" && $val[2]=="TOT") {
			if(!isset($matrix[$val[0]])) $matrix[$val[0]]=$paises[$val[0]];
		}
	}
	asort($matrix);
	foreach($matrix as $key=>$val) {
		$matrix[$key]=array($val,"","","","","","");
	}
	$years=array();
	foreach($bed as $key=>$val) {
		if($val[1]=="HOSPITALBED" && $val[2]=="TOT") {
			if(!isset($years[$val[0]])) $years[$val[0]]=0;
			$years[$val[0]]=max($years[$val[0]],$val[5]);
		}
	}
	foreach($bed as $key=>$val) {
		if($val[1]=="HOSPITALBED" && $val[2]=="TOT" && $val[5]==$years[$val[0]]) {
			if($matrix[$val[0]][1]!="") die("ERROR 6");
			$matrix[$val[0]][1]=$val[6];
			$matrix[$val[0]][2]=$val[5];
		}
	}
	$years=array();
	foreach($nurse as $key=>$val) {
		if($val[1]=="NURSE" && $val[2]=="TOT") {
			if(!isset($years[$val[0]])) $years[$val[0]]=0;
			$years[$val[0]]=max($years[$val[0]],$val[5]);
		}
	}
	foreach($nurse as $key=>$val) {
		if($val[1]=="NURSE" && $val[2]=="TOT" && $val[5]==$years[$val[0]]) {
			if($matrix[$val[0]][3]!="") die("ERROR 7");
			$matrix[$val[0]][3]=$val[6];
			$matrix[$val[0]][4]=$val[5];
		}
	}
	$years=array();
	foreach($doctor as $key=>$val) {
		if($val[1]=="MEDICALDOC" && $val[2]=="TOT") {
			if(!isset($years[$val[0]])) $years[$val[0]]=0;
			$years[$val[0]]=max($years[$val[0]],$val[5]);
		}
	}
	foreach($doctor as $key=>$val) {
		if($val[1]=="MEDICALDOC" && $val[2]=="TOT" && $val[5]==$years[$val[0]]) {
			if($matrix[$val[0]][5]!="") die("ERROR 8");
			$matrix[$val[0]][5]=$val[6];
			$matrix[$val[0]][6]=$val[5];
		}
	}
	array_unshift($matrix,array("Pais",$textos["hospitalbed"][$lang],"Year",$textos["nurse"][$lang],"Year",$textos["doctor"][$lang],"Year"));
	export_file("middle/plot07${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["07"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 6",
		"set lmargin 6",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45",
		"set style histogram gap 3",
		"set yrange [0:20]",
		"set ytic center rotate by 90",
		"set ytics 0,5,15",
		"set datafile separator ';'",
		"set output 'output/plot07${lang}1.png'",
		"set xrange [-0.5:21.5]",
		"plot 'middle/plot07${lang}.csv' u 2:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 6:xtic(1) ti col",
		"set output 'output/plot07${lang}2.png'",
		"set xrange [21.5:43.5]",
		"plot 'middle/plot07${lang}.csv' u 2:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 6:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot07${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot07${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot08${lang}1.png")) {
	console_debug("output/plot08${lang}1.png");
	$data=import_file("middle/datanew-ok7.csv");
	$axis0=array();
	$axis1=array();
	foreach($data as $key=>$val) {
		if(!isset($axis0[$val[0]])) $axis0[$val[0]]=$val[0];
		//~ if(!isset($axis1[$val[1]])) $axis1[$val[1]]=$val[1];
	}
	for($i=strtotime("2018-01-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
		$fecha=date("Y-m",$i);
		$axis1[$fecha]=$fecha;
	}
	$matrix=array();
	foreach($axis1 as $key=>$val) {
		$matrix[$val][$val]=$val;
		foreach($axis0 as $key2=>$val2) {
			$matrix[$val][$val2]="";
		}
	}
	foreach($data as $key=>$val) {
		if($matrix[$val[1]][$val[0]]!="") die("ERROR 9");
		$matrix[$val[1]][$val[0]]=$val[2];
	}
	$diff0=array_values(array_slice($axis0,0,-1));
	$diff1=array_values(array_slice($axis0,1));
	$axis2=array();
	foreach($diff0 as $key=>$val) {
		$val2=$diff1[$key];
		$key2=$val." - ".$val2;
		$axis2[]=$key2;
		foreach($matrix as $key3=>$val3) {
			if(is_numeric($val3[$val2]) && is_numeric($val3[$val])) {
				$matrix[$key3][$key2]=$val3[$val2]-$val3[$val];
			} else {
				$matrix[$key3][$key2]="";
			}
		}
	}
	foreach($matrix as $key=>$val) {
		$temp=explode("-",$key);
		$matrix[$key][$key]=$textos["meses"][$lang][$temp[1]]."\\n".$temp[0];
	}
	array_unshift($matrix,array_merge(array("Mes"),$axis0,$axis2));
	export_file("middle/plot08${lang}.csv",$matrix);
	$cols2plot1=array();
	for($i=0;$i<count($axis0);$i++) {
		$col=$i+2;
		$cols2plot1[]="u ${col}:xtic(1) ti col";
	}
	$cols2plot1=implode(", '' ",$cols2plot1);
	$cols2plot2=array();
	for($i=0;$i<count($axis2);$i++) {
		$col=$i+2+count($axis0);
		$cols2plot2[]="u ${col}:xtic(1) ti col";
	}
	$cols2plot2=implode(", '' ",$cols2plot2);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["08"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set style histogram gap 3",
		"set ytic center rotate by 90",
		"set ytics 0,10000,50000",
		"set datafile separator ';'",
		"set output 'output/plot08${lang}1.png'",
		"set xrange [-0.5:11.5]",
		"plot 'middle/plot08${lang}.csv' ${cols2plot1}",
		"set output 'output/plot08${lang}2.png'",
		"set xrange [11.5:23.5]",
		"plot 'middle/plot08${lang}.csv' ${cols2plot1}",
		"set output 'output/plot08${lang}3.png'",
		"set xrange [23.5:35.5]",
		"plot 'middle/plot08${lang}.csv' ${cols2plot1}",
		"set label 1 \"".$textos["escala"][$lang]."\" at 15.5,9000 c tc lt 1",
		"set yrange [0:10000]",
		"set ytics 0,2000,8000",
		"set xtic rotate by -45",
		"set output 'output/plot08${lang}4.png'",
		"set xrange [3.5:27.5]",
		"set bmargin 5",
		"plot 'middle/plot08${lang}.csv' ${cols2plot2}",
	))."\n";
	file_put_contents("middle/plot08${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot08${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot09${lang}01.gif")) {
	console_debug("output/plot09${lang}01.gif");
	$files=glob("middle/euromomo.????????.csv");
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
		$gnuplot.=implode("\n",array(
		))."\n";
		file_put_contents("middle/plot09${lang}.${part}.gnu",$gnuplot);
		passthru("gnuplot middle/plot09${lang}.${part}.gnu 2>&1");
	}
	for($i=0;$i<count(glob("output/plot09${lang}??.${part}.png"));$i++) {
		$j=sprintf("%02d",$i+1);
		passthru("convert -delay 50 output/plot09${lang}${j}.????????.png output/plot09${lang}${j}.gif 1>/dev/null 2>/dev/null &");
		for($j=0;$j<300;$j++) {
			ob_start();
			passthru("ps uxaw|grep -v grep|grep convert|wc -l");
			$num=trim(ob_get_clean());
			if($num<4) break;
			usleep(100000);
		}
	}
	for($j=0;$j<300;$j++) {
		ob_start();
		passthru("ps uxaw|grep -v grep|grep convert|wc -l");
		$num=trim(ob_get_clean());
		if($num<1) break;
		usleep(100000);
	}
	console_debug();
}

if(!file_exists("output/plot10${lang}.png")) {
	console_debug("output/plot10${lang}.png");
	$files=glob("input/sweden/*.csv");
	rsort($files);
	$sweden=import_file($files[0]);
	$months=array(
		"januari"=>1,
		"februari"=>2,
		"mars"=>3,
		"april"=>4,
		"maj"=>5,
		"juni"=>6,
		"juli"=>7,
		"augusti"=>8,
		"september"=>9,
		"oktober"=>10,
		"november"=>11,
		"december"=>12,
	);
	$header=array_shift($sweden);
	foreach($sweden as $key=>$val) {
		$temp=explode(" ",$val[0]." 2020");
		$temp[1]=$months[$temp[1]];
		$val[0]=sprintf("%04d-%02d-%02d",$temp[2],$temp[1],$temp[0]);
		foreach($val as $key2=>$val2) if($val2=="0") $val[$key2]="";
		$sweden[$key]=$val;
	}
	array_unshift($sweden,$header);
	export_file("middle/plot10${lang}.csv",$sweden);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["10"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:500]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,100,400",
		"set datafile separator ';'",
		"set output 'output/plot10${lang}.png'",
		"plot 'middle/plot10${lang}.csv' u 1:2 w l ti col,'' u 1:3 w l ti col,'' u 1:4 w l ti col,'' u 1:5 w l ti col,'' u 1:6 w l ti col,'' u 1:7 w l lc 7 ti col",
	))."\n";
	file_put_contents("middle/plot10${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot10${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot11${lang}.png")) {
	console_debug("output/plot11${lang}.png");
	$files=glob("input/norway/*.csv");
	rsort($files);
	$norway=import_file($files[0]);
	foreach($norway as $key=>$val) {
		unset($val[0]);
		for($i=2;$i<=16;$i++) unset($val[$i]);
		$norway[$key]=$val;
	}
	$header=array_shift($norway);
	foreach($header as $key=>$val) {
		$val=str_replace("Deaths ","",$val);
		$header[$key]=$val;
	}
	foreach($norway as $key=>$val) {
		$val[1]=sprintf("%02d",str_replace("Week ","",$val[1]));
		$val[1]=date("Y-m-d",strtotime("2020W".$val[1])+86400*2);
		foreach($val as $key2=>$val2) if($val2=="0") $val[$key2]="";
		$norway[$key]=$val;
	}
	array_unshift($norway,$header);
	export_file("middle/plot11${lang}.csv",$norway);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["11"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:1500]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,200,1400",
		"set datafile separator ';'",
		"set output 'output/plot11${lang}.png'",
		"plot 'middle/plot11${lang}.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp lc 7 ti col",
	))."\n";
	file_put_contents("middle/plot11${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot11${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot12${lang}.png")) {
	console_debug("output/plot12${lang}.png");
	$momonew=import_file("middle/datanew-ok2.csv");
	$matrix=array();
	for($i=strtotime("2020-01-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
		$fecha=date("Y-m-d",$i);
		$i=strtotime($fecha." 12:00:00");
		$matrix[$fecha]=array($fecha,"","","");
	}
	foreach($momonew as $key=>$val) {
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
		unset($momonew[$key]);
	}
	array_unshift($matrix,array("Fecha","2020","2019","2018"));
	export_file("middle/plot12${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["12"][$lang]."\"",
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
		"set output 'output/plot12${lang}.png'",
		"plot 'middle/plot12${lang}.csv' u 1:4 w l ti col,'' u 1:3 w l ti col,'' u 1:2 w l ti col",
	))."\n";
	file_put_contents("middle/plot12${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot12${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot13${lang}.png")) {
	console_debug("output/plot13${lang}.png");
	$files=glob("input/portugal/*.csv");
	rsort($files);
	$portugal=import_file($files[0]);
	$months=array(
		"Jan"=>1,
		"Fev"=>2,
		"Mar"=>3,
		"Abr"=>4,
		"Mai"=>5,
		"Jun"=>6,
		"Jul"=>7,
		"Ago"=>8,
		"Set"=>9,
		"Out"=>10,
		"Nov"=>11,
		"Dez"=>12,
	);
	$header=array_shift($portugal);
	foreach($portugal as $key=>$val) {
		$temp=explode("-",$val[0]."-2020");
		$temp[0]=$months[$temp[0]];
		$val[0]=sprintf("%04d-%02d-%02d",$temp[2],$temp[0],$temp[1]);
		//~ foreach($val as $key2=>$val2) if($val2=="0") $val[$key2]="";
		$portugal[$key]=$val;
	}
	array_unshift($portugal,$header);
	export_file("middle/plot13${lang}.csv",$portugal);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["13"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:700]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,100,600",
		"set datafile separator ';'",
		"set output 'output/plot13${lang}.png'",
		"plot 'middle/plot13${lang}.csv' u 1:8 w l ti col,'' u 1:9 w l ti col,'' u 1:10 w l ti col,'' u 1:11 w l ti col,'' u 1:12 w l ti col,'' u 1:13 w l lc 7 ti col",
	))."\n";
	file_put_contents("middle/plot13${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot13${lang}.gnu 2>&1");
	console_debug();
}

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
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
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
		"set key at 2020,300000",
		"set output 'output/plot14${lang}.png'",
		"plot 'middle/plot14${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w lp ti col, '' u 1:5 w lp ti col, '' u 1:6 w lp ti col, '' u 1:7 w lp ti col, '' u 1:8 w lp ti col, '' u 1:9 w lp ti col, '' u 1:10 w lp ti col",
	))."\n";
	file_put_contents("middle/plot14${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot14${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot15${lang}.gif")) {
	console_debug("output/plot15${lang}.gif");
	$momonew=import_file("middle/datanew-ok2.csv");
	$files=glob("middle/data.????????.csv");
	foreach($files as $file) {
		$part=explode(".",$file);
		$part=$part[1];
		if(file_exists("output/plot15${lang}.${part}.png")) continue;
		$momo=import_file($file);
		if(!isset($otros)) $otros=import_file("middle/7947-ok.csv");
		$matrix=array();
		for($i=strtotime("2020-10-01 12:00:00");$i<=strtotime("2021-12-01 12:00:00");$i+=86400) {
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
		array_unshift($matrix,array("Fecha","MoMo2020","MoMo2019","MoMo2018","INE2018"));
		export_file("middle/plot15${lang}.${part}.csv",$matrix);
		$fecha=substr($part,0,4)."-".substr($part,4,2)."-".substr($part,6,2);
		$gnuplot=implode("\n",array(
			"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
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
			"set xtics '2020-01-06',86400*7,'2021-01-01'",
			"set ytic center rotate by 90",
			"set ytics 0,500,3000",
			"set datafile separator ';'",
			"set output 'output/plot15${lang}.${part}.png'",
			"set xrange ['2020-10-01':'2020-12-01']",
			"plot 'middle/plot15${lang}.${part}.csv' u 1:2 w lp lc 2 pt 2 ti col, '' u 1:3 w lp lc 3 pt 3 ti col, '' u 1:4 w lp lc 4 pt 4 ti col, '' u 1:5 w l lc 9 ti col",
		))."\n";
		file_put_contents("middle/plot15${lang}.${part}.gnu",$gnuplot);
		passthru("gnuplot middle/plot15${lang}.${part}.gnu 2>&1");
	}
	passthru("convert -delay 50 output/plot15${lang}.????????.png output/plot15${lang}.gif 1>/dev/null 2>/dev/null");
	console_debug();
}

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
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
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
		"set output 'output/plot16${lang}.png'",
		"plot 'middle/plot16${lang}.csv' u 1:4 w l ti col,'' u 1:3 w l ti col,'' u 1:2 w l ti col",
	))."\n";
	file_put_contents("middle/plot16${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot16${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("output/plot17${lang}.png")) {
	console_debug("output/plot17${lang}.png");
	$files=glob("input/germany/*.csv");
	rsort($files);
	$germany=import_file($files[0]);
	foreach($germany as $key=>$val) {
		unset($val[6]);
		$germany[$key]=$val;
	}
	$header=array_shift($germany);
	foreach($germany as $key=>$val) {
		$val[0]=sprintf("%02d",$val[0]);
		$val[0]=date("Y-m-d",strtotime("2020W".$val[0])+86400*2);
		$germany[$key]=$val;
	}
	array_unshift($germany,$header);
	export_file("middle/plot17${lang}.csv",$germany);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"]["17"][$lang]."\"",
		"set grid",
		"set tmargin 3",
		"set rmargin 6",
		"set bmargin 3",
		"set lmargin 6",
		"set auto x",
		"set yrange [0:35000]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtics '2020-02-01',86400*30,'2020-12-01'",
		"set ytic center rotate by 90",
		"set ytics 0,5000,30000",
		"set datafile separator ';'",
		"set output 'output/plot17${lang}.png'",
		"plot 'middle/plot17${lang}.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col",
	))."\n";
	file_put_contents("middle/plot17${lang}.gnu",$gnuplot);
	passthru("gnuplot middle/plot17${lang}.gnu 2>&1");
	console_debug();
}

if(!file_exists("index.${lang}.html")) {
	console_debug("index.${lang}.html");
	$html=implode("\n",array(
		"<!DOCTYPE html>",
		"<html>",
		"<head>",
		"<title>".$textos["header"][$lang]."</title>",
		"<style>",
		"body { font-family:Arial,Helvetica,sans-serif; }",
		"div { width:100%; max-width:1200px; margin: 0 auto; }",
		"img { width:100%; }",
		"h3 { text-align: center; padding:1em; background:#2c3e50; color:#fff; font-size:1em; }",
		"h3.norm { clear:both; }",
		"h3.lang { float:right; margin-left:1em; }",
		"h3.warn { background:#ea4335; }",
		"a { color:#fff; }",
		"</style>",
		"</head>",
		"<body>",
		"<div>",
	))."\n";
	foreach(array("en","es","ca") as $temp) {
		$html.=implode("\n",array(
			"<h3 class='lang'><a href='index.${temp}.html'>".strtoupper($temp)."</a></h4>",
		))."\n";
	}
	$html.=implode("\n",array(
		"<h3 class='norm'>".$textos["header"][$lang]."</h3>",
		"<h3 class='warn'>".$textos["momoold"][$lang]."</h3>",
	))."\n";
	foreach($textos["plots"] as $key=>$val) {
		$html.=implode("\n",array(
			"<h3>".$val[$lang]."</h3>",
			"<a name='plot${key}'></a>",
		))."\n";
		$imgs=array();
		$imgs=array_merge($imgs,glob("output/plot${key}${lang}.png"));
		$imgs=array_merge($imgs,glob("output/plot${key}${lang}?.png"));
		$imgs=array_merge($imgs,glob("output/plot${key}${lang}??.png"));
		$imgs=array_merge($imgs,glob("output/plot${key}${lang}.gif"));
		$imgs=array_merge($imgs,glob("output/plot${key}${lang}?.gif"));
		$imgs=array_merge($imgs,glob("output/plot${key}${lang}??.gif"));
		foreach($imgs as $img) {
			$html.=implode("\n",array(
				"<img src='${img}'/>",
			))."\n";
		}
	}
	$html.=implode("\n",array(
		"<h3>".$textos["footer"][$lang].": <a href='https://github.com/josepsanzcamp/covid19/'>https://github.com/josepsanzcamp/covid19/</a></h3>",
		"</div>",
		"</body>",
		"</html>",
	))."\n";
	file_put_contents("index.${lang}.html",$html);
	console_debug();
}

}

if(!file_exists("index.html")) {
	console_debug("index.html");
	$html=implode("\n",array(
		"<!DOCTYPE html>",
		"<html>",
		"<head>",
		"<title>".$textos["header"]["ca"]."</title>",
		"<style>",
		"body { font-family:Arial,Helvetica,sans-serif; }",
		"div { width:100%; max-width:1200px; margin: 0 auto; }",
		"img { width:100%; }",
		"h3 { text-align: center; padding:1em; background:#2c3e50; color:#fff; font-size:1em; }",
		"h3.norm { clear:both; }",
		"h3.lang { float:right; margin-left:1em; }",
		"h3.warn { background:#ea4335; }",
		"a { color:#fff; }",
		"</style>",
		"</head>",
		"<body>",
		"<div>",
	))."\n";
	foreach(array("en","es","ca") as $lang) {
		$html.=implode("\n",array(
			"<h3 class='lang'><a href='index.${lang}.html'>".strtoupper($lang)."</a></h3>",
		))."\n";
	}
	foreach(array("ca","es","en") as $lang) {
		$html.=implode("\n",array(
			"<h3 class='norm'><a href='index.${lang}.html'>".$textos["header"][$lang]."</a></h3>",
			"<h3>".$textos["footer"][$lang].": <a href='https://github.com/josepsanzcamp/covid19/'>https://github.com/josepsanzcamp/covid19/</a></h3>",
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
	console_debug();
}

?>