<?php

if(!file_exists("middle/sterbefallzahlen.csv")) {
	console_debug("middle/sterbefallzahlen.csv");
	$buffer=get_file("input/germany/sterbefallzahlen.js.gz");
	$buffer=explode("\n",$buffer);
	$run=0;
	$matrix=array();
	foreach($buffer as $key=>$val) {
		$val=trim($val);
		if($val=='<div class="chartData">') {
			$run=1;
		} elseif(strpos($val,"</table>")!==false) {
			$run=0;
		} elseif($run) {
			if(strpos($val,"<th>")!==false || strpos($val,"<td>")!==false) {
				$matrix[count($matrix)-1][]=str_replace(array("<th>","</th>","<td>","</td>","&nbsp;"),"",$val);
			} elseif(strpos($val,"<tr>")!==false) {
				$matrix[]=array();
			}
		}
		unset($buffer[$key]);
	}
	export_file("middle/sterbefallzahlen.csv",$matrix);
	unset($buffer);
	unset($matrix);
	console_debug();
}

?>