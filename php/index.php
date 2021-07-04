<?php

if (!file_exists("index.html")) {
    console_debug("index.html");
    $html = file_get_contents("template/index.js");
    $html = html_minify($html);
    file_put_contents("index.html", $html);
    unset($html);
    console_debug();
}
