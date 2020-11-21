<?php

ini_set("memory_limit","1G");
ini_set("max_execution_time","3600");

include("php/file.php");
include("php/debug.php");

include("php/ine.php");
include("php/csic.php");
include("php/momoold.php");
include("php/momonew.php");
include("php/momo2wave.php");
include("php/euromomo.php");
include("php/eurostat.php");
include("php/france.php");
include("php/germany.php");
include("php/portugal.php");
include("php/sweden.php");
include("php/langs.php");

foreach(array("ca","es","en") as $lang) {

	include("php/plot01.php");
	include("php/plot02.php");
	include("php/plot03.php");
	include("php/plot04.php");
	include("php/plot05.php");
	include("php/plot06.php");
	include("php/plot07.php");
	include("php/plot08.php");
	include("php/plot09.php");
	include("php/plot10.php");
	include("php/plot11.php");
	include("php/plot12.php");
	include("php/plot13.php");
	include("php/plot14.php");
	include("php/plot15.php");
	include("php/plot16.php");
	include("php/plot17.php");
	include("php/plot18.php");
	include("php/plot19.php");

	include("php/index2.php");

}

include("php/index.php");

?>