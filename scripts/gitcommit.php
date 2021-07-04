<?php
ob_start();
passthru("git status | grep input | cut -d/ -f2 | sort -u");
$items=explode("\n",trim(ob_get_clean()));
$items=array_diff($items,array(""));
$total=count($items);
if(!$total) {
    die("Nothing to commit\n");
}
if($total>1) {
    $items[$total-2]=$items[$total-2]." i ".$items[$total-1];
    unset($items[$total-1]);
}
$items=implode(", ",$items);
$message="Actualitzar/afegir les dades de ".$items;
passthru('git commit -m "'.$message.'" -e');
?>