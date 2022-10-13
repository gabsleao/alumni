<?php

class CursoController extends AbstractController {

    public Int $idcurso = 0;
    public String $nome = "";
    public Int $data_criado = 0;
    public String $descricao = "";
    public Int $idinstituicao = 0;
    public Int $esta_deletado = 0;
    public Array $informacoes = [];
    public Int $iduser_criador = 0;
    public Int $data_modificado =  0;
    private Curso $Modal;

    public function __construct(){
        $this->Modal = new Curso();
    }

    public function criar(){
        if(!isset($this->nome) || strlen($this->nome) == 0){
            return;
        }

        if(!isset($this->descricao) || strlen($this->descricao) == 0){
            return;
        }

        if(!isset($this->idinstituicao) || $this->idinstituicao == 0){
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
    }

    public function editar(){
        $this->Modal->editar();
    }

    public function excluir(){
        $this->Modal->excluir();
    }

    public function get(){
        $this->Modal->get($this->idcurso);
    }

    public function getAll(){
        $this->Modal->getAll();
    }
}