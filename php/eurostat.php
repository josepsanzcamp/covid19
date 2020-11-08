<?php

if(!file_exists("middle/demo_r_mwk_ts.csv")) {
	console_debug("middle/demo_r_mwk_ts.csv");
	$buffer=file_get_contents("input/eurostat/demo_r_mwk_ts.tsv");
	$buffer=str_replace("\t",";",$buffer);
	file_put_contents("middle/demo_r_mwk_ts.csv",$buffer);
	console_debug();
}

?>