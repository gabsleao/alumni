<?php

class SendMail {
    
    public function enviarEmail($EmailDecriptado){
        if(!isset($EmailDecriptado) || strlen($EmailDecriptado) == 0){
            return;
        }

        //utilizar PHPMailer... implementar depois, exige teste e processo em background...
        return true;
    }
}