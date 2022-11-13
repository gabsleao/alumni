<?php

class Utils{


    static function sendResponse($Mensagem, $StatusCode = 200){

        $Response = ["status" => $StatusCode, "mensagem" => $Mensagem];
        echo json_encode($Response);
        
        exit;
    }

    static function processarGet($GET){
        $Processado = [
                        "tipo" => "escolas", 
                        "nome" => "", 
                        "localizacao" => "XX", 
                        "valor" => 500, 
                        "modalidade_presencial" => true, 
                        "modalidade_remoto" => false, 
                        "instituicao_inclusiva" => false,
                    ];

        if(!isset($GET) || empty($_GET)){
            return (object) $Processado;
        }

        $Decoded = json_decode($GET);
        foreach($Decoded as $Chave => $Valor){
            $Processado[$Chave] = $Valor;
        }
        return (object) $Processado;
    }
}