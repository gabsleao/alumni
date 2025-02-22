<?php

class CurtidasController extends AbstractController {

    public Int $iduser = 0;
    public Int $idinstituicao = 0;
    public Int $data_criado = 0;
    public ?Int $data_modificado = null;
    public Int $esta_ativo = 0;

    private Curtidas $Modal;

    public function __construct(){
        $this->Modal = new Curtidas();
    }

    public function criar(){
        if(!isset($this->iduser) || $this->iduser == 0){
            return;
        }

        if(!isset($this->idinstituicao) || $this->idinstituicao == 0){
            return;
        }

        $this->data_criado = time();
        $this->esta_ativo = 1;
        
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
}