<?php

class SessionController extends AbstractController {
    public Int $data_criado;
    public Int $data_expiracao;

    private UserController $Usuario;

    public function __construct(){
        return $this->get();
    }

    public function criar() : bool{
        if(!isset($this->Usuario) || !($this->Usuario instanceof User)){
            return false;
        }

        if(isset($_SESSION["Session"])){
            return false;
        }

        $this->data_criado = time();
        $this->data_expiracao = time() + 900; //15 minutos
        
        $_SESSION["Session"] = $this;
        return true;
    }

    public function editar(){
        return;
    }

    public function excluir(){
        if(!isset($_SESSION["Session"])){
            return;
        }

        unset($_SESSION["Session"]);

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }

    public function get(){
        return session_start();
    }
}