<?php

class Curso {

    private Database $Database;
    private String $Tabela = "cursos";

    public function __construct(){
        $this->Database = new Database();
    }

    public function criar(CursoController $Data){
        $Sql = "INSERT INTO " . $this->Tabela . "(nome, data_criado, descricao, idinstituicao, esta_deletado, informacoes, iduser_criador, data_modificado)
                VALUES (:nome, :data_criado, :descricao, :idinstituicao, :esta_deletado, :informacoes, :iduser_criador, :data_modificado)";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":nome", $Data->nome);
		$Statement->bindValue(":data_criado", $Data->data_criado);
		$Statement->bindValue(":descricao", $Data->descricao);
        $Statement->bindValue(":idinstituicao", $Data->idinstituicao);
		$Statement->bindValue(":esta_deletado", $Data->esta_deletado);
		$Statement->bindValue(":informacoes", $Data->informacoes);
        $Statement->bindValue(":iduser_criador", $Data->iduser_criador);
		$Statement->bindValue(":data_modificado", $Data->data_modificado);
        $Statement->execute();

        return json_encode(["Sucesso" => true, "Resposta" => "Operação para salvar curso enviada com sucesso!"]);
    }

    public function editar(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para editar curso ainda a ser implementada"]);
    }

    public function excluir(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para excluir curso ainda a ser implementada"]);
    }

    public function get(){
        $Resultado = [];

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0 AND idcurso = :idcurso";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idcurso", $this->idcurso);
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
}