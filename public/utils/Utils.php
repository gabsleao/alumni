<?php

class Utils{


    static function sendResponse($Mensagem, $StatusCode = 200){
        header('Content-Type: application/json');

        $Response = ["status" => $StatusCode, "mensagem" => $Mensagem];
        echo json_encode($Response);
        
        exit;
    }
}