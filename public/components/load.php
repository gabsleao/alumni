<?php

$NotLoad = ["navbar.php", "load.php"];

foreach (glob("./public/components/*.php") as $filename) {
    if(in_array($filename, $NotLoad))
        continue;
    
    require_once $filename;
}