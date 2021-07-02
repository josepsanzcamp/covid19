<?php

if(!file_exists("index.${lang}.html")) {
    console_debug("index.${lang}.html");
    $template=get_file("template/index.html");
    $template=str_replace(array("img/","css/","js/"),array("template/img/","template/css/","template/js/"),$template);
    $template=explode("<!-- ROWROWROW -->",$template);
    $html=str_replace(
        array("__TITLE__","__ABOUT__","__FOOTER__","__LANG__","__MOMOOLD__"),
        array($textos["title"][$lang],$textos["about"][$lang],$textos["footer"][$lang],$textos["lang"][$lang],$textos["momoold"][$lang]),
        $template[0]);
    foreach(array("ca","es","en") as $temp) {
        $html.=str_replace(
            array("__LANG__","__LANG2__"),
            array($textos["langs"][$temp],"index.${temp}.html"),
            $template[1]);
    }
    $html.=str_replace(
        array("__TITLE__","__TITLE2__","__TITLE3__"),
        array($textos["title"][$lang],$textos["title2"][$lang],$textos["title3"][$lang]),
        $template[2]);
    foreach($textos["plots"] as $key=>$val) {
        $imgs=array();
        $imgs=array_merge($imgs,glob("output/plot${key}${lang}.png"));
        $imgs=array_merge($imgs,glob("output/plot${key}${lang}?.png"));
        $imgs=array_merge($imgs,glob("output/plot${key}${lang}??.png"));
        $imgs=array_merge($imgs,glob("output/plot${key}${lang}.gif"));
        $imgs=array_merge($imgs,glob("output/plot${key}${lang}?.gif"));
        $imgs=array_merge($imgs,glob("output/plot${key}${lang}??.gif"));
        $count=count($imgs)." ".$textos["count".min(max(count($imgs),1),2)][$lang];
        $datas=array();
        $datas=array_merge($datas,glob("middle/plot${key}${lang}.csv"));
        $datas=array_merge($datas,glob("middle/plot${key}${lang}*.csv"));
        $datas=array_merge($datas,glob("middle/plot${key}${lang}.*.csv"));
        if(!isset($datas[0])) $datas[0]="";
        $datas[0]="https://github.com/josepsanzcamp/covid19/tree/master/".$datas[0];
        if(!count($imgs)) $imgs[]="#";
        $html.=str_replace(
            array("__IMAGE__","__LABEL__","__VIEW__","__DATA__","__COUNT__","__DATA2__","__PLOT__"),
            array($imgs[0],$val[$lang],$textos["view"][$lang],$textos["data"][$lang],$count,$datas[0],"plot${key}"),
            $template[3]);
        foreach($imgs as $img) {
            $html.=str_replace(
                array("__PLOT__","__VIEW__"),
                array("plot${key}",$img),
                $template[4]);
        }
    }
    $html.=str_replace(
        array("__FOOTER__","__TOP__"),
        array($textos["footer"][$lang],$textos["top"][$lang]),
        $template[5]);
    list($html,$js,$css)=html_minify2($html);
    $html=html_minify($html);
    $js=js_minify($js);
    $css=css_minify($css);
    $html=js_minify2($html,"template/js/all.min.js");
    $html=css_minify2($html,"template/css/all.min.css");
    file_put_contents("index.${lang}.html",$html);
    file_put_contents("template/js/all.min.js",$js);
    file_put_contents("template/css/all.min.css",$css);
    unset($template);
    unset($html);
    unset($imgs);
    unset($datas);
    console_debug();
}

?>