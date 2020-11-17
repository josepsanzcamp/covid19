<?php

if(!file_exists("middle/demo_r_mwk_ts.csv")) {
	console_debug("middle/demo_r_mwk_ts.csv");
	$files=glob("input/eurostat/demo_r_mwk_ts.*.tsv.gz");
	rsort($files);
	$buffer=get_file($files[0]);
	$buffer=str_replace("\t",";",$buffer);
	file_put_contents("middle/demo_r_mwk_ts.csv",$buffer);
	console_debug();
}

?>