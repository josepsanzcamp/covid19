<?php

if(!file_exists("output/plot26${lang}.png")) {
    console_debug("output/plot26${lang}.png");
    $data=import_file("middle/datanew-ok8.csv");
    // CALCULO DE FECHAS
    $fecha1=$data[0][1];
    $fecha2=$data[count($data)-1][1];
    $fecha3=date("Y-m-d",strtotime("$fecha1 + 1 month"));
    $fecha3=substr($fecha3,0,-2)."01";
    $fecha4=substr($fecha2,0,-2)."01";
    // CONTINUAR
    array_unshift($data,array($textos["plot26"]["fecha1"][$lang],$textos["plot26"]["fecha2"][$lang],$textos["plot26"]["diff"][$lang]));
    export_file("middle/plot26${lang}.csv",$data);
    $gnuplot=implode("\n",array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"".$textos["plots"]["26"][$lang]."\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 5",
        "set lmargin 6",
        "set auto x",
        "set auto y",
        "set xdata time",
        "set timefmt '%Y-%m-%d'",
        "set format x '%Y-%m-%d'",
        "set xtics rotate by -45",
        "set xtics '${fecha3}',86400*30,'${fecha4}'",
        "set xrange ['${fecha1}':'${fecha2}']",
        "set ytic center rotate by 90",
        "set datafile separator '".SEPARADOR."'",
        "set colors classic",
        "set output 'output/plot26${lang}.png'",
        "plot 'middle/plot26${lang}.csv' u 2:3 w l ti col",
    ))."\n";
    file_put_contents("middle/plot26${lang}.gnu",$gnuplot);
    passthru("gnuplot middle/plot26${lang}.gnu 2>&1");
    unset($gnuplot);
    console_debug();
}

?>
