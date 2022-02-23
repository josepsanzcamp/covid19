<?php

function console_debug($file = "")
{
    static $start;
    if ($file != "") {
        echo "Building ${file} ... ";
        $start = microtime(true);
        ob_start();
    } else {
        $output = trim(ob_get_clean());
        $used = microtime(true) - $start;
        if ($used >= 1) {
            $used = round($used, 2) . "sec";
        } elseif ($used >= 0.001) {
            $used = round($used * 1000, 2) . "msec";
        } elseif ($used >= 0.000001) {
            $used = round($used * 1000000, 2) . "usec";
        }
        if ($output == "") {
            echo "\033[32mok\033[0m";
        }
        if ($output != "") {
            echo "\033[31mko\033[0m";
        }
        echo " (${used})\n";
    }
}

function memory_dump()
{
    print_r(array(
        memory_get_usage() / (1024 ** 2),
        memory_get_usage(true) / (1024 ** 2),
        memory_get_peak_usage() / (1024 ** 2),
        memory_get_peak_usage(true) / (1024 ** 2),
    ));
}

function die2($msg)
{
    fwrite(STDERR, $msg);
    exit(1);
}
