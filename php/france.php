<?php

if (!file_exists("middle/dc_20xx_det.csv")) {
    console_debug("middle/dc_20xx_det.csv");
    passthru("lbzcat input/france/DC_20*.csv.bz2 |
        cut -d';' -f-3 |
        tr ';' '-' |
        sort |
        uniq -c |
        gawk '{print $2\";\"$1}'|
        grep -v ADEC > middle/dc_20xx_det.csv");
    console_debug();
}
