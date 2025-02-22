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
        if(empty($IDInstituicao))
            return json_encode(["Sucesso" => false, "Resposta" => []]);

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0 AND idinstituicao = :idinstituicao";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idinstituicao", $IDInstituicao);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado){
            $Resultado = [];
        }
        
        $Resultado['curtidas'] = (new Curtidas())->getCurtidas($IDInstituicao);
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getAll(){
        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0";
        $Statement = $this->Database->prepare($Sql);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetchAll();

        if(!$Resultado){
            $Resultado = [];
        }

        $Curtidas = new Curtidas();
        foreach($Resultado as $Key => $Instituicao){
            $Resultado[$Key]['curtidas'] = $Curtidas->getCurtidas($Instituicao['idinstituicao']);
        }
        
        shuffle($Resultado);
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getAllWithFilter($Filter = []){
        if(empty($Filter))
            return $this->getAll();

        $Sql = "SELECT * FROM " . $this->Tabela . " WHERE esta_deletado = 0";

        if(!empty($Filter['nome']))
            $Sql .= " AND nome LIKE :nome";

        if(!empty($Filter['tipo']))
            $Sql .= " AND tipo IN ('" . implode("', '", $Filter['tipo']) . "')";

        if(!empty($Filter['localizacao']))
            $Sql .= " AND localizacao LIKE :localizacao";

        // if(!empty($Filter['valor']))
        //     $Sql .= ' AND valor <= :valor';

        // if(!empty($Filter['instituicao_inclusiva']))
        //     $Sql .= ' AND instituicao_inclusiva = :instituicao_inclusiva';
        
        $Statement = $this->Database->prepare($Sql);
        if(!empty($Filter['nome']))
            $Statement->bindValue(":nome", "%" . $Filter['nome'] . "%");
        
        if(!empty($Filter['localizacao']))
            $Statement->bindValue(":localizacao", "%" . $Filter['localizacao'] . "%");
        
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetchAll();

        if(!$Resultado){
            return [];
        }

        $Curtidas = new Curtidas();
        foreach($Resultado as $Key => $Instituicao){
            $Resultado[$Key]['curtidas'] = $Curtidas->getCurtidas($Instituicao['idinstituicao']);
        }

        shuffle($Resultado);
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getAllDestaque(){
        $Sql = "SELECT *, COUNT(c.iduser) as num_curtidas FROM " . $this->Tabela . " t
                INNER JOIN usuarios_instituicoes_curtidas c ON c.idinstituicao = t.idinstituicao
                AND t.esta_deletado = 0
                AND c.esta_ativo = 1
                AND (c.data_criado >= :last24h OR c.data_modificado >= :last24h)
                GROUP BY t.idinstituicao
                ORDER BY num_curtidas DESC
                LIMIT 4";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":last24h", time() - 86400);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetchAll();

        if(!$Resultado){
            return [];
        }

        $Curtidas = new Curtidas();
        foreach($Resultado as $Key => $Instituicao){
            $Resultado[$Key]['curtidas'] = $Curtidas->getCurtidas($Instituicao['idinstituicao']);
        }

        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }
}