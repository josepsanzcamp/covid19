<?php

if(!file_exists("middle/preliminar_statistik.csv")) {
	console_debug("middle/preliminar_statistik.csv");
	passthru("xlsxio_xlsx2csv input/sweden/preliminar_statistik_over_doda_inkl_eng.xlsx 1>/dev/null 2>/dev/null");
	$matrix=import_file("input/sweden/preliminar_statistik_over_doda_inkl_eng.xlsx.Tabell 1.csv");
	$run=0;
	foreach($matrix as $key=>$val) {
		if($val[0]=="DagMånad") {
			$run=1;
		} elseif($run && $val[11]=="9999") {
			$run=0;
		}
		if($run) {
			$matrix[$key]=array_slice($val,0,8);
		} else {
			unset($matrix[$key]);
		}
	}
	$files=glob("input/sweden/preliminar_statistik_over_doda_inkl_eng.xlsx.*.csv");
	foreach($files as $file) unlink($file);
	export_file("middle/preliminar_statistik.csv",$matrix);
	unset($matrix);
	console_debug();
}

?>