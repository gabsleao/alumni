<?php

class AbstractController {

    public $Controller;

    public function __construct($Controller = null){
        if(is_null($Controller)){
            return;
        }

        $this->Controller = new $Controller();
    }

    public function criar(){
        return $this->Controller->criar();
    }

    public function editar(){
        return $this->Controller->editar();
    }

    public function excluir(){
        return $this->Controller->excluir();
    }

    public function get(){
        return $this->Controller->get();
    }

    public function getAll(){
        return $this->Controller->getAll();
    }
}