<?php

if (!file_exists("output/plot11${lang}.png")) {
    console_debug("output/plot11${lang}.png");
    $norway = import_file("input/norway/07995.csv.gz");
    foreach ($norway as $key => $val) {
        for ($i = 1; $i <= 15; $i++) {
            unset($val[$i]);
        }
        $norway[$key] = $val;
    }
    $header = array_shift($norway);
    foreach ($header as $key => $val) {
        $val = str_replace("Deaths ", "", $val);
        $header[$key] = $val;
    }
    foreach ($norway as $key => $val) {
        $val[0] = sprintf("%02d", str_replace("Week ", "", $val[0]));
        $val[0] = date("Y-m-d", strtotime("2020W" . $val[0]) + 86400 * 2);
        foreach ($val as $key2 => $val2) {
            if (in_array($val2,array("0","."))) {
                $val[$key2] = "";
            }
        }
        $norway[$key] = $val;
    }
    array_unshift($norway, $header);
    export_file("middle/plot11${lang}.csv", $norway);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["11"][$lang] . "\"",
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
        "set xtics '2020-02-01',86400*30.30,'2020-12-01'",
        "set ytic center rotate by 90",
        "set ytics 0,200,1400",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set key maxrows 5",
        "set output 'output/plot11${lang}.png'",
        "plot 'middle/plot11${lang}.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col,\
            '' u 1:5 w lp ti col,\
            '' u 1:6 w lp ti col,\
            '' u 1:7 w lp ti col,\
            '' u 1:8 w lp ti col,\
            '' u 1:9 w lp ti col,\
            '' u 1:10 w lp ti col",
    )) . "\n";
    file_put_contents("middle/plot11${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot11${lang}.gnu 2>&1");
    unset($norway);
    unset($header);
    unset($gnuplot);
    console_debug();
}
