<?php

class Curtidas {

    private Database $Database;
    private String $Tabela = "usuarios_instituicoes_curtidas";

    public function __construct(){
        $this->Database = new Database();
    }

    public function criar(CurtidasController $Data){
        //se está curtido, descurta
        if($this->estaCurtido($Data))
            return $this->excluir($Data);

        $Sql = "INSERT INTO " . $this->Tabela . " (iduser , idinstituicao , data_criado, data_modificado, esta_ativo)
                VALUES (:iduser, :idinstituicao, :data_criado, :data_modificado, :esta_ativo)
                ON DUPLICATE KEY UPDATE 
                esta_ativo = :esta_ativo,
                data_modificado = :data_modificado";
        
        Log::doLog(var_export($Data, 1), 'Data');
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
		$Statement->bindValue(":idinstituicao", $Data->idinstituicao);
		$Statement->bindValue(":data_criado", $Data->data_criado);
        $Statement->bindValue(":data_modificado", $Data->data_modificado);
        $Statement->bindValue(":esta_ativo", $Data->esta_ativo);
        $Statement->execute();

        return Utils::sendResponse("CURTIDO", 200);
    }

    public function editar(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para editar instituição ainda a ser implementada"]);
    }

    public function excluir($Data){
        $Sql = "UPDATE " . $this->Tabela . " SET esta_ativo = 0, data_modificado = :data_modificado WHERE iduser = :iduser AND idinstituicao = :idinstituicao";
        
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
		$Statement->bindValue(":idinstituicao", $Data->idinstituicao);
        $Statement->bindValue(":data_modificado", time());
        $Statement->execute();

        return Utils::sendResponse("DESCURTIDO", 200);
    }

    public function get($IDUser){
        if(empty($IDUser))
            return json_encode(["Sucesso" => false, "Resposta" => []]);

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_ativo = 1 AND iduser = :iduser";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $IDUser);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado){
            $Resultado = [];
        }
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getAll(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação getAll ainda a ser implementada"]);

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_ativo = 0";
        $Statement = $this->Database->prepare($Sql);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetchAll();

        if(!$Resultado){
            $Resultado = [];
        }
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getCurtidas($IDInstituicao = null){
        if(empty($IDInstituicao))
            return [];

        $Sql = "SELECT iduser, idinstituicao FROM " . $this->Tabela . " WHERE idinstituicao = :idinstituicao AND esta_ativo = 1";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idinstituicao", $IDInstituicao);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetchAll();

        if(!$Executado || !$Resultado){
            return [];
        }

        $Curtidas = [];
        foreach($Resultado as $Row){
            $Curtidas[] = $Row['iduser'];
        }

        return $Curtidas;
    }

    public function estaCurtido($Data){
        if(empty($Data))
            return false;

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_ativo = 1 AND iduser = :iduser AND idinstituicao = :idinstituicao";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
        $Statement->bindValue(":idinstituicao", $Data->idinstituicao);
        $Statement->execute();
        $Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado)
            return false;
        
        
        return $Statement->rowCount() > 0 ? true : false;
    }
}