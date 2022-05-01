<?php

// phpcs:disable Generic.Files.LineLength

if (count(glob("middle/data.????????.csv")) != count(glob("input/momo/data.????????.csv.gz"))) {
    console_debug("middle/data.????????.csv");
    $files = glob("input/momo/data.????????.csv.gz");
    sort($files);
    foreach ($files as $file) {
        $part = explode(".", $file);
        $part = $part[1];
        if (file_exists("middle/data.${part}.csv")) {
            continue;
        }
        if ($part <= 20220425) {
            $data = import_file_with_grep($file, "grep nacional | grep -v -e hombres -e mujeres -e edad");
        } else {
            $data = import_file_with_grep($file, "grep nacional | grep -v -e hombres -e mujeres -e edad | tac");
        }
        $matrix = array();
        foreach ($data as $key => $val) {
            if ($val[0] == "nacional" && $val[4] == "all" && $val[6] == "all" && $val[9] != "") {
                $key2 = $val[8];
                if (isset($matrix[$key2])) {
                    die2("ERROR 4");
                }
                $matrix[$key2] = array($key2,$val[9]);
            }
            unset($data[$key]);
        }
        export_file("middle/data.${part}.csv", $matrix);
    }
    unset($data);
    unset($matrix);
    console_debug();
}

if (!file_exists("middle/datanew-nacional-per-mes-fitxer.csv")) {
    console_debug("middle/datanew-nacional-per-mes-fitxer.csv");
    $files = glob("middle/data.????????.csv");
    sort($files);
    $last = explode(".", end($files));
    foreach ($files as $key => $val) {
        $temp = explode(".", $val);
        if (!in_array($temp[1], array(20200507,20200523,20200527,20200530,20210420,20210421,20220425,20220426,$last[1]))) {
            unset($files[$key]);
        }
    }
    $sumas = array();
    foreach ($files as $file) {
        $data = import_file($file);
        $temp = explode(".", $file);
        $temp = str_split($temp[1], 2);
        $fecha = $temp[0] . $temp[1] . "-" . $temp[2] . "-" . $temp[3];
        foreach ($data as $key => $val) {
            $key2 = $fecha . SEPARADOR . substr($val[0], 0, 7);
            if (!isset($sumas[$key2])) {
                $sumas[$key2] = array($key2,0);
            }
            $sumas[$key2][1] += $val[1];
            unset($data[$key]);
        }
    }
    export_file("middle/datanew-nacional-per-mes-fitxer.csv", $sumas);
    unset($sumas);
    unset($data);
    console_debug();
}

if (!file_exists("middle/datanew-diferencies-linies-per-fitxer.csv")) {
    console_debug("middle/datanew-diferencies-linies-per-fitxer.csv");
    $files = glob("middle/data.????????.csv");
    sort($files);
    $rows = array();
    foreach ($files as $key => $val) {
        if ($key == 0) {
            continue;
        }
        $prev = $files[$key - 1];
        ob_start();
        passthru("bash -c 'diff <(head -n 365 $prev) <(head -n 365 $val)' | grep -e '<' -e '>' | wc -l");
        $diff = trim(ob_get_clean());
        $fecha1 = explode(".", $prev);
        $fecha1 = str_split($fecha1[1], 2);
        $fecha1 = $fecha1[0] . $fecha1[1] . "-" . $fecha1[2] . "-" . $fecha1[3];
        $fecha2 = explode(".", $val);
        $fecha2 = str_split($fecha2[1], 2);
        $fecha2 = $fecha2[0] . $fecha2[1] . "-" . $fecha2[2] . "-" . $fecha2[3];
        $rows[] = array($fecha1,$fecha2,$diff);
    }
    export_file("middle/datanew-diferencies-linies-per-fitxer.csv", $rows);
    console_debug();
}
