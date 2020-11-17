<?php

if(!file_exists("middle/demo_r_mwk_ts.csv")) {
	console_debug("middle/demo_r_mwk_ts.csv");
	$buffer=get_file("input/eurostat/demo_r_mwk_ts.tsv.gz");
	$buffer=str_replace("\t",";",$buffer);
	file_put_contents("middle/demo_r_mwk_ts.csv",$buffer);
	unset($buffer);
	console_debug();
}

?>