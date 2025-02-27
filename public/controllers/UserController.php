<?php

class UserController extends AbstractController {

    public Int $iduser = 0;
    public String $nome = "";
    public String $email = "";
    public String $senha = "";
    public String $localizacao = "";
    public Int $data_criado = 0;
    public Int $data_modificado = 0;
    public String $tipo = "";
    public Int $esta_deletado = 0;
    public Array $informacoes = [];
    
    private User $Modal;

    private String $UserFolder = "../../assets/users/";

    public function __construct(){
        $this->Modal = new User();
    }

    public function criar(){
        if(!isset($this->nome) || strlen($this->nome) == 0){
            return;
        }

        if(!isset($this->email) || strlen($this->email) == 0){
            return;
        }

        if(!isset($this->senha) || strlen($this->senha) == 0){
            return;
        }

        if(!isset($this->tipo) || strlen($this->tipo) == 0){
            return;
        }

        if(!isset($this->informacoes) || !is_array($this->informacoes)){
            return;
        }
        
        if($this->existeUsuario()){
            Utils::sendResponse("USUARIO_JA_EXISTENTE", 405);
        }

        $this->email = Seguranca::encryptString($this->email);
        $this->senha = Seguranca::encryptString($this->senha);

        $this->data_criado = time();
        $this->esta_deletado = 0;
        
        $this->Modal->criar($this);
        Utils::sendResponse("USUARIO_CRIADO", 200);
    }

    public function editar(){
        $this->Modal->editar();
    }

    public function excluir(){
        $this->Modal->excluir();
    }

    public function get(){
        $this->Modal->get($this->iduser);
    }

    public function getAll(){
        $this->Modal->getAll();
    }

    public function getPorEmail(){
        $EmailEncryptado = Seguranca::encryptString($this->email);
        $UsuarioArray = $this->Modal->getPorEmail($EmailEncryptado);

        if(!is_array($UsuarioArray)){
            Log::doLog("UsuarioArray: " . var_export($UsuarioArray, 1), "getPorEmail_error");
            throw new Exception("Usuario não encontrado.");
        }

        foreach($UsuarioArray as $Atributo => $Valor){
            if(isset($this->$Atributo)){
                if($Atributo == "informacoes"){
                    $Valor = json_decode($Valor, 1);
                }

                $this->$Atributo = $Valor;
            }
        }
    }

    public function getProfileImageSrc(){
        $DefaultImageIcon = '../../assets/icons/guest_caret_down.svg';
        if(!isset($this->informacoes)){
            return $DefaultImageIcon;
        }
        
        if(isset($this->informacoes) && !is_array($this->informacoes)){
            return $DefaultImageIcon;
        }

        if(is_array($this->informacoes)){
            if(isset($this->informacoes["profile_img_filename"])){
                return $this->UserFolder . $this->informacoes["profile_img_filename"];
            }
        }

        return $DefaultImageIcon;
    }

    public function uploadProfileImage(){
        $TargetFile = $this->UserFolder . $this->informacoes["profile_img_filename"];
        
        // Check if file already exists
        if (file_exists($TargetFile)) {
            Log::doLog("Arquivo já existe: " . var_export($TargetFile, 1), "uploadProfileImage_error");
        }

        if (move_uploaded_file($this->informacoes["profile_img_url"], $TargetFile)) {
            Log::doLog("Arquivo " . $this->informacoes["profile_img_filename"] . " [ " . $this->informacoes["profile_img_url"] . "] uploaded!", "uploadProfileImage");
        } else {
            Log::doLog("Arquivo " . $this->informacoes["profile_img_filename"] . " [ " . $this->informacoes["profile_img_url"] . "] não completou o upload em: " . $TargetFile, "uploadProfileImage_error");
        }
    }

    public function logarUsuario(){
        if(!isset($this->email) || strlen($this->email) == 0){
            return;
        }

        if(!isset($this->senha) || strlen($this->senha) == 0){
            return;
        }

        if(!$this->existeUsuario()){
            Utils::sendResponse("NAO_EXISTENTE", 405);
        }

        $EmailDecriptado = $this->email;
        $SenhaDecriptada = $this->senha;

        $this->getPorEmail();

        if(!$this->credenciaisCorretas($EmailDecriptado, $SenhaDecriptada)){
            Utils::sendResponse("SENHA_INCORRETA", 405);
        }

        $SessionController = new SessionController();
        $SessionController->Usuario = $this;
        if($SessionController->criar()){
            Utils::sendResponse("USUARIO_LOGADO", 200);
        }
        
        Log::doLog("SESSION: " . var_export($_SESSION, 1) . "<br><br>SessionController: " . var_export($SessionController, 1), "usuarioNaoLogado");
        Utils::sendResponse("ERROR", 200);
    }

    public function existeUsuario(){
        if(!isset($this->email) || strlen($this->email) == 0){
            return;
        }

        $EmailEncryptado = Seguranca::encryptString($this->email);

        return $this->Modal->existeUsuario($EmailEncryptado);
    }

    public function credenciaisCorretas(String $EmailDecriptado, String $SenhaDecriptada): bool{
        if(Seguranca::encryptString($EmailDecriptado) === $this->email){
            if(Seguranca::encryptString($SenhaDecriptada) === $this->senha){
                return true;
            }else{
                Log::doLog("Senhas diferentes - 1. " . Seguranca::encryptString($SenhaDecriptada) . " / 2. " . $this->senha, "credenciaisIncorretas");
                return false;
            }
        }else{
            Log::doLog("Emails diferentes - 1. " . Seguranca::encryptString($EmailDecriptado) . " / 2. " . $this->email, "credenciaisIncorretas");
            return false;
        }
        return false;
    }

    public function recuperarSenha(){
        if(!isset($this->email) || strlen($this->email) == 0){
            return;
        }

        if(!$this->existeUsuario()){
            Utils::sendResponse("NAO_EXISTENTE", 405);
        }

        $SendMail = new SendMail();
        $EmailEnviado = $SendMail->enviarEmail($this->email);

        if($EmailEnviado){
            Utils::sendResponse("EMAIL_ENVIADO", 200);
            return;
        }
    }
}