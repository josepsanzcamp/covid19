<?php

function console_debug($file="") {
	static $start;
	if($file!="") {
		echo "Building ${file} ... ";
		$start=microtime(true);
		ob_start();
	} else {
		$output=trim(ob_get_clean());
		$used=microtime(true)-$start;
		if($used>=1) $used=round($used,2)."sec";
		elseif($used>=0.001) $used=round($used*1000,2)."msec";
		elseif($used>=0.000001) $used=round($used*1000000,2)."usec";
		if($output=="") echo "ok";
		if($output!="") echo "ko";
		echo " (${used})\n";
	}
}

?>