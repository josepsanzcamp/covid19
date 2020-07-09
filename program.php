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

if(!file_exists("middle/datanew.csv")) {
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
}

if(!file_exists("middle/datanew-ok.csv")) {
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
}

if(!file_exists("middle/datanew-ok2.csv")) {
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
}

if(!file_exists("middle/datanew-ok3.csv")) {
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
}

if(!file_exists("middle/datanew-ok4.csv")) {
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
}

if(!file_exists("middle/datanew-ok5.csv")) {
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
}

if(!file_exists("middle/datanew-ok6.csv")) {
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

if(!file_exists("middle/dataold.csv")) {
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
}

if(!file_exists("middle/dataold-ok.csv")) {
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
}

if(!file_exists("middle/dataold-ok2.csv")) {
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
}

if(!file_exists("middle/dataold-ok3.csv")) {
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
}

if(!file_exists("middle/dataold-ok5.csv")) {
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
}

if(!file_exists("middle/datanew-ok7.csv")) {
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
}

if(!file_exists("middle/euromomo.csv")) {
	$files=glob("input/euromomo/component.????????.js");
	rsort($files);
	$buffer=file_get_contents($files[0]);
	$pos=strrpos($buffer,"JSON.parse");
	if($pos===false) die("ERROR 5");
	$pos=strpos($buffer,"{",$pos);
	if($pos===false) die("ERROR 6");
	$pos2=strpos($buffer,"}')",$pos);
	$buffer=substr($buffer,$pos,$pos2-$pos+1);
	$json=json_decode($buffer,true);
	$weeks=$json["weeks"];
	$matrix=array();
	foreach($json["pooled"] as $key=>$val) {
		foreach($val as $key2=>$val2) {
			$group=$val2["group"];
			unset($val2["group"]);
			foreach($val2 as $key3=>$val3) {
				foreach($val3 as $key4=>$val4) {
					$matrix[]=array("pooled","",$group,$key3,$weeks[$key4],$val4);
				}
			}
		}
	}
	foreach($json["countries"] as $key=>$val) {
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
	export_file("middle/euromomo.csv",$matrix);
}

if(!file_exists("middle/euromomo-ok.csv")) {
	$data=import_file("middle/euromomo.csv");
	$momoold=import_file("middle/dataold-ok2.csv");
	$momonew=import_file("middle/datanew-ok2.csv");
	$fechas=array();
	$columnas=array();
	foreach($data as $key=>$val) {
		if($val[2]!="Total") unset($data[$key]);
	}
	foreach($data as $key=>$val) {
		$fechas[$val[4]]=$val[4];
		if($val[0]=="pooled") $columnas[$val[3]]=$val[3];
		if($val[0]=="countries") $columnas[$val[1]]=$val[1];
	}
	$columnas["MoMoOld"]="MoMoOld";
	$columnas["MoMoNew"]="MoMoNew";
	$matrix=array(array_merge(array(""),$columnas));
	foreach($fechas as $key=>$val) {
		$matrix[$val][$val]=$val;
		foreach($columnas as $key2=>$val2) {
			$matrix[$val][$val2]="";
		}
	}
	foreach($data as $key=>$val) {
		if($val[0]=="pooled") {
			if(!isset($matrix[$val[4]][$val[3]])) die("ERROR 7");
			$matrix[$val[4]][$val[3]]=$val[5];
		}
		if($val[0]=="countries") {
			if(!isset($matrix[$val[4]][$val[1]])) die("ERROR 8");
			$matrix[$val[4]][$val[1]]=$val[5];
		}
	}
	$sumas=array();
	foreach($momoold as $key=>$val) {
		$key2="MoMoOld";
		$key3=date("o-W",strtotime($val[0]));
		if(isset($fechas[$key3])) {
			$key4=$key2."-".$key3;
			if(!isset($sumas[$key4])) $sumas[$key4]=array($key2,$key3,0);
			$sumas[$key4][2]+=$val[1];
		}
	}
	foreach($momonew as $key=>$val) {
		$key2="MoMoNew";
		$key3=date("o-W",strtotime($val[0]));
		if(isset($fechas[$key3])) {
			$key4=$key2."-".$key3;
			if(!isset($sumas[$key4])) $sumas[$key4]=array($key2,$key3,0);
			$sumas[$key4][2]+=$val[1];
		}
	}
	foreach($sumas as $key=>$val) {
		if(!isset($matrix[$val[1]][$val[0]])) die("ERROR 9");
		$matrix[$val[1]][$val[0]]=$val[2];
	}
	foreach($matrix as $key=>$val) {
		if(isset($fechas[$key]) && implode("",$val)==$key) {
			unset($matrix[$key]);
		}
	}
	export_file("middle/euromomo-ok.csv",$matrix);
}

$textos=array(
	"header"=>array(
		"ca"=>"Informació útil d'Espanya sobre l'impacte de covid-19: gràfics de defuncions per any, origen de les dades, acumulats diaris, per edat, per comunitat autònoma i més",
		"es"=>"Información útil de España sobre el impacto de covid-19: gráficos de defunciones por año, origen de los datos, acumulados diarios, por edad, por comunidad autónoma y más",
		"en"=>"Useful Spain information about the covid-19 impact: Graphs of deaths by year, origin of the data, daily accumulated, by age, by autonomous community, and more",
	),
	"plots"=>array(
		1=>array(
			"ca"=>"1. Defuncions per any i mes (només anys on algun mes ha superat els 40k morts, les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"1. Defunciones por año y mes (sólo años donde algún mes ha superado los 40k muertos, los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"1. Deaths by year and month (only years where some month has exceeded 40k deaths, 2020 data are from the MoMo and the rest are from the INE)",
		),array(
			"ca"=>"2. Defuncions per any i mes del MoMo i INE entre 2018 i 2020",
			"es"=>"2. Defunciones por año y mes del MoMo y INE entre 2018 y 2020",
			"en"=>"2. Deaths by year and month of the MoMo and INE between 2018 and 2020",
		),array(
			"ca"=>"3. Defuncions per dia obtinguts del MoMo per al 2020 i el promig del 2018",
			"es"=>"3. Defunciones por dia obtenidos del MoMo para el 2020 y el promedio del 2018",
			"en"=>"3. Deaths per day obtained from the MoMo by 2020 and the 2018 average",
		),array(
			"ca"=>"4. Defuncions per any, mes i edat (les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"4. Defunciones por año, mes y edad (los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"4. Deaths by year, month and age (2020 data are from MoMo and the rest are from INE)",
		),array(
			"ca"=>"5. Defuncions per comunitat autònoma i any (acumulats per any de març i abril, les dades de l'any 2020 són del MoMo i la resta són del INE)",
			"es"=>"5. Defunciones por comunidad autónoma y año (acumulados por año de marzo y abril, los datos del 2020 son del MoMo y el resto son del INE)",
			"en"=>"5. Deaths by autonomous community and year (accumulated by year of March and April, the data for 2020 are from the MoMo and the rest are from the INE)",
		),array(
			"ca"=>"6. Places de residències per tipus i comunitat autònoma (dades obtingudes de envejecimientoenred.es, del CSIC del 2019)",
			"es"=>"6. Plazas de residencias por tipo y comunidad autónoma (datos obtenidos de envejecimientoenred.es, del CSIC del 2019)",
			"en"=>"6. Places of residences by type and autonomous community (data obtained from envejecimientoenred.es, from the CSIC of 2019)",
		),array(
			"ca"=>"7. Relació de llits de hospital i infermeres per país en 2016 segons dades OECD",
			"es"=>"7. Relación de camas de hospital y enfermeras por país en 2016 segun datos OECD",
			"en"=>"7. Relation of hospital beds and nurses by country in 2016 according to OECD data",
		),array(
			"ca"=>"8. Defuncions per any i mes del MoMo segons la data de descarrega del fitxer de dades i diferencia entre cada fitxer",
			"es"=>"8. Defunciones por año i mes del MoMo según la fecha de descarga del fichero de datos y diferencia entre cada fichero",
			"en"=>"8. Deaths by year and month of the MoMo related to the download date of the data file and difference between each file",
		),array(
			"ca"=>"9. Defuncions per setmana del any y per pais obtingudes del EuroMoMo (el valor que es mostra es el zscore)",
			"es"=>"9. Defunciones por semana del año y por país obtenidas del EuroMoMo (el valor que se muestra es el zscore)",
			"en"=>"9. Deaths by week of year and by country obtained from the EuroMoMo (the value used to plot is the zscore)",
		),array(
			"ca"=>"10. Defuncions per dia obtinguts del Statistics Sweden",
			"es"=>"10. Defunciones por dia obtenidos del Statistics Sweden",
			"en"=>"10. Deaths by day obtained from Statistics Sweden",
		),array(
			"ca"=>"11. Defuncions per dia obtinguts del Statistics Norway",
			"es"=>"11. Defunciones por dia obtenidos del Statistics Norway",
			"en"=>"11. Deaths by day obtained from Statistics Norway",
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
);

foreach(array("ca","es","en") as $lang) {

if(!file_exists("output/plot1${lang}1.png")) {
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
	export_file("middle/plot1${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][1][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set style histogram gap 3",
		"set datafile separator ';'",
		"set output 'output/plot1${lang}1.png'",
		"plot [-0.5:5.5] 'middle/plot1${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
		"set output 'output/plot1${lang}2.png'",
		"plot [5.5:11.5] 'middle/plot1${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot1${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot1${lang}.gnu");
}

if(!file_exists("output/plot2${lang}1.png")) {
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
		$matrix[$key]=array_merge(array($textos["meses"][$lang][$temp[1]]." ".$temp[0]),$val);
	}
	array_unshift($matrix,array_merge(array("Mes"),$header));
	export_file("middle/plot2${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][2][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"set output 'output/plot2${lang}1.png'",
		"plot [-0.5:11.5] 'middle/plot2${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"set output 'output/plot2${lang}2.png'",
		"plot [11.5:23.5] 'middle/plot2${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
		"set output 'output/plot2${lang}3.png'",
		"plot [23.5:35.5] 'middle/plot2${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot2${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot2${lang}.gnu");
}

if(!file_exists("output/plot3${lang}1.png")) {
	$momoold=import_file("middle/dataold-ok2.csv");
	$momonew=import_file("middle/datanew-ok2.csv");
	$otros=import_file("middle/7947-ok.csv");
	$matrix=array();
	for($i=strtotime("2020-01-01 12:00:00");$i<strtotime("2020-09-01");$i+=86400) {
		$fecha=date("Y-m-d",$i);
		$matrix[$fecha]=array($fecha,"","","");
	}
	foreach($momoold as $key=>$val) {
		if(isset($matrix[$val[0]])) $matrix[$val[0]][1]=$val[1];
		unset($momoold[$key]);
	}
	foreach($momonew as $key=>$val) {
		if(isset($matrix[$val[0]])) $matrix[$val[0]][2]=$val[1];
		unset($momonew[$key]);
	}
	foreach($otros as $key=>$val) {
		$year=$val[0];
		if($year!=2018) continue;
		$media=round($val[1]/365,0);
		foreach($matrix as $key2=>$val2) {
			$matrix[$key2][3]=$media;
		}
	}
	array_unshift($matrix,array("Fecha","MoMoOld","MoMoNew",2018));
	export_file("middle/plot3${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][3][$lang]."\"",
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
		"set output 'output/plot3${lang}1.png'",
		"plot ['2020-01-01':'2020-03-01'] 'middle/plot3${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col",
		"set output 'output/plot3${lang}2.png'",
		"plot ['2020-03-01':'2020-05-01'] 'middle/plot3${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col",
		"set output 'output/plot3${lang}3.png'",
		"plot ['2020-05-01':'2020-07-01'] 'middle/plot3${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col",
		"set output 'output/plot3${lang}4.png'",
		"plot ['2020-07-01':'2020-09-01'] 'middle/plot3${lang}.csv' u 1:2 w lp ti col, '' u 1:3 w lp ti col, '' u 1:4 w l lc 9 ti col",
	))."\n";
	file_put_contents("middle/plot3${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot3${lang}.gnu");
}

if(!file_exists("output/plot4${lang}1.png")) {
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
	export_file("middle/plot4${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][4][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"set output 'output/plot4${lang}1.png'",
		"plot [-0.5:11.5] 'middle/plot4${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col",
		"set yrange [0:20000]",
		"set label 1 \"".$textos["escala"][$lang]."\" at 5.5,17500 c tc lt 1",
		"set output 'output/plot4${lang}2.png'",
		"plot [-0.5:11.5] 'middle/plot4${lang}.csv' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col",
		"set output 'output/plot4${lang}3.png'",
		"plot [-0.5:11.5] 'middle/plot4${lang}.csv' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col, '' u 13:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot4${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot4${lang}.gnu");
}

if(!file_exists("output/plot5${lang}1.png")) {
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
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][5][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:30000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"set output 'output/plot5${lang}1.png'",
		"plot [-0.5:5.5] 'middle/plot5${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"set output 'output/plot5${lang}2.png'",
		"plot [5.5:11.5] 'middle/plot5${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
		"set output 'output/plot5${lang}3.png'",
		"plot [11.5:17.5] 'middle/plot5${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col, '' u 5:xtic(1) ti col, '' u 6:xtic(1) ti col, '' u 7:xtic(1) ti col, '' u 8:xtic(1) ti col, '' u 9:xtic(1) ti col, '' u 10:xtic(1) ti col, '' u 11:xtic(1) ti col, '' u 12:xtic(1) ti col",
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
		"set title \"".$textos["plots"][6][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"set output 'output/plot6${lang}.png'",
		"plot 'middle/plot6${lang}.csv' u 2:xtic(1) ti col, '' u 3:xtic(1) ti col, '' u 4:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot6${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot6${lang}.gnu");
}

if(!file_exists("output/plot7${lang}1.png")) {
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
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][7][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set auto y",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"set output 'output/plot7${lang}1.png'",
		"plot 'middle/plot7${lang}1.csv' u 2:xtic(1) ti col",
		"set output 'output/plot7${lang}2.png'",
		"plot 'middle/plot7${lang}2.csv' u 2:xtic(1) ti col",
	))."\n";
	file_put_contents("middle/plot7${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot7${lang}.gnu");
}

if(!file_exists("output/plot8${lang}1.png")) {
	$data=import_file("middle/datanew-ok7.csv");
	$axis0=array();
	$axis1=array();
	foreach($data as $key=>$val) {
		if(!isset($axis0[$val[0]])) $axis0[$val[0]]=$val[0];
		if(!isset($axis1[$val[1]])) $axis1[$val[1]]=$val[1];
	}
	$matrix=array();
	foreach($axis1 as $key=>$val) {
		$matrix[$val][$val]=$val;
		foreach($axis0 as $key2=>$val2) {
			$matrix[$val][$val2]="";
		}
	}
	foreach($data as $key=>$val) {
		if($matrix[$val[1]][$val[0]]!="") die("ERROR 4");
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
		$matrix[$key][$key]=$textos["meses"][$lang][$temp[1]]." ".$temp[0];
	}
	array_unshift($matrix,array_merge(array("Mes"),$axis0,$axis2));
	export_file("middle/plot8${lang}.csv",$matrix);
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
		"set title \"".$textos["plots"][8][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:60000]",
		"set style data histogram",
		"set style fill solid border -1",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set style histogram gap 3",
		"set output 'output/plot8${lang}1.png'",
		"plot [-0.5:13.5] 'middle/plot8${lang}.csv' ${cols2plot1}",
		"set output 'output/plot8${lang}2.png'",
		"plot [13.5:27.5] 'middle/plot8${lang}.csv' ${cols2plot1}",
		"set label 1 \"".$textos["escala"][$lang]."\" at 12,9000 c tc lt 1",
		"set yrange [0:10000]",
		"set output 'output/plot8${lang}3.png'",
		"plot [0.5:24.5] 'middle/plot8${lang}.csv' ${cols2plot2}",
	))."\n";
	file_put_contents("middle/plot8${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot8${lang}.gnu");
}

if(!file_exists("output/plot9${lang}01.png")) {
	$data=import_file("middle/euromomo.csv");
	$paises=array();
	$años=array();
	$semanas=array();
	foreach($data as $key=>$val) {
		if($val[0]=="countries" && $val[2]=="Total" && $val[3]=="zscore") {
			$paises[$val[1]]=$val[1];
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
			if(!isset($matrix[$temp[1]][$val[1]."-".$temp[0]])) die("ERROR 7");
			$matrix[$temp[1]][$val[1]."-".$temp[0]]=$val[5];
		}
	}
	foreach($matrix as $key=>$val) {
		$key2=date("Y-m-d",strtotime("2020W".$key)+86400*2);
		$matrix[$key]=array_merge(array($key2),$val);
	}
	array_unshift($matrix,array_merge(array("Fecha"),$header));
	export_file("middle/plot9${lang}.csv",$matrix);
	$gnuplot=implode("\n",array(
		"set terminal pngcairo size 1200,600 enhanced font 'Segoe UI,10'",
		"set title \"".$textos["plots"][9][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [-10:50]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set xtics '2020-01-01',86400*30,'2021-01-01'",
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
			"set output 'output/plot9${lang}${j}.png'",
			"plot 'middle/plot9${lang}.csv' u 1:${col2} w lp ti col,'' u 1:${col3} w lp ti col,'' u 1:${col4} w lp ti col,'' u 1:${col5} w lp ti col,'' u 1:${col6} w lp ti col,'' u 1:${col7} w lp lc 7 ti col",
		))."\n";
	}
	$gnuplot.=implode("\n",array(
	))."\n";
	file_put_contents("middle/plot9${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot9${lang}.gnu");
}

if(!file_exists("output/plot10${lang}.png")) {
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
		"set title \"".$textos["plots"][10][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:500]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set xtics '2020-01-01',86400*30,'2021-01-01'",
		"set output 'output/plot10${lang}.png'",
		"plot 'middle/plot10${lang}.csv' u 1:2 w l ti col,'' u 1:3 w l ti col,'' u 1:4 w l ti col,'' u 1:5 w l ti col,'' u 1:6 w l ti col,'' u 1:7 w l lc 7 ti col",
	))."\n";
	file_put_contents("middle/plot10${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot10${lang}.gnu");
}

if(!file_exists("output/plot11${lang}.png")) {
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
		"set title \"".$textos["plots"][11][$lang]."\"",
		"set rmargin 3",
		"set grid",
		"set auto x",
		"set yrange [0:1500]",
		"set xdata time",
		"set timefmt '%Y-%m-%d'",
		"set format x '%Y-%m-%d'",
		"set xrange ['2020-01-01':'2021-01-01']",
		"set xtic rotate by -45 scale 0",
		"set datafile separator ';'",
		"set xtics '2020-01-01',86400*30,'2021-01-01'",
		"set output 'output/plot11${lang}.png'",
		"plot 'middle/plot11${lang}.csv' u 1:2 w lp ti col,'' u 1:3 w lp ti col,'' u 1:4 w lp ti col,'' u 1:5 w lp ti col,'' u 1:6 w lp ti col,'' u 1:7 w lp lc 7 ti col",
	))."\n";
	file_put_contents("middle/plot11${lang}.gnu",$gnuplot);
	exec("gnuplot middle/plot11${lang}.gnu");
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
			"<a name='plot${key}'></a>",
			"<h3>".$val[$lang]."</h3>",
		))."\n";
		$imgs=glob("output/plot${key}${lang}*.png");
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
}

?>
