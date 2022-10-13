<?php
require_once __DIR__ . '/../config/config.php';

if (!isset($_POST['operacao']) || !isset($_POST['controller'])) {
    throw new Exception("Operação inválida.");
}

$AbstractController = new AbstractController($_POST["controller"]);

switch ($_POST["operacao"]) {
    case "registrar_usuario":
        Log::doLog(var_export($AbstractController, 1), 'backtrace', 1);
        $AbstractController->Controller->nome = $_POST["nome"];
        $AbstractController->Controller->email = $_POST["email"];
        $AbstractController->Controller->senha = $_POST["senha"];
        $AbstractController->Controller->tipo = $_POST["tipo"];
        $AbstractController->Controller->localizacao = '';
        $AbstractController->Controller->informacoes["profile_img_filename"] = $_POST["profile_img_filename"];
        $AbstractController->Controller->informacoes["cidade"] = $_POST["cidade"];
        $AbstractController->Controller->informacoes["estado"] = $_POST["estado"];
        Log::doLog(var_export($AbstractController, 1), 'backtrace');
        $AbstractController->Controller->criar();
        break;

    default:
        break;
}
