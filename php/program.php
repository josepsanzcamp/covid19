<?php

ini_set("memory_limit", "1G");
ini_set("max_execution_time", "3600");

include("php/file.php");
include("php/debug.php");
include("php/minify.php");
include("php/ccaa2fix.php");

include("php/ine.php");
include("php/csic.php");
include("php/momo.php");
include("php/momoold.php");
include("php/momoold2.php");
include("php/momonew.php");
include("php/euromomo.php");
include("php/eurostat.php");
include("php/france.php");
include("php/germany.php");
include("php/portugal.php");
include("php/sweden.php");
include("php/indef.php");
include("php/langs.php");

foreach (array("ca","es","en") as $lang) {
    $plots = glob("php/plot??.php");
    foreach ($plots as $plot) {
        include($plot);
    }

    include("php/index2.php");
}

include("php/index.php");
