<?php

class Utils{


    static function sendResponse($Mensagem, $StatusCode = 200){

        $Response = ["status" => $StatusCode, "mensagem" => $Mensagem];
        echo json_encode($Response);
        
        exit;
    }
}