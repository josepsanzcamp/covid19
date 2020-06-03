<?php
$file1=$argv[1];
$file2=$argv[2];
$buffer=file_get_contents($file1);
$buffer=str_split($buffer,80);
$buffer=implode("\n",$buffer);
file_put_contents($file2,$buffer);
?>