<?php

if (!file_exists("middle/defunciones.csv")) {
    console_debug("middle/defunciones.csv");
    $meses = array(
        "enero" => "01",
        "febrero" => "02",
        "marzo" => "03",
        "abril" => "04",
        "mayo" => "05",
        "junio" => "06",
        "julio" => "07",
        "agosto" => "08",
        "septiembre" => "09",
        "octubre" => "10",
        "noviembre" => "11",
        "diciembre" => "12",
    );
    $files = array();
    for ($i = 13; $i <= 21; $i++) {
        $files = array_merge($files, glob("input/indef/Defunciones_20${i}_?.txt"));
        $files = array_merge($files, glob("input/indef/Defunciones_20${i}_0?.txt"));
        $files = array_merge($files, glob("input/indef/Defunciones_20${i}_1?.txt"));
        $files = array_merge($files, glob("input/indef/20${i}_Defunciones_?.txt"));
        $files = array_merge($files, glob("input/indef/20${i}_Defunciones_0?.txt"));
        $files = array_merge($files, glob("input/indef/20${i}_Defunciones_1?.txt"));
    }
    $matrix = array();
    foreach ($files as $file) {
        $lines = file_get_contents($file);
        $lines = explode("\n", $lines);
        foreach ($lines as $key => $val) {
            $val = trim($val);
            if ($key == 1) {
                $val = explode(" ", $val);
                while (!is_numeric($val[0])) {
                    array_shift($val);
                }
                $fecha = $val[4] . "-" . $meses[$val[2]] . "-" . sprintf("%02d", $val[0]);
            } elseif ($val != "") {
                $count = 1;
                while ($count) {
                    $val = str_replace("  ", " ", $val, $count);
                }
                $val = str_replace(".", "", $val);
                $val = explode(" ", $val);
                if (count($val) == 2 && is_numeric($val[0]) && is_numeric($val[1])) {
                    if (!isset($matrix[$val[0]]) && count($matrix)) {
                        $matrix[$val[0]] = array_fill_keys(array_keys(reset($matrix)), "");
                    }
                    $matrix[$val[0]][$fecha] = $val[1];
                }
            }
        }
    }
    $header = array_keys(reset($matrix));
    foreach ($matrix as $key => $val) {
        $matrix[$key] = array_merge(array($key), $val);
    }
    array_unshift($matrix, array_merge(array("Fecha"), $header));
    export_file("middle/defunciones.csv", $matrix);
    unset($files);
    unset($lines);
    unset($matrix);
    console_debug();
}
