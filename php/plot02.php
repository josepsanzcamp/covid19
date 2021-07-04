<?php

if (!file_exists("output/plot02${lang}1.png")) {
    console_debug("output/plot02${lang}1.png");
    $momoold = import_file("middle/dataold-ok.csv");
    $momonew = import_file("middle/datanew-ok.csv");
    $ine = import_file("middle/02001-ok.csv");
    $matrix = array();
    $years = array(2018,2019,2020,2021);
    $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
    foreach ($years as $year) {
        foreach ($months as $month) {
            $month = sprintf("%02d", $month);
            $matrix[$year . "-" . $month]["INE"] = "";
            $matrix[$year . "-" . $month]["MoMo"] = "";
            $matrix[$year . "-" . $month]["MoMoOld"] = "";
        }
    }
    $header = array_keys(reset($matrix));
    foreach ($momoold as $key => $val) {
        list($year,$month) = explode("-", $val[0]);
        if (isset($matrix[$year . "-" . $month]["MoMoOld"])) {
            $matrix[$year . "-" . $month]["MoMoOld"] = $val[1];
        }
    }
    foreach ($momonew as $key => $val) {
        list($year,$month) = explode("-", $val[0]);
        if (isset($matrix[$year . "-" . $month]["MoMo"])) {
            $matrix[$year . "-" . $month]["MoMo"] = $val[1];
        }
    }
    foreach ($ine as $key => $val) {
        list($year,$month) = explode("-", $val[0]);
        if (isset($matrix[$year . "-" . $month]["INE"])) {
            $matrix[$year . "-" . $month]["INE"] = $val[1];
        }
    }
    foreach ($matrix as $key => $val) {
        $temp = explode("-", $key);
        $matrix[$key] = array_merge(array($textos["meses"][$lang][$temp[1]] . "\\n" . $temp[0]), $val);
    }
    array_unshift($matrix, array_merge(array("Mes"), $header));
    export_file("middle/plot02${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["02"][$lang] . "\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 3",
        "set lmargin 6",
        "set auto x",
        "set yrange [0:60000]",
        "set style data histogram",
        "set style fill solid border -1",
        "set style histogram gap 3",
        "set ytic center rotate by 90",
        "set ytics 0,10000,50000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot02${lang}1.png'",
        "set xrange [-0.5:11.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col",
        "set output 'output/plot02${lang}2.png'",
        "set xrange [11.5:23.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col",
        "set output 'output/plot02${lang}3.png'",
        "set xrange [23.5:35.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col",
        "set output 'output/plot02${lang}4.png'",
        "set xrange [35.5:47.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col",
    )) . "\n";
    file_put_contents("middle/plot02${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot02${lang}.gnu 2>&1");
    unset($momoold);
    unset($momonew);
    unset($ine);
    unset($matrix);
    unset($years);
    unset($months);
    unset($header);
    unset($gnuplot);
    console_debug();
}
