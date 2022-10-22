<?php

spl_autoload_register(function ($Classe) {
    $Classe = str_replace('\\', DIRECTORY_SEPARATOR, $Classe);
    $Path = __DIR__ . DIRECTORY_SEPARATOR . '../controllers/' . $Classe . '.php';

    //Controllers
    if (is_readable($Path)) {
        require_once($Path);
    } else {
        $Path = __DIR__ . DIRECTORY_SEPARATOR . '../modals/' . $Classe . '.php';
        //Modals
        if (is_readable($Path)) {
            require_once($Path);
        } else {
            $Path = __DIR__ . DIRECTORY_SEPARATOR . '../utils/' . $Classe . '.php';
            //Utils
            if (is_readable($Path)) {
                require_once($Path);
            }
        }
    }
});

$SessionController = new SessionController();
