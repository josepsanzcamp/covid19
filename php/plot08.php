<?php

if (!file_exists("output/plot08${lang}01.png")) {
    console_debug("output/plot08${lang}01.png");
    $data = import_file("middle/datanew-nacional-per-mes-fitxer.csv");
    $axis0 = array();
    $axis1 = array();
    foreach ($data as $key => $val) {
        if (!isset($axis0[$val[0]])) {
            $axis0[$val[0]] = $val[0];
        }
        //~ if(!isset($axis1[$val[1]])) $axis1[$val[1]]=$val[1];
    }
    for ($i = strtotime("2015-01-01 12:00:00"); $i <= strtotime("2024-01-01 12:00:00"); $i += 86400) {
        $fecha = date("Y-m", $i);
        $axis1[$fecha] = $fecha;
    }
    $matrix = array();
    foreach ($axis1 as $key => $val) {
        $matrix[$val][$val] = $val;
        foreach ($axis0 as $key2 => $val2) {
            $matrix[$val][$val2] = "";
        }
    }
    foreach ($data as $key => $val) {
        if ($matrix[$val[1]][$val[0]] != "") {
            die2("ERROR 9");
        }
        $matrix[$val[1]][$val[0]] = $val[2];
    }
    $diff0 = array_values(array_slice($axis0, 0, -1));
    $diff1 = array_values(array_slice($axis0, 1));
    $axis2 = array();
    foreach ($diff0 as $key => $val) {
        $val2 = $diff1[$key];
        $key2 = $val . " - " . $val2;
        $axis2[] = $key2;
        foreach ($matrix as $key3 => $val3) {
            if (is_numeric($val3[$val2]) && is_numeric($val3[$val])) {
                $matrix[$key3][$key2] = $val3[$val2] - $val3[$val];
            } else {
                $matrix[$key3][$key2] = "";
            }
        }
    }
    foreach ($matrix as $key => $val) {
        $temp = explode("-", $key);
        $matrix[$key][$key] = $textos["meses"][$lang][$temp[1]] . "\\n" . $temp[0];
    }
    array_unshift($matrix, array_merge(array("Mes"), $axis0, $axis2));
    export_file("middle/plot08${lang}.csv", $matrix);
    $cols2plot1 = array();
    for ($i = 0; $i < count($axis0); $i++) {
        $col = $i + 2;
        $cols2plot1[] = "u ${col}:xtic(1) ti col";
    }
    $cols2plot1 = implode(", '' ", $cols2plot1);
    $cols2plot2 = array();
    for ($i = 0; $i < count($axis2); $i++) {
        $col = $i + 2 + count($axis0);
        $cols2plot2[] = "u ${col}:xtic(1) ti col";
    }
    $cols2plot2 = implode(", '' ", $cols2plot2);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["08"][$lang] . "\"",
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
        "set output 'output/plot08${lang}01.png'",
        "set xrange [-0.5:11.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}02.png'",
        "set xrange [11.5:23.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}03.png'",
        "set xrange [23.5:35.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}04.png'",
        "set xrange [35.5:47.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}05.png'",
        "set xrange [47.5:59.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}06.png'",
        "set xrange [59.5:71.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}07.png'",
        "set xrange [71.5:83.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}08.png'",
        "set xrange [83.5:95.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set output 'output/plot08${lang}09.png'",
        "set xrange [95.5:107.5]",
        "plot 'middle/plot08${lang}.csv' ${cols2plot1}",
        "set yrange [0:20000]",
        "set ytics 0,4000,16000",
        "set output 'output/plot08${lang}10.png'",
        "set xrange [35.5:47.5]",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 41.5,18000 c tc lt 1",
        "plot 'middle/plot08${lang}.csv' ${cols2plot2}",
        "set output 'output/plot08${lang}11.png'",
        "set xrange [47.5:59.5]",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 53.5,18000 c tc lt 1",
        "plot 'middle/plot08${lang}.csv' ${cols2plot2}",
        "set output 'output/plot08${lang}12.png'",
        "set xrange [59.5:71.5]",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 65.5,18000 c tc lt 1",
        "plot 'middle/plot08${lang}.csv' ${cols2plot2}",
        "set output 'output/plot08${lang}13.png'",
        "set xrange [71.5:83.5]",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 77.5,18000 c tc lt 1",
        "plot 'middle/plot08${lang}.csv' ${cols2plot2}",
        "set output 'output/plot08${lang}14.png'",
        "set xrange [83.5:95.5]",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 89.5,18000 c tc lt 1",
        "plot 'middle/plot08${lang}.csv' ${cols2plot2}",
        "set output 'output/plot08${lang}15.png'",
        "set xrange [95.5:107.5]",
        "set label 1 \"" . $textos["escala"][$lang] . "\" at 89.5,18000 c tc lt 1",
        "plot 'middle/plot08${lang}.csv' ${cols2plot2}",
    )) . "\n";
    file_put_contents("middle/plot08${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot08${lang}.gnu 2>&1");
    unset($data);
    unset($axis0);
    unset($axis1);
    unset($matrix);
    unset($diff0);
    unset($diff1);
    unset($axis2);
    unset($cols2plot1);
    unset($cols2plot2);
    unset($gnuplot);
    console_debug();
}
