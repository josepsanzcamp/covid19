<?php

if (!file_exists("output/plot27${lang}1.png")) {
    console_debug("output/plot27${lang}1.png");
    $momoold = import_file("middle/dataold-nacional-per-dia.csv");
    $momoold2 = import_file("middle/dataold2-nacional-per-dia.csv");
    $momonew = import_file("middle/datanew-nacional-per-dia.csv");
    $otros = import_file("middle/7947-defuncions-anys-1980-2018-per-any.csv");
    $matrix = array();
    for ($i = strtotime("2015-01-01 12:00:00"); $i <= strtotime("2023-01-01 12:00:00"); $i += 86400) {
        $fecha = date("Y-m-d", $i);
        $i = strtotime($fecha . " 12:00:00");
        $matrix[$fecha] = array($fecha,"","","","");
    }
    foreach ($momoold as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][1] = $val[1];
        }
        unset($momoold[$key]);
    }
    foreach ($momoold2 as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][2] = $val[1];
        }
        unset($momoold2[$key]);
    }
    foreach ($momonew as $key => $val) {
        if (isset($matrix[$val[0]])) {
            $matrix[$val[0]][3] = $val[1];
        }
        unset($momonew[$key]);
    }
    foreach ($otros as $key => $val) {
        $year = $val[0];
        if ($year != 2018) {
            continue;
        }
        $media = round($val[1] / 365, 0);
        foreach ($matrix as $key2 => $val2) {
            $matrix[$key2][4] = $media;
        }
    }
    array_unshift($matrix, array(
        "Fecha",
        "MoMoOld " . $textos["plot27"]["until"][$lang] . " " . "2020-05-27",
        "MoMoOld2 " . $textos["plot27"]["until"][$lang] . " " . "2022-04-26",
        "MoMo " . $textos["plot27"]["latest"][$lang],
        "INE2018"
    ));
    export_file("middle/plot27${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["27"][$lang] . "\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 3",
        "set lmargin 6",
        "set auto x",
        "set yrange [0:3500]",
        "set xdata time",
        "set timefmt '%Y-%m-%d'",
        "set format x '%Y-%m-%d'",
        "set ytic center rotate by 90",
        "set ytics 0,500,3000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot27${lang}1.png'",
        "set xtics '2015-02-01',86400*30.41,'2015-12-01'",
        "set xrange ['2015-01-01':'2016-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}2.png'",
        "set xtics '2016-02-01',86400*30.41,'2016-12-01'",
        "set xrange ['2016-01-01':'2017-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}3.png'",
        "set xtics '2017-02-01',86400*30.41,'2017-12-01'",
        "set xrange ['2017-01-01':'2018-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}4.png'",
        "set xtics '2018-02-01',86400*30.41,'2018-12-01'",
        "set xrange ['2018-01-01':'2019-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}5.png'",
        "set xtics '2019-02-01',86400*30.41,'2019-12-01'",
        "set xrange ['2019-01-01':'2020-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}6.png'",
        "set xtics '2020-02-01',86400*30.41,'2020-12-01'",
        "set xrange ['2020-01-01':'2021-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}7.png'",
        "set xtics '2021-02-01',86400*30.41,'2021-12-01'",
        "set xrange ['2021-01-01':'2022-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
        "set output 'output/plot27${lang}8.png'",
        "set xtics '2022-02-01',86400*30.41,'2022-12-01'",
        "set xrange ['2022-01-01':'2023-01-01']",
        "plot 'middle/plot27${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col",
     )) . "\n";
    file_put_contents("middle/plot27${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot27${lang}.gnu 2>&1");
    unset($momoold);
    unset($momoold2);
    unset($momonew);
    unset($otros);
    unset($matrix);
    unset($gnuplot);
    console_debug();
}
