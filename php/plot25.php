<?php

if (!file_exists("output/plot25${lang}.png")) {
    console_debug("output/plot25${lang}.png");
    $temp = import_file("input/csic/prov2ccaa.csv");
    $ccaas = array();
    foreach ($temp as $key => $val) {
        $ccaas[$val[0]] = $val[0] . " " . ccaa2fix($val[1]);
    }
    $ine = import_file("middle/02002-poblacio-anys-1998-2019-per-ccaa-edat.csv");
    $matrix = array();
    foreach ($ine as $key => $val) {
        if ($val[0] != 2019) {
            continue;
        }
        if (!isset($matrix[$val[1]])) {
            $matrix[$val[1]] = array("total" => "");
        }
        $matrix[$val[1]][$val[2]] = $val[3] / 1000000;
    }
    foreach ($matrix as $key => $val) {
        $matrix[$key]["total"] = array_sum($val);
    }
    $header = array_keys(reset($matrix));
    $matrix["18 Ceuta + 19 Melilla"] = array(
        $matrix["18 Ceuta"]["total"] + $matrix["19 Melilla"]["total"],
        $matrix["18 Ceuta"]["menos_65"] + $matrix["19 Melilla"]["menos_65"],
        $matrix["18 Ceuta"]["65_74"] + $matrix["19 Melilla"]["65_74"],
        $matrix["18 Ceuta"]["mas_74"] + $matrix["19 Melilla"]["mas_74"],
    );
    unset($matrix["18 Ceuta"]);
    unset($matrix["19 Melilla"]);
    $ccaas = array(
        "03 Principado de Asturias" => "03 Principado\\nAsturias",
        "04 Illes Balears" => "04 Illes\\nBalears",
        "07 Castilla y León" => "07 Castilla\\ny León",
        "08 Castilla - La Mancha" => "08 Castilla\\nLa Mancha",
        "10 Comunitat Valenciana" => "10 Comunitat\\nValenciana",
        "13 Comunidad de Madrid" => "13 Comunidad\\nde Madrid",
        "14 Región de Murcia" => "14 Región\\nde Murcia",
        "15 Comunidad Foral de Navarra" => "15 Comunidad\\nForal de Navarra",
        "18 Ceuta + 19 Melilla" => "18 Ceuta\\n19 Melilla",
    );
    foreach ($matrix as $key => $val) {
        $ccaa = isset($ccaas[$key]) ? $ccaas[$key] : $key;
        $matrix[$key] = array_merge(array($ccaa), $val);
    }
    foreach ($header as $key => $val) {
        $header[$key] = $textos["edades"][$lang][$val];
    }
    array_unshift($matrix, array_merge(array("CCAA"), $header));
    export_file("middle/plot25${lang}.csv", $matrix);
    $gnuplot = implode("\n", array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"" . $textos["plots"]["25"][$lang] . "\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 7",
        "set lmargin 6",
        "set auto x",
        "set auto y",
        "set style data histogram",
        "set style fill solid border -1",
        "set xtic rotate by -45",
        "set style histogram gap 3",
        "set yrange [0:9]",
        "set ytic center rotate by 90",
        "set ytics 0,1.5,7.5",
        "set datafile separator '" . SEPARADOR . "'",
        "set colors classic",
        "set output 'output/plot25${lang}.png'",
        "plot 'middle/plot25${lang}.csv' u 2:xtic(1) ti col,\
            '' u 3:xtic(1) ti col,\
            '' u 4:xtic(1) ti col,\
            '' u 5:xtic(1) ti col",
    )) . "\n";
    file_put_contents("middle/plot25${lang}.gnu", $gnuplot);
    passthru("gnuplot middle/plot25${lang}.gnu 2>&1");
    unset($temp);
    unset($ccaas);
    unset($ine);
    unset($matrix);
    unset($header);
    unset($gnuplot);
    console_debug();
}
