<?php

if (!file_exists("output/plot09${lang}01.png")) {
    console_debug("output/plot09${lang}01.png");
    $data = import_file("middle/component.csv");
    $años = array();
    $semanas = array();
    $paises = array();
    foreach ($data as $key => $val) {
        if ($val[0] == "countries" && $val[2] == "Total" && $val[3] == "zscore") {
            $temp = explode("-", $val[4]);
            $años[$temp[0]] = $temp[0];
            $semanas[$temp[1]] = $temp[1];
            $paises[$val[1]] = $val[1];
        }
    }
    sort($paises);
    sort($semanas);
    $matrix = array();
    foreach ($semanas as $semana) {
        foreach ($paises as $pais) {
            foreach ($años as $año) {
                $matrix[$semana][$pais . "-" . $año] = "";
            }
        }
    }
    $header = array_keys(reset($matrix));
    foreach ($data as $key => $val) {
        if ($val[0] == "countries" && $val[2] == "Total" && $val[3] == "zscore") {
            $temp = explode("-", $val[4]);
            if (!isset($matrix[$temp[1]][$val[1] . "-" . $temp[0]])) {
                die2("ERROR 10");
            }
            $matrix[$temp[1]][$val[1] . "-" . $temp[0]] = $val[5];
        }
    }
    foreach ($matrix as $key => $val) {
        $key2 = date("Y-m-d", strtotime("2020W" . $key) + 86400 * 2);
        $matrix[$key] = array_merge(array($key2), $val);
    }
    foreach ($header as $key => $val) {
        if (implode("", array_column($matrix, $val)) == "") {
            foreach ($matrix as $key2 => $val2) {
                $matrix[$key2][$val] = -100; // TRICK
            }
        }
    }
    array_unshift($matrix, array_merge(array("Fecha"), $header));
    export_file("middle/plot09${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["09"][$lang] . "\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 3",
        "set lmargin 6",
        "set auto x",
        "set yrange [-10:50]",
        "set xdata time",
        "set timefmt '%Y-%m-%d'",
        "set format x '%Y-%m-%d'",
        "set xrange ['2020-01-01':'2021-01-01']",
        "set xtics '2020-02-01',86400*30.25,'2020-12-01'",
        "set ytic center rotate by 90",
        "set ytics 0,10,40",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
    )) . "\n";
    for ($i = 0; $i < count($paises); $i++) {
        $j = sprintf("%02d", $i + 1);
        $plot = array();
        for ($k = 0; $k < count($años); $k++) {
            $plot[] = "u 1:" . ($i * count($años) + 2 + $k) . " w lp ti col";
        }
        $plot = implode(",'' ", $plot);
        $gnuplot .= implode("\n", array(
            "set output 'output/plot09${lang}${j}.png'",
            "plot 'middle/plot09${lang}.csv' ${plot}",
        )) . "\n";
    }
    $gnuplot .= "\n";
    file_put_contents("middle/plot09${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot09${lang}.gnu 2>&1");
    unset($data);
    unset($años);
    unset($semanas);
    unset($paises);
    unset($matrix);
    unset($headder);
    unset($gnuplot);
    console_debug();
}
