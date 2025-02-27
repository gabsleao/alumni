<?php

class User {

    private Database $Database;
    private String $Tabela = "usuarios";

    public function __construct(){
        $this->Database = new Database();
    }

    public function criar(UserController $Data){
        $Sql = "INSERT INTO " . $this->Tabela . "(nome, email, senha, localizacao, data_criado, tipo, esta_deletado, informacoes)
                VALUES (:nome, :email, :senha, :localizacao, :data_criado, :tipo, :esta_deletado, :informacoes)";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":nome", $Data->nome);
        $Statement->bindValue(":email", $Data->email);
        $Statement->bindValue(":senha", $Data->senha);
		$Statement->bindValue(":localizacao", $Data->localizacao);
		$Statement->bindValue(":data_criado", $Data->data_criado);
        $Statement->bindValue(":tipo", $Data->tipo);
		$Statement->bindValue(":esta_deletado", $Data->esta_deletado);
        $Statement->bindValue(":informacoes", json_encode($Data->informacoes));
        $Resultado = $Statement->execute();

        return $Resultado;
    }

    public function editar(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para editar curso ainda a ser implementada"]);
    }

    public function excluir(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para excluir curso ainda a ser implementada"]);
    }

    public function get($IDUser){
        $Resultado = [];

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0 AND iduser = :iduser";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $IDUser);
        $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        return json_encode(["Sucesso" => true, "Resposta" => $Resultado]);
    }

    public function getAll(){
        $Resultado = [];

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0";
        $Statement = $this->Database->prepare($Sql);
        $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        return json_encode(["Sucesso" => true, "Resposta" => $Resultado]);
    }

    public function getPorEmail($EmailEncryptado){
        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0 AND email = :email";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":email", $EmailEncryptado);
        $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);
        if(!$Resultado){
            return null;
        }
        
        return $Resultado;
    }

    public function existeUsuario($EmailEncryptado) : bool{
        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0 AND email = :email";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":email", $EmailEncryptado);
        $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if($Resultado){
            return true;
        }

        return false;
    }

    
}