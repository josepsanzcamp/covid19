<?php
$file1=$argv[1];
$file2=$argv[2];
if(pathinfo($file1,PATHINFO_EXTENSION)=="gz") $file1="compress.zlib://".$file1;
if(pathinfo($file2,PATHINFO_EXTENSION)=="gz") $file2="compress.zlib://".$file2;
$buffer=file_get_contents($file1);
$buffer=str_split($buffer,80);
$buffer=implode("\n",$buffer);
file_put_contents($file2,$buffer);
?>