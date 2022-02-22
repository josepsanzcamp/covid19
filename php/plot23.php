<?php

if (!file_exists("output/plot23${lang}.png")) {
    console_debug("output/plot23${lang}.png");
    $indef = import_file("middle/defunciones.csv");
    $ine1 = import_file("middle/6545-ok.csv");
    $ine2 = import_file("middle/35177-ok.csv");
    $matrix = array(array("Year","INDef","INE-6545","INE-35177"));
    for ($i = 1990; $i <= 2022; $i++) {
        $matrix[$i] = array($i,"","","");
    }
    foreach ($indef as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][1] = end($val);
        }
    }
    foreach ($ine1 as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][2] = $val[1];
        }
    }
    foreach ($ine2 as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][3] = $val[1];
        }
    }
    export_file("middle/plot23${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["23"][$lang] . "\"",
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
        "set xrange [1990:2022]",
        "set yrange [0:600000]",
        "set ytic center rotate by 90",
        "set ytics 0,100000,500000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot23${lang}.png'",
        "plot 'middle/plot23${lang}.csv' u 1:2 w lp ti col,\
            '' u 1:3 w lp ti col,\
            '' u 1:4 w lp ti col",
    )) . "\n";
    file_put_contents("middle/plot23${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot23${lang}.gnu 2>&1");
    unset($indef);
    unset($ine1);
    unset($ine2);
    unset($matrix);
    unset($gnuplot);
    console_debug();
}
