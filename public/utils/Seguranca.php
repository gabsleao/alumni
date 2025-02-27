<?php

class Seguranca {
    private static String $KEY = "ENCRYPT-alumni1923787";

    public static function encryptString(String $String): String {
        $EncryptedString = base64_encode(base64_encode(base64_encode($String)));

        return $EncryptedString;
    }

    public static function decryptString(String $EncryptedString): String{
        $String = base64_decode(base64_decode(base64_decode($EncryptedString)));

        return $String;
    }
}
