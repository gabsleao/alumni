<?php
require_once __DIR__ . '/../config/config.php';

if (!isset($_POST['operacao']) || !isset($_POST['controller'])) {
    throw new Exception("Operação inválida.");
}

$AbstractController = new AbstractController($_POST["controller"]);

switch ($_POST["operacao"]) {
    case "registrar_usuario":
        $AbstractController->Controller->nome = $_POST["nome"];
        $AbstractController->Controller->email = $_POST["email"];
        $AbstractController->Controller->senha = $_POST["senha"];
        $AbstractController->Controller->tipo = $_POST["tipo"];
        $AbstractController->Controller->localizacao = '';
        $AbstractController->Controller->informacoes["profile_img_filename"] = $_POST["profile_img_filename"] ?? null;
        $AbstractController->Controller->informacoes["profile_img_url"] = $_POST["profile_img_url"] ?? null;
        $AbstractController->Controller->informacoes["cidade"] = $_POST["cidade"];
        $AbstractController->Controller->informacoes["estado"] = $_POST["estado"];
        
        $AbstractController->Controller->criar();
        break;

    case "logar_usuario":
        $AbstractController->Controller->email = $_POST["email"];
        $AbstractController->Controller->senha = $_POST["senha"];

        $AbstractController->Controller->logarUsuario();
        break;

    default:
        break;
}
