<?php

if (!file_exists("output/plot17${lang}.png")) {
    console_debug("output/plot17${lang}.png");
    $germany = import_file("middle/sterbefallzahlen.csv");
    foreach ($germany as $key => $val) {
        unset($val[2]);
        unset($val[3]);
        unset($val[4]);
        unset($val[5]);
        unset($val[6]);
        unset($val[7]);
        unset($val[8]);
        unset($val[9]);
        unset($val[14]);
        unset($val[16]);
        unset($val[18]);
        unset($val[20]);
        $germany[$key] = array_values($val);
    }
    $header = array_shift($germany);
    foreach ($germany as $key => $val) {
        $val[0] = sprintf("%02d", $val[0]);
        $val[0] = date("Y-m-d", strtotime("2020W" . $val[0]) + 86400 * 2);
        $germany[$key] = $val;
    }
    foreach ($header as $key => $val) {
        if (substr($val, 0, 1) == "D" && substr($val, -4, 4) == "_Ins") {
            $header[$key] = substr($val, 1, -4);
        }
    }
    array_unshift($germany, $header);
    export_file("middle/plot17${lang}.csv", $germany);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["17"][$lang] . "\"",
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
        "set xtics '2020-02-01',86400*30.30,'2020-12-01'",
        "set ytic center rotate by 90",
        "set ytics 0,5000,30000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set key maxrows 4",
        "set output 'output/plot17${lang}.png'",
        "plot 'middle/plot17${lang}.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col",
    )) . "\n";
    file_put_contents("middle/plot17${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot17${lang}.gnu 2>&1");
    unset($germany);
    unset($header);
    unset($gnuplot);
    console_debug();
}
