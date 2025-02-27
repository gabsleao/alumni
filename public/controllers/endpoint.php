<?php
require_once __DIR__ . '/../config/config.php';

if (!isset($_POST['operacao']) || !isset($_POST['controller'])) {
    throw new Exception("Operação inválida.");
}

$AbstractController = new AbstractController($_POST["controller"]);

Log::doLog(var_export($_POST, 1), "post");
switch ($_POST["operacao"]) {
    case "registrar_usuario":
        $AbstractController->Controller->nome = $_POST["nome"];
        $AbstractController->Controller->email = $_POST["email"];
        $AbstractController->Controller->senha = $_POST["senha"];
        $AbstractController->Controller->tipo = $_POST["tipo"];
        $AbstractController->Controller->localizacao = $_POST["estado"];
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

    case "deslogar_usuario":
        $AbstractController->Controller->excluir();
        break;
    
    case "recuperar_senha":
        $AbstractController->Controller->email = $_POST["email"];
        $AbstractController->Controller->recuperarSenha();
        break;
    
    case 'adicionar_instituicao':
        $AbstractController->Controller->nome = $_POST["nome"];
        $AbstractController->Controller->tipo = $_POST["tipo"];
        $AbstractController->Controller->localizacao = $_POST["estado"];
        $AbstractController->Controller->informacoes["profile_img_filename"] = $_POST["profile_img_filename"] ?? null;
        $AbstractController->Controller->informacoes["profile_img_url"] = $_POST["profile_img_url"] ?? null;
        $AbstractController->Controller->informacoes["cidade"] = $_POST["cidade"];
        $AbstractController->Controller->informacoes["estado"] = $_POST["estado"];
        $AbstractController->Controller->informacoes["site"] = $_POST["site"];
        $AbstractController->Controller->informacoes["telefone"] = $_POST["telefone"];
        $AbstractController->Controller->informacoes["instituicao_inclusiva"] = $_POST["instituicao_inclusiva"];
        $AbstractController->Controller->informacoes["modalidade_presencial"] = $_POST["modalidade_presencial"];
        $AbstractController->Controller->informacoes["modalidade_remoto"] = $_POST["modalidade_remoto"];
        $AbstractController->Controller->informacoes["endereco"] = $_POST["endereco"];
        $AbstractController->Controller->informacoes["descricao"] = $_POST["descricao"];
        $AbstractController->Controller->iduser_criador = $_SESSION["Session"]->Usuario->iduser;
        
        $AbstractController->Controller->criar();
        break;

    case 'curtir_instituicao':
        $AbstractController->Controller->iduser = $_POST["iduser"];
        $AbstractController->Controller->idinstituicao = $_POST["idinstituicao"];
        $AbstractController->Controller->criar();
        break;

    case 'editar_instituicao':
        $AbstractController->Controller->idinstituicao = $_POST["idinstituicao"];
        $AbstractController->Controller->nome = $_POST["nome"];
        $AbstractController->Controller->tipo = $_POST["tipo"];
        $AbstractController->Controller->localizacao = $_POST["estado"];
        $AbstractController->Controller->informacoes["profile_img_filename"] = $_POST["profile_img_filename"] ?? null;
        $AbstractController->Controller->informacoes["profile_img_url"] = $_POST["profile_img_url"] ?? null;
        $AbstractController->Controller->informacoes["cidade"] = $_POST["cidade"];
        $AbstractController->Controller->informacoes["estado"] = $_POST["estado"];
        $AbstractController->Controller->informacoes["site"] = $_POST["site"];
        $AbstractController->Controller->informacoes["telefone"] = $_POST["telefone"];
        $AbstractController->Controller->informacoes["instituicao_inclusiva"] = $_POST["instituicao_inclusiva"];
        $AbstractController->Controller->informacoes["modalidade_presencial"] = $_POST["modalidade_presencial"];
        $AbstractController->Controller->informacoes["modalidade_remoto"] = $_POST["modalidade_remoto"];
        $AbstractController->Controller->informacoes["endereco"] = $_POST["endereco"];
        $AbstractController->Controller->informacoes["descricao"] = $_POST["descricao"];
        
        $AbstractController->Controller->editar();
        break;

    case 'add_comentario':
        $AbstractController->Controller->iduser = $_POST["iduser"];
        $AbstractController->Controller->idinstituicao = $_POST["idinstituicao"];
        $AbstractController->Controller->comentario = $_POST["comentario"];
        
        $AbstractController->Controller->criar();
        break;

    case 'curtir_comentario':
        $AbstractController->Controller->iduser = $_POST["iduser"];
        $AbstractController->Controller->idcomentario = $_POST["idcomentario"];
        $AbstractController->Controller->curtirComentario();
        break;

    case 'descurtir_comentario':
        $AbstractController->Controller->iduser = $_POST["iduser"];
        $AbstractController->Controller->idcomentario = $_POST["idcomentario"];
        $AbstractController->Controller->descurtirComentario();
        break;

    default:
        break;
}
