<?php

if (!file_exists("output/plot02${lang}1.png")) {
    console_debug("output/plot02${lang}1.png");
    $momonew = import_file("middle/datanew-nacional-per-mes.csv");
    $ine = import_file("middle/02001-defuncions-anys-2018-2019-per-mes.csv");
    $matrix = array();
    $years = array(2015,2016,2017,2018,2019,2020,2021,2022);
    $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
    foreach ($years as $year) {
        foreach ($months as $month) {
            $month = sprintf("%02d", $month);
            $matrix[$year . "-" . $month]["INE"] = "";
            $matrix[$year . "-" . $month]["MoMo"] = "";
        }
    }
    $header = array_keys(reset($matrix));
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
        "set yrange [0:70000]",
        "set style data histogram",
        "set style fill solid border -1",
        "set style histogram gap 3",
        "set ytic center rotate by 90",
        "set ytics 0,10000,60000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot02${lang}1.png'",
        "set xrange [-0.5:11.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}2.png'",
        "set xrange [11.5:23.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}3.png'",
        "set xrange [23.5:35.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}4.png'",
        "set xrange [35.5:47.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}5.png'",
        "set xrange [47.5:59.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}6.png'",
        "set xrange [59.5:71.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}7.png'",
        "set xrange [71.5:83.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
        "set output 'output/plot02${lang}8.png'",
        "set xrange [83.5:95.5]",
        "plot 'middle/plot02${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col",
    )) . "\n";
    file_put_contents("middle/plot02${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot02${lang}.gnu 2>&1");
    unset($momonew);
    unset($ine);
    unset($matrix);
    unset($years);
    unset($months);
    unset($header);
    unset($gnuplot);
    console_debug();
}
