<?php

class SessionController extends AbstractController {
    public Int $data_criado;
    public Int $data_expiracao;

    public UserController $Usuario;

    public function __construct(){

    }

    public function criar() : bool{
        if(!isset($this->Usuario)){
            return false;
        }

        if(isset($_SESSION["Session"])){
            return false;
        }

        $this->data_criado = time();
        $this->data_expiracao = time() + 900; //15 minutos
        
        $Session = new stdClass();
        $Session->data_criado = $this->data_criado;
        $Session->data_expiracao = $this->data_expiracao;

        $Session->Usuario = new stdClass();
        foreach($this->Usuario as $Atributo => $Valor){
            //ignorar o modal
            if($Atributo instanceof User){
                continue;
            }

            if($Atributo == "senha"){
                continue;
            }

            $Session->Usuario->$Atributo = $Valor;
        }
        
        $_SESSION["Session"] = $Session;
        return true;
    }

    public function editar(){
        return;
    }

    public function excluir() {
        if(!isset($_SESSION["Session"])){
            Utils::sendResponse("SESSION_NAO_SETADA", 405);
        }

        unset($_SESSION["Session"]);
        $_SESSION = [];
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        Utils::sendResponse("USUARIO_DESLOGADO", 200);
    }

    public function get(){
        
    }
}