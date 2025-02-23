<?php

class ComentarioController extends AbstractController {

    public Int $idcomentario = 0;
    public Int $iduser = 0;
    public Int $idinstituicao = 0;
    public Int $data_criado = 0;
    public ?Int $data_modificado = null;
    public Int $esta_deletado = 0;
    public ?String $comentario = null;

    private Comentario $Modal;

    public function __construct(){
        $this->Modal = new Comentario();
    }

    public function criar(){
        if(!isset($this->iduser) || $this->iduser == 0){
            return;
        }

        if(!isset($this->idinstituicao) || $this->idinstituicao == 0){
            return;
        }

        $this->data_criado = time();
        $this->esta_deletado = 0;
        
        $this->Modal->criar($this);
    }

    public function editar(){
        return $this->Modal->editar();
    }

    public function excluir(){
        return $this->Modal->excluir($this);
    }

    public function get(){
        return $this->Modal->get($this->idinstituicao);
    }

    public function getAll(){
        return $this->Modal->getAll();
    }

    public function getAllWithFilter($Filter = []){
        return $this->Modal->getAllWithFilter($Filter);
    }

    public function curtirComentario(){
        if(!isset($this->iduser) || $this->iduser == 0){
            return;
        }

        if(!isset($this->idcomentario) || $this->idcomentario == 0){
            return;
        }

        $this->data_criado = time();

        return $this->Modal->curtirComentario($this);
    }

    public function descurtirComentario(){
        if(!isset($this->iduser) || $this->iduser == 0){
            return;
        }

        if(!isset($this->idcomentario) || $this->idcomentario == 0){
            return;
        }

        $this->data_criado = time();

        return $this->Modal->descurtirComentario($this);
    }
}