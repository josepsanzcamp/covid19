<?php

if (!file_exists("middle/dataold3.csv")) {
    console_debug("middle/dataold3.csv");
    $files = glob("input/momo/data.20221202.csv.bz2");
    sort($files);
    $file = end($files);
    passthru("lbzcat ${file} | grep nacional | grep -v -e hombres -e mujeres -e edad | tac > middle/dataold3.csv");
    console_debug();
}

if (!file_exists("middle/dataold3-nacional-per-any.csv")) {
    console_debug("middle/dataold3-nacional-per-any.csv");
    $data = import_file("middle/dataold3.csv");
    $sumas = array();
    foreach ($data as $key => $val) {
        if ($val[0] == "nacional" && $val[4] == "all" && $val[6] == "all" && $val[9] != "") {
            $key2 = substr($val[8], 0, 4);
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/dataold3-nacional-per-any.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}

if (!file_exists("middle/dataold3-nacional-per-mes.csv")) {
    console_debug("middle/dataold3-nacional-per-mes.csv");
    $data = import_file("middle/dataold3.csv");
    $sumas = array();
    foreach ($data as $key => $val) {
        if ($val[0] == "nacional" && $val[4] == "all" && $val[6] == "all" && $val[9] != "") {
            $key2 = substr($val[8], 0, 7);
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/dataold3-nacional-per-mes.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}

if (!file_exists("middle/dataold3-nacional-per-dia.csv")) {
    console_debug("middle/dataold3-nacional-per-dia.csv");
    $data = import_file("middle/dataold3.csv");
    $sumas = array();
    foreach ($data as $key => $val) {
        if ($val[0] == "nacional" && $val[4] == "all" && $val[6] == "all" && $val[9] != "") {
            $key2 = $val[8];
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/dataold3-nacional-per-dia.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}
