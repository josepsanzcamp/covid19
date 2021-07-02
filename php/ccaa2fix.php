<?php

function ccaa2fix($cad) {
    $cad=explode(", ",$cad);
    if(count($cad)==2) $cad=array_reverse($cad);
    $cad=implode(" ",$cad);
    return $cad;
}

?>