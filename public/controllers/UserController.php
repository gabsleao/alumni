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
        
        if(isset($this->informacoes["profile_img_filename"]) && strlen($this->informacoes["profile_img_filename"]) > 0){
            $this->informacoes["profile_img_filename"] = basename(str_replace( "\\", '/', $this->informacoes["profile_img_filename"]));
            if(isset($this->informacoes["profile_img_url"]) && strlen($this->informacoes["profile_img_url"]) > 0){
                $this->uploadProfileImage();
            }
        }

        $Seguranca = new Seguranca();
        $this->email = $Seguranca->encryptString($this->email);
        $this->senha = $Seguranca->encryptString($this->senha);

        $this->data_criado = time();
        $this->esta_deletado = 0;
        
        $this->Modal->criar($this);
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
}