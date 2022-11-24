<?php

class Instituicao {

    private Database $Database;
    private String $Tabela = "instituicoes";

    public function __construct(){
        $this->Database = new Database();
    }

    public function criar(InstituicaoController $Data){
        $Sql = "INSERT INTO " . $this->Tabela . " (nome, localizacao, data_criado, data_modificado, iduser_criador, tipo, esta_deletado, informacoes)
                VALUES (:nome, :localizacao, :data_criado, :data_modificado, :iduser_criador, :tipo, :esta_deletado, :informacoes)";
        
        Log::doLog(var_export($Data, 1), 'Data');
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":nome", $Data->nome);
		$Statement->bindValue(":localizacao", $Data->localizacao);
		$Statement->bindValue(":data_criado", $Data->data_criado);
        $Statement->bindValue(":data_modificado", $Data->data_modificado);
        $Statement->bindValue(":iduser_criador", $Data->iduser_criador);
        $Statement->bindValue(":tipo", $Data->tipo);
        $Statement->bindValue(":esta_deletado", $Data->esta_deletado);
		$Statement->bindValue(":informacoes", json_encode($Data->informacoes));
        $Statement->execute();

        return json_encode(["Sucesso" => true, "Resposta" => "Operação para salvar instituição enviada com sucesso!"]);
    }

    public function editar(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para editar instituição ainda a ser implementada"]);
    }

    public function excluir(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para excluir instituição ainda a ser implementada"]);
    }

    public function get($IDInstituicao){
        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0 AND idinstituicao = :idinstituicao";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idinstituicao", $IDInstituicao);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado){
            $Resultado = [];
        }
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getAll(){
        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0";
        $Statement = $this->Database->prepare($Sql);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado){
            $Resultado = [];
        }
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }
}