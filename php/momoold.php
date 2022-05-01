<?php

if (!file_exists("middle/dataold.csv")) {
    console_debug("middle/dataold.csv");
    $temp = import_file("input/csic/prov2ccaa.csv");
    $ccaas = array();
    foreach ($temp as $key => $val) {
        $ccaas[$val[1]] = ccaa2fix($val[1]);
    }
    $files = glob("input/momo/data.????????.csv.gz");
    sort($files);
    foreach ($files as $key => $val) {
        $temp = explode(".", $val);
        if (!in_array($temp[1], array(20200507,20200523))) {
            unset($files[$key]);
        }
    }
    $result = array();
    foreach ($files as $file) {
        $data = import_file_with_grep($file, "grep nacional | grep -v -e hombres -e mujeres -e edad");
        foreach ($data as $key => $val) {
            if (isset($ccaas[$val[3]])) {
                $val[3] = $ccaas[$val[3]];
            }
            $key2 = implode("|", array_slice($val, 0, 8));
            $key3 = $val[8];
            $result[$key2][$key3] = array_slice($val, 0, 10);
            unset($data[$key]);
        }
    }
    $result2 = array();
    foreach ($result as $key => $val) {
        $result2 = array_merge($result2, array_values($val));
        unset($result[$key]);
    }
    export_file("middle/dataold.csv", $result2);
    unset($temp);
    unset($ccaas);
    unset($result);
    unset($data);
    unset($result2);
    console_debug();
}

if (!file_exists("middle/dataold-ok2.csv")) {
    console_debug("middle/dataold-ok2.csv");
    $data = import_file("middle/dataold.csv");
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
    export_file("middle/dataold-ok2.csv", $sumas);
    unset($data);
    unset($sumas);
    console_debug();
}

