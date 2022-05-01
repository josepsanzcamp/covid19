<?php

if (!file_exists("middle/datanew.csv")) {
    console_debug("middle/datanew.csv");
    $temp = import_file("input/csic/prov2ccaa.csv");
    $ccaas = array();
    foreach ($temp as $key => $val) {
        $fix = ccaa2fix($val[1]);
        if ($val[1] != $fix) {
            $ccaas[$val[1]] = $fix;
        }
    }
    $files = glob("input/momo/data.????????.csv.gz");
    sort($files);
    $file = end($files);
    passthru("zcat ${file} | grep -v -e hombres -e mujeres -e provincia | tac > middle/datanew.csv");
    $buffer = file_get_contents("middle/datanew.csv");
    $buffer = str_replace(array_keys($ccaas),array_values($ccaas),$buffer);
    file_put_contents("middle/datanew.csv",$buffer);
    unset($temp);
    unset($ccaas);
    console_debug();
}

if (!file_exists("middle/datanew-nacional-per-mes.csv")) {
    console_debug("middle/datanew-nacional-per-mes.csv");
    $data = import_file_with_grep("middle/datanew.csv", "grep nacional");
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
    export_file("middle/datanew-nacional-per-mes.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}

if (!file_exists("middle/datanew-nacional-per-dia.csv")) {
    console_debug("middle/datanew-nacional-per-dia.csv");
    $data = import_file_with_grep("middle/datanew.csv", "grep nacional");
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
    export_file("middle/datanew-nacional-per-dia.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}

if (!file_exists("middle/datanew-nacional-per-mes-edat.csv")) {
    console_debug("middle/datanew-nacional-per-mes-edat.csv");
    $data = import_file_with_grep("middle/datanew.csv", "grep nacional");
    $sumas = array();
    $edades = array(
        "0-14" => "menos_65",
        "15-44" => "menos_65",
        "45-64" => "menos_65",
        "65-74" => "65_74",
        "75-84" => "mas_74",
        "+85" => "mas_74",
    );
    foreach ($data as $key => $val) {
        if ($val[0] == "nacional" && $val[4] == "all" && $val[6] != "all" && $val[9] != "") {
            $val[6] = $edades[$val[6]];
            $key2 = substr($val[8], 0, 7) . SEPARADOR . $val[6];
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/datanew-nacional-per-mes-edat.csv", $sumas);
    unset($data);
    unset($sumas);
    unset($edades);
    console_debug();
}

if (!file_exists("middle/datanew-nacional-per-dia-edat.csv")) {
    console_debug("middle/datanew-nacional-per-dia-edat.csv");
    $data = import_file_with_grep("middle/datanew.csv", "grep nacional");
    $sumas = array();
    $edades = array(
        "0-14" => "menos_65",
        "15-44" => "menos_65",
        "45-64" => "menos_65",
        "65-74" => "65_74",
        "75-84" => "mas_74",
        "+85" => "mas_74",
    );
    foreach ($data as $key => $val) {
        if ($val[0] == "nacional" && $val[4] == "all" && $val[6] != "all" && $val[9] != "") {
            $val[6] = $edades[$val[6]];
            $key2 = $val[8] . SEPARADOR . $val[6];
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/datanew-nacional-per-dia-edat.csv", $sumas);
    unset($data);
    unset($sumas);
    unset($edades);
    console_debug();
}

if (!file_exists("middle/datanew-ccaa-per-mes.csv")) {
    console_debug("middle/datanew-ccaa-per-mes.csv");
    $data = import_file_with_grep("middle/datanew.csv", "grep ccaa");
    $sumas = array();
    foreach ($data as $key => $val) {
        if ($val[0] == "ccaa" && $val[4] == "all" && $val[6] == "all" && $val[9] != "") {
            $key2 = substr($val[8], 0, 7) . SEPARADOR . sprintf("%02d", $val[2]) . " " . $val[3];
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/datanew-ccaa-per-mes.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}

if (!file_exists("middle/datanew-ccaa-per-mes-edat.csv")) {
    console_debug("middle/datanew-ccaa-per-mes-edat.csv");
    $data = import_file_with_grep("middle/datanew.csv", "grep ccaa");
    $sumas = array();
    $edades = array(
        "0-14" => "menos_65",
        "15-44" => "menos_65",
        "45-64" => "menos_65",
        "65-74" => "65_74",
        "75-84" => "mas_74",
        "+85" => "mas_74",
    );
    foreach ($data as $key => $val) {
        if ($val[0] == "ccaa" && $val[4] == "all" && $val[6] != "all" && $val[9] != "") {
            $val[6] = $edades[$val[6]];
            $key2 = substr($val[8], 0, 7) . SEPARADOR . sprintf("%02d", $val[2]) . " " . $val[3] . SEPARADOR . $val[6];
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[9];
        }
        unset($data[$key]);
    }
    export_file("middle/datanew-ccaa-per-mes-edat.csv", $sumas);
    unset($data);
    unset($sumas);
    unset($edades);
    console_debug();
}
