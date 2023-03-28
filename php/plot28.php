<?php

if (!file_exists("output/plot28${lang}.png")) {
    console_debug("output/plot28${lang}.png");
    $indef = import_file("middle/defunciones.csv");
    $ine2018 = import_file("middle/6545-defuncions-anys-1975-2018-per-any.csv");
    $ine2019 = import_file("middle/02001-defuncions-anys-2018-2019-per-any.csv");
    $inelast = import_file("middle/35177-defuncions-anys-2000-actual-per-any.csv");
    $momoold = import_file("middle/dataold-nacional-per-any.csv");
    $momoold2 = import_file("middle/dataold2-nacional-per-any.csv");
    $momoold3 = import_file("middle/dataold3-nacional-per-any.csv");
    $momonew = import_file("middle/datanew-nacional-per-any.csv");
    $matrix = array();
    for ($i = 2015; $i <= 2023; $i++) {
        $matrix[$i] = array($i,"","","","","","","");
    }
    foreach ($indef as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][1] = end($val);
        }
    }
    foreach (array_merge($ine2018, $ine2019) as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][2] = $val[1];
        }
    }
    foreach ($inelast as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][3] = $val[1];
        }
    }
    foreach ($momoold as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][4] = $val[1];
        }
    }
    foreach ($momoold2 as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][5] = $val[1];
        }
    }
    foreach ($momoold3 as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][6] = $val[1];
        }
    }
    foreach ($momonew as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][7] = $val[1];
        }
    }
    // TREURE DADES INCOMPLETES
    $matrix[2018][4] = 0;
    $matrix[2018][5] = 0;
    $matrix[2020][4] = 0;
    // CONTINUAR
    array_unshift($matrix, array(
        "Year",
        "INDef",
        "INE-6545 + INE-02001",
        "INE-35177",
        "MoMoOld " . $textos["plot27"]["until"][$lang] . " " . "2020-05-27",
        "MoMoOld2 " . $textos["plot27"]["until"][$lang] . " " . "2022-04-26",
        "MoMoOld3 " . $textos["plot27"]["until"][$lang] . " " . "2022-12-20",
        "MoMo " . $textos["plot27"]["latest"][$lang],
        "INE2018"
    ));
    export_file("middle/plot28${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["28"][$lang] . "\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 3",
        "set lmargin 6",
        "set auto x",
        "set yrange [0:600000]",
        "set style data histogram",
        "set style fill solid border -1",
        "set style histogram gap 3",
        "set ytic center rotate by 90",
        "set ytics 0,100000,500000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot28${lang}.png'",
        "plot 'middle/plot28${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col,\
            '' u 6:xtic(1) ti col,\
            '' u 7:xtic(1) ti col,\
            '' u 8:xtic(1) ti col",
    )) . "\n";
    file_put_contents("middle/plot28${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot28${lang}.gnu 2>&1");
    unset($indef);
    unset($ine2018);
    unset($ine2019);
    unset($momoold);
    unset($momoold2);
    unset($momonew);
    unset($matrix);
    unset($gnuplot);
    console_debug();
}
