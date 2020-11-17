<?php

if(!file_exists("middle/dc_20xx_det.csv")) {
	console_debug("middle/dc_20xx_det.csv");
	passthru("zcat input/france/DC_20??_det.csv.gz | cut -d';' -f-3 | tr ';' '-' | uniq -c | gawk '{print $2\";\"$1}'| grep -v ADEC > middle/dc_20xx_det.csv");
	console_debug();
}

?>