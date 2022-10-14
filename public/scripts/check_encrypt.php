<?php

require_once "../config/config.php";

$String = "Email@email.com";
echo "String: $String" . PHP_EOL;

$StringEncriptada = Seguranca::encryptString($String);
echo "StringEncriptada: $StringEncriptada" . PHP_EOL;

$StringDecriptada = Seguranca::decryptString($StringEncriptada);
echo "StringDecriptada: $StringDecriptada" . PHP_EOL;
echo "String: $String" . PHP_EOL;

echo "______________________________________________________________________" . PHP_EOL;

$String = "Email@email.com";
echo "String: $String" . PHP_EOL;

$StringEncriptada = Seguranca::encryptString($String);
echo "StringEncriptada: $StringEncriptada" . PHP_EOL;

$StringDecriptada = Seguranca::decryptString($StringEncriptada);
echo "StringDecriptada: $StringDecriptada" . PHP_EOL;
echo "String: $String" . PHP_EOL;
