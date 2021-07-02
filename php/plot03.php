<?php

if(!file_exists("output/plot03${lang}1.png")) {
    console_debug("output/plot03${lang}1.png");
    $momoold=import_file("middle/dataold-ok2.csv");
    $momonew=import_file("middle/datanew-ok2.csv");
    $otros=import_file("middle/7947-ok.csv");
    $matrix=array();
    for($i=strtotime("2020-01-01 12:00:00");$i<=strtotime("2021-01-01 12:00:00");$i+=86400) {
        $fecha=date("Y-m-d",$i);
        $i=strtotime($fecha." 12:00:00");
        $matrix[$fecha]=array($fecha,"","","","","","");
    }
    foreach($momoold as $key=>$val) {
        if(isset($matrix[$val[0]])) $matrix[$val[0]][5]=$val[1];
        unset($momoold[$key]);
    }
    foreach($momonew as $key=>$val) {
        $year=strtok($val[0],"-");
        if($year==2021) {
            $val[0]=str_replace(2021,2020,$val[0]);
            if(isset($matrix[$val[0]])) $matrix[$val[0]][4]=$val[1];
        }
        if($year==2020) {
            if(isset($matrix[$val[0]])) $matrix[$val[0]][3]=$val[1];
        }
        if($year==2019) {
            $val[0]=str_replace(2019,2020,$val[0]);
            if(isset($matrix[$val[0]])) $matrix[$val[0]][2]=$val[1];
        }
        if($year==2018) {
            $val[0]=str_replace(2018,2020,$val[0]);
            if(isset($matrix[$val[0]])) $matrix[$val[0]][1]=$val[1];
        }
        unset($momonew[$key]);
    }
    foreach($otros as $key=>$val) {
        $year=$val[0];
        if($year!=2018) continue;
        $media=round($val[1]/365,0);
        foreach($matrix as $key2=>$val2) {
            $matrix[$key2][6]=$media;
        }
    }
    array_unshift($matrix,array("Fecha","2018","2019","2020","2021","MoMoOld","INE2018"));
    export_file("middle/plot03${lang}.csv",$matrix);
    $gnuplot=implode("\n",array(
        "set terminal png size 1200,600 enhanced font ',11'",
        "set title \"".$textos["plots"]["03"][$lang]."\"",
        "set grid",
        "set tmargin 3",
        "set rmargin 6",
        "set bmargin 3",
        "set lmargin 6",
        "set auto x",
        "set yrange [0:3500]",
        "set xdata time",
        "set timefmt '%Y-%m-%d'",
        "set format x '%Y-%m-%d'",
        "set xtics '2020-01-06',86400*7,'2021-01-01'",
        "set ytic center rotate by 90",
        "set ytics 0,500,3000",
        "set datafile separator '".SEPARADOR."'",
        "set colors classic",
        "set output 'output/plot03${lang}1.png'",
        "set xrange ['2020-01-01':'2020-03-01']",
        "plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col",
        "set output 'output/plot03${lang}2.png'",
        "set xrange ['2020-03-01':'2020-05-01']",
        "plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col",
        "set output 'output/plot03${lang}3.png'",
        "set xrange ['2020-05-01':'2020-07-01']",
        "plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col",
        "set output 'output/plot03${lang}4.png'",
        "set xrange ['2020-07-01':'2020-09-01']",
        "plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col",
        "set output 'output/plot03${lang}5.png'",
        "set xrange ['2020-09-01':'2020-11-01']",
        "plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col",
        "set output 'output/plot03${lang}6.png'",
        "set xrange ['2020-11-01':'2021-01-01']",
        "plot 'middle/plot03${lang}.csv' u 1:2 w lp lc 1 pt 1 ti col, '' u 1:3 w lp lc 2 pt 2 ti col, '' u 1:4 w lp lc 3 pt 3 ti col, '' u 1:5 w lp lc 4 pt 4 ti col, '' u 1:6 w lp lc 5 pt 5 ti col, '' u 1:7 w l lc 6 ti col",
     ))."\n";
    file_put_contents("middle/plot03${lang}.gnu",$gnuplot);
    passthru("gnuplot middle/plot03${lang}.gnu 2>&1");
    unset($momoold);
    unset($momonew);
    unset($otros);
    unset($matrix);
    unset($gnuplot);
    console_debug();
}

?>