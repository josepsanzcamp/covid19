<?php

if (!file_exists("output/plot04${lang}1.png")) {
    console_debug("output/plot04${lang}1.png");
    $momonew = import_file("middle/datanew-ok3.csv");
    $ine = import_file("middle/02001-ok2.csv");
    $matrix = array();
    $years = array("INE2018","INE2019","MoMo2020","MoMo2021");
    $edades = array("mas_74","65_74","menos_65");
    $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
    foreach ($edades as $edad) {
        foreach ($years as $year) {
            foreach ($months as $month) {
                $month = sprintf("%02d", $month);
                $matrix[$month][$edad . "-" . $year] = "";
            }
        }
    }
    $header = array_keys(reset($matrix));
    foreach ($momonew as $key => $val) {
        list($year,$month) = explode("-", $val[0]);
        if (!in_array($year, array(2020,2021))) {
            continue;
        }
        $edad = $val[1];
        $year = "MoMo" . $year;
        if (isset($matrix[$month][$edad . "-" . $year])) {
            $matrix[$month][$edad . "-" . $year] = $val[2];
        }
    }
    foreach ($ine as $key => $val) {
        list($year,$month) = explode("-", $val[0]);
        if (!in_array($year, array(2018,2019))) {
            continue;
        }
        $edad = $val[1];
        $year = "INE" . $year;
        if (isset($matrix[$month][$edad . "-" . $year])) {
            $matrix[$month][$edad . "-" . $year] = $val[2];
        }
    }
    foreach ($matrix as $key => $val) {
        $matrix[$key] = array_merge(array($textos["meses"][$lang][$key]), $val);
    }
    foreach ($header as $key => $val) {
        $val = explode("-", $val);
        $val[0] = $textos["edades"][$lang][$val[0]];
        $val = implode(" ", $val);
        $header[$key] = $val;
    }
    array_unshift($matrix, array_merge(array("Mes"), $header));
    export_file("middle/plot04${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["04"][$lang] . "\"",
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
        "set output 'output/plot04${lang}1.png'",
        "set xrange [-0.5:11.5]",
        "plot 'middle/plot04${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col",
        "set yrange [0:12000]",
        "set ytics 0,2000,10000",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 5.5,9000 c tc lt 1",
        "set output 'output/plot04${lang}2.png'",
        "set xrange [-0.5:11.5]",
        "plot 'middle/plot04${lang}.csv' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col,\
            '' u 9:xtic(1) ti col",
        "set output 'output/plot04${lang}3.png'",
        "set xrange [-0.5:11.5]",
        "plot 'middle/plot04${lang}.csv' u 10:xtic(1) ti col,\
            '' u 11:xtic(1) ti col,\
            '' u 12:xtic(1) ti col,\
            '' u 13:xtic(1) ti col",
    )) . "\n";
    file_put_contents("middle/plot04${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot04${lang}.gnu 2>&1");
    unset($momonew);
    unset($ine);
    unset($matrix);
    unset($years);
    unset($edades);
    unset($months);
    unset($header);
    unset($gnuplot);
    console_debug();
}
