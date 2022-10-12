<?php

class Seguranca
{
    private String $KEY = "ENCRYPT-alumni1923787";
    private String $METHOD = "AES-128-CBC";

    public function encryptString(String $String): String {
        $ivlen = openssl_cipher_iv_length($cipher = $this->METHOD);
        $iv = openssl_random_pseudo_bytes($ivlen);

        $ciphertext_raw = openssl_encrypt($String, $cipher, $this->KEY, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->KEY, $as_binary = true);

        $EncryptedString = base64_encode($iv . $hmac . $ciphertext_raw);
        return $EncryptedString;
    }

    public function decryptString(String $EncryptedString): String{
        $c = base64_decode($EncryptedString);

        $ivlen = openssl_cipher_iv_length($cipher = $this->METHOD);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $DecryptedString = openssl_decrypt($ciphertext_raw, $cipher, $this->KEY, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->KEY, $as_binary = true);

        if (hash_equals($hmac, $calcmac)){
            return $DecryptedString;
        }
    }
}
