<?php

if (!file_exists("output/plot07${lang}1.png")) {
    console_debug("output/plot07${lang}1.png");
    $temp = import_file("input/oecd/code2country.csv");
    $paises = array();
    foreach ($temp as $key => $val) {
        $paises[$val[2]] = $val[0];
    }
    $bed = import_file("input/oecd/DP_LIVE_19082020091144018.csv");
    $nurse = import_file("input/oecd/DP_LIVE_19082020092133263.csv");
    $doctor = import_file("input/oecd/DP_LIVE_19082020092144951.csv");
    $matrix = array();
    foreach ($bed as $key => $val) {
        if ($val[1] == "HOSPITALBED" && $val[2] == "TOT") {
            if (!isset($matrix[$val[0]])) {
                $matrix[$val[0]] = $paises[$val[0]];
            }
        }
    }
    foreach ($nurse as $key => $val) {
        if ($val[1] == "NURSE" && $val[2] == "TOT") {
            if (!isset($matrix[$val[0]])) {
                $matrix[$val[0]] = $paises[$val[0]];
            }
        }
    }
    foreach ($doctor as $key => $val) {
        if ($val[1] == "MEDICALDOC" && $val[2] == "TOT") {
            if (!isset($matrix[$val[0]])) {
                $matrix[$val[0]] = $paises[$val[0]];
            }
        }
    }
    asort($matrix);
    foreach ($matrix as $key => $val) {
        $matrix[$key] = array($val,"","","","","","");
    }
    $years = array();
    foreach ($bed as $key => $val) {
        if ($val[1] == "HOSPITALBED" && $val[2] == "TOT") {
            if (!isset($years[$val[0]])) {
                $years[$val[0]] = 0;
            }
            $years[$val[0]] = max($years[$val[0]], $val[5]);
        }
    }
    foreach ($bed as $key => $val) {
        if ($val[1] == "HOSPITALBED" && $val[2] == "TOT" && $val[5] == $years[$val[0]]) {
            if ($matrix[$val[0]][1] != "") {
                die2("ERROR 6");
            }
            $matrix[$val[0]][1] = $val[6];
            $matrix[$val[0]][2] = $val[5];
        }
    }
    $years = array();
    foreach ($nurse as $key => $val) {
        if ($val[1] == "NURSE" && $val[2] == "TOT") {
            if (!isset($years[$val[0]])) {
                $years[$val[0]] = 0;
            }
            $years[$val[0]] = max($years[$val[0]], $val[5]);
        }
    }
    foreach ($nurse as $key => $val) {
        if ($val[1] == "NURSE" && $val[2] == "TOT" && $val[5] == $years[$val[0]]) {
            if ($matrix[$val[0]][3] != "") {
                die2("ERROR 7");
            }
            $matrix[$val[0]][3] = $val[6];
            $matrix[$val[0]][4] = $val[5];
        }
    }
    $years = array();
    foreach ($doctor as $key => $val) {
        if ($val[1] == "MEDICALDOC" && $val[2] == "TOT") {
            if (!isset($years[$val[0]])) {
                $years[$val[0]] = 0;
            }
            $years[$val[0]] = max($years[$val[0]], $val[5]);
        }
    }
    foreach ($doctor as $key => $val) {
        if ($val[1] == "MEDICALDOC" && $val[2] == "TOT" && $val[5] == $years[$val[0]]) {
            if ($matrix[$val[0]][5] != "") {
                die2("ERROR 8");
            }
            $matrix[$val[0]][5] = $val[6];
            $matrix[$val[0]][6] = $val[5];
        }
    }
    array_unshift($matrix, array(
        "Pais",
        $textos["plot07"]["hospitalbed"][$lang],
        "Year",
        $textos["plot07"]["nurse"][$lang],
        "Year",
        $textos["plot07"]["doctor"][$lang],
        "Year"
    ));
    export_file("middle/plot07${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["07"][$lang] . "\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 6",
        "set lmargin 6",
        "set auto x",
        "set auto y",
        "set style data histogram",
        "set style fill solid border -1",
        "set xtic rotate by -45",
        "set style histogram gap 3",
        "set yrange [0:20]",
        "set ytic center rotate by 90",
        "set ytics 0,5,15",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot07${lang}1.png'",
        "set xrange [-0.5:21.5]",
        "plot 'middle/plot07${lang}.csv' u 2:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 6:xtic(1) ti col",
        "set output 'output/plot07${lang}2.png'",
        "set xrange [21.5:43.5]",
        "plot 'middle/plot07${lang}.csv' u 2:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 6:xtic(1) ti col",
    )) . "\n";
    file_put_contents("middle/plot07${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot07${lang}.gnu 2>&1");
    unset($temp);
    unset($paises);
    unset($bed);
    unset($nurse);
    unset($doctor);
    unset($matrix);
    unset($years);
    unset($gnuplot);
    console_debug();
}
