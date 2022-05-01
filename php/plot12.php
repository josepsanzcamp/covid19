<?php

if (!file_exists("output/plot12${lang}.png")) {
    console_debug("output/plot12${lang}.png");
    $momonew = import_file("middle/datanew-nacional-per-dia.csv");
    $matrix = array();
    for ($i = strtotime("2020-01-01 12:00:00"); $i <= strtotime("2021-01-01 12:00:00"); $i += 86400) {
        $fecha = date("Y-m-d", $i);
        $i = strtotime($fecha . " 12:00:00");
        $matrix[$fecha] = array($fecha,"","","","","","","","");
    }
    $mapeo = array(
        2015 => 1,
        2016 => 2,
        2017 => 3,
        2018 => 4,
        2019 => 5,
        2020 => 6,
        2021 => 7,
        2022 => 8,
    );
    foreach ($momonew as $key => $val) {
        $year = strtok($val[0], "-");
        if (isset($mapeo[$year])) {
            $val[0] = str_replace($year, 2020, $val[0]);
            if (isset($matrix[$val[0]])) {
                $matrix[$val[0]][$mapeo[$year]] = $val[1];
            }
        }
        unset($momonew[$key]);
    }
    array_unshift($matrix, array("Fecha","2015","2016","2017","2018","2019","2020","2021","2022"));
    export_file("middle/plot12${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["12"][$lang] . "\"",
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
        "set xrange ['2020-01-01':'2021-01-01']",
        "set xtics '2020-02-01',86400*30.25,'2020-12-01'",
        "set ytic center rotate by 90",
        "set ytics 0,500,3000",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot12${lang}.png'",
        "plot 'middle/plot12${lang}.csv' u 1:2 w l ti col,\
            '' u 1:3 w l ti col,\
            '' u 1:4 w l ti col,\
            '' u 1:5 w l ti col,\
            '' u 1:6 w l ti col,\
            '' u 1:7 w l ti col,\
            '' u 1:8 w l ti col,\
            '' u 1:9 w l ti col",
    )) . "\n";
    file_put_contents("middle/plot12${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot12${lang}.gnu 2>&1");
    unset($momonew);
    unset($matrix);
    unset($gnuplot);
    console_debug();
}
