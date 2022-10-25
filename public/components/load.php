<?php

$NotLoad = ["navbar.php", "load.php"];

foreach (glob("./components/*.php") as $filename) {
    if(in_array($filename, $NotLoad))
        continue;
    
    require_once $filename;
}