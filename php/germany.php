<?php

if (!file_exists("middle/sterbefallzahlen.csv")) {
    console_debug("middle/sterbefallzahlen.csv");
    $matrix2 = array();
    $files = array("sterbefallzahlen.20220118.js.gz","sterbefallzahlen.js.gz");
    foreach ($files as $file) {
        $buffer = get_file("input/germany/${file}");
        $buffer = explode("\n", $buffer);
        $run = 0;
        $matrix = array();
        foreach ($buffer as $key => $val) {
            $val = trim($val);
            if ($val == '<div class="chartData">') {
                $run = 1;
            } elseif (strpos($val, "</table>") !== false) {
                $run = 0;
            } elseif ($run) {
                if (strpos($val, "<th>") !== false || strpos($val, "<td>") !== false) {
                    $matrix[count($matrix) - 1][] =
                        str_replace(array("<th>","</th>","<td>","</td>","&nbsp;"), "", $val);
                } elseif (strpos($val, "<tr>") !== false) {
                    $matrix[] = array();
                }
            }
            unset($buffer[$key]);
        }
        $matrix2[] = $matrix;
    }
    $matrix = array();
    foreach ($matrix2 as $key => $val) {
        foreach ($val as $key2 => $val2) {
            if (!isset($matrix[$key2])) {
                $matrix[$key2] = array();
            }
            $matrix[$key2] = array_merge($matrix[$key2], $val2);
        }
    }
    export_file("middle/sterbefallzahlen.csv", $matrix);
    unset($buffer);
    unset($matrix);
    unset($matrix2);
    console_debug();
}
