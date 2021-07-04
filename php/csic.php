<?php

if (!file_exists("middle/residencias.csv")) {
    console_debug("middle/residencias.csv");
    $temp = import_file("input/csic/prov2ccaa.csv");
    $ccaas = array();
    foreach ($temp as $key => $val) {
        $ccaas[$val[2]] = $val[0] . " " . ccaa2fix($val[1]);
    }
    $files = glob("input/csic/19_*.csv");
    $sumas = array();
    foreach ($files as $file) {
        $data = import_file($file);
        foreach ($data as $key => $val) {
            if ($val[4] != "" && $val[7] != "" && $val[8] != "" && $val[8] != "Plazas") {
                $publica = 0;
                $privada = 0;
                if (stripos($val[7], "pública") !== false) {
                    $publica = 1;
                }
                if (stripos($val[7], "privada") !== false) {
                    $privada = 1;
                }
                if ($publica + $privada != 1) {
                    die("ERROR 1");
                }
                $tipo = "";
                if ($publica) {
                    $tipo = "Publica";
                }
                if ($privada) {
                    $tipo = "Privada";
                }
                $ccaa = $ccaas[substr($val[4], 0, 2)];
                $key2 = $ccaa . SEPARADOR . "Total";
                if (!isset($sumas[$key2])) {
                    $sumas[$key2] = array($key2,0,0);
                }
                $sumas[$key2][1]++;
                $sumas[$key2][2] += str_replace(".", "", $val[8]);
                $key2 = $ccaa . SEPARADOR . $tipo;
                if (!isset($sumas[$key2])) {
                    $sumas[$key2] = array($key2,0,0);
                }
                $sumas[$key2][1]++;
                $sumas[$key2][2] += str_replace(".", "", $val[8]);
            }
             unset($data[$key]);
        }
    }
    array_unshift($sumas, array("CCAA","Tipo","Count","Plazas"));
    export_file("middle/residencias.csv", $sumas);
    unset($temp);
    unset($ccaas);
    unset($sumas);
    unset($data);
    console_debug();
}
