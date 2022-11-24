<?php

class InstituicaoController extends AbstractController {

    public Int $idinstituicao = 0;
    public String $nome = "";
    public String $localizacao = "";
    public Int $data_criado = 0;
    public Int $data_modificado = 0;
    public Int $iduser_criador = 0;
    public String $tipo = "";
    public Int $esta_deletado = 0;
    public Array $informacoes = [];

    private Instituicao $Modal;

    public function __construct(){
        $this->Modal = new Instituicao();
    }

    public function criar(){
        if(!isset($this->nome) || strlen($this->nome) == 0){
            return;
        }

        if(!isset($this->tipo) || strlen($this->tipo) == 0){
            return;
        }

        if(!isset($this->localizacao) || $this->localizacao == 0){
            return;
        }

        if(!isset($this->informacoes) || !is_array($this->informacoes)){
            return;
        }

        if(!isset($this->iduser_criador) || $this->iduser_criador == 0){
            return;
        }

        $this->data_criado = time();
        $this->esta_deletado = 0;
        
        $this->Modal->criar($this);
        Utils::sendResponse("INSTITUICAO_CRIADA", 200);
    }

    public function editar(){
        return $this->Modal->editar();
    }

    public function excluir(){
        return $this->Modal->excluir();
    }

    public function get(){
        return $this->Modal->get($this->idinstituicao);
    }

    public function getAll(){
        return $this->Modal->getAll();
    }
}