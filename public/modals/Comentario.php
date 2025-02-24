<?php

class Comentario {

    private Database $Database;
    private String $Tabela = "comentarios";

    public function __construct(){
        $this->Database = new Database();
    }

    public function criar(ComentarioController $Data){
        $Sql = "INSERT INTO " . $this->Tabela . " (idcomentario , comentario , iduser_criador, idinstituicao, data_criado, data_modificado, esta_deletado)
                VALUES (:idcomentario, :comentario, :iduser_criador, :idinstituicao, :data_criado, :data_modificado, :esta_deletado)
                ON DUPLICATE KEY UPDATE 
                data_modificado = :data_modificado,
                esta_deletado = :esta_deletado";
        
        Log::doLog(var_export($Data, 1), 'Data');
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idcomentario", $Data->idcomentario);
		$Statement->bindValue(":comentario", $Data->comentario);
		$Statement->bindValue(":iduser_criador", $Data->iduser);
        $Statement->bindValue(":idinstituicao", $Data->idinstituicao);
        $Statement->bindValue(":data_criado", $Data->data_criado);
        $Statement->bindValue(":data_modificado", $Data->data_modificado);
        $Statement->bindValue(":esta_deletado", $Data->esta_deletado);
        $Statement->execute();

        return Utils::sendResponse("COMENTARIO_CRIADO", 200);
    }

    public function editar(){
        return json_encode(["Sucesso" => true, "Resposta" => "Operação para editar comentário ainda a ser implementada"]);
    }

    public function excluir($Data){
        $Sql = "UPDATE " . $this->Tabela . " SET esta_deletado = 1, data_modificado = :data_modificado WHERE idcomentario = :idcomentario";
        
        $Statement = $this->Database->prepare($Sql);
		$Statement->bindValue(":idcomentario", $Data->idcomentario);
        $Statement->bindValue(":data_modificado", time());
        $Statement->execute();

        return Utils::sendResponse("DESCURTIDO", 200);
    }

    public function get($IDInstituicao){
        if(empty($IDInstituicao))
            return json_encode(["Sucesso" => false, "Resposta" => []]);

        $Sql = "SELECT c.idcomentario, c.comentario, u.nome, c.data_criado, c.data_modificado FROM " . $this->Tabela . " c 
                INNER JOIN usuarios u ON u.iduser = c.iduser_criador
                AND c.esta_deletado = 0 
                AND c.idinstituicao = :idinstituicao
                AND u.esta_deletado = 0";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idinstituicao", $IDInstituicao);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado){
            return json_encode(["Sucesso" => $Executado, "Resposta" => []]);
        }

        $Resultado['likes'] = $this->getLikes($Resultado['idcomentario']);
        $Resultado['dislikes'] = $this->getLikes($Resultado['idcomentario']);
        
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
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getAllWithFilter($Filter = []){
        if(empty($Filter))
            return json_encode(["Sucesso" => false, "Resposta" => []]);

        $Sql = "SELECT c.idcomentario, c.comentario, u.nome, c.data_criado, c.data_modificado FROM " . $this->Tabela . " c 
                INNER JOIN usuarios u ON u.iduser = c.iduser_criador
                AND c.esta_deletado = 0 
                AND u.esta_deletado = 0";

        if(isset($Filter['idinstituicao']))
            $Sql .= ' AND c.idinstituicao = :idinstituicao';
        
        $Statement = $this->Database->prepare($Sql);
        if(isset($Filter['idinstituicao']))
            $Statement->bindValue(":idinstituicao", $Filter['idinstituicao']);

        $Executado = $Statement->execute();
		$Resultado = $Statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$Resultado){
            return json_encode(["Sucesso" => $Executado, "Resposta" => []]);
        }

        foreach($Resultado as $Key => $Row){
            $Resultado[$Key]['likes'] = $this->getLikes($Row['idcomentario']);
            $Resultado[$Key]['dislikes'] = $this->getDislikes($Row['idcomentario']);
            $Resultado[$Key]['likesIndex'] = $this->getLikesIndex($Row['idcomentario']);
            $Resultado[$Key]['dislikesIndex'] = $this->getDislikesIndex($Row['idcomentario']);
        }

        //ordenar por quem tem mais like
        usort($Resultado, function($A, $B){
            if ($A['likes'] == $B['likes']) {
                return 0;
            }

            return ($A['likes'] > $B['likes']) ? -1 : 1;
        });
        
        return json_encode(["Sucesso" => $Executado, "Resposta" => $Resultado]);
    }

    public function getLikes($IDComentario){
        if(empty($IDComentario))
            return 0;

        $Sql = "SELECT COUNT(uc.iduser) as likes FROM usuarios_comentarios_curtidas uc
                INNER JOIN usuarios u ON u.iduser = uc.iduser
                AND u.esta_deletado = 0
                AND uc.tipo = 'LIKE'
                AND uc.idcomentario = :idcomentario";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idcomentario", $IDComentario);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Executado)
            return 0;

        return $Resultado['likes'] ?? 0;
    }

    public function getDislikes($IDComentario){
        if(empty($IDComentario))
            return 0;

        $Sql = "SELECT COUNT(uc.iduser) as dislikes FROM usuarios_comentarios_curtidas uc
                INNER JOIN usuarios u ON u.iduser = uc.iduser
                AND u.esta_deletado = 0
                AND uc.tipo = 'DISLIKE'
                AND uc.idcomentario = :idcomentario";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idcomentario", $IDComentario);
        $Executado = $Statement->execute();
		$Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Executado)
            return 0;

        return $Resultado['dislikes'] ?? 0;
    }

    public function getLikesIndex($IDComentario){
        if(empty($IDComentario))
            return [];

        $Sql = "SELECT iduser FROM usuarios_comentarios_curtidas WHERE idcomentario = :idcomentario AND tipo = 'LIKE'";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idcomentario", $IDComentario);
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

    public function getDislikesIndex($IDComentario){
        if(empty($IDComentario))
            return [];

        $Sql = "SELECT iduser FROM usuarios_comentarios_curtidas WHERE idcomentario = :idcomentario AND tipo = 'DISLIKE'";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":idcomentario", $IDComentario);
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

    public function curtirComentario($Data){
        if($this->estaCurtido($Data))
            return $this->neutralizar($Data);
        
        $Sql = "INSERT INTO usuarios_comentarios_curtidas (iduser , idcomentario , data_criado, tipo)
                VALUES (:iduser, :idcomentario, :data_criado, :tipo)
                ON DUPLICATE KEY UPDATE
                tipo = :tipo,
                data_modificado = :data_modificado";

        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
		$Statement->bindValue(":idcomentario", $Data->idcomentario);
		$Statement->bindValue(":data_criado", $Data->data_criado);
        $Statement->bindValue(":data_modificado", time());
        $Statement->bindValue(":tipo", 'LIKE');
        $Statement->execute();

        return Utils::sendResponse("CURTIDO", 200);
    }

    public function estaCurtido($Data){
        if(empty($Data))
            return false;

        $Sql = "SELECT * FROM usuarios_comentarios_curtidas 
                WHERE iduser = :iduser 
                AND idcomentario = :idcomentario
                AND tipo = 'LIKE'";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
        $Statement->bindValue(":idcomentario", $Data->idcomentario);
        $Statement->execute();
        $Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado)
            return false;
        
        
        return $Statement->rowCount() > 0 ? true : false;
    }

    public function neutralizar($Data){
        $Sql = "UPDATE usuarios_comentarios_curtidas SET tipo = NULL, data_modificado = :data_modificado
                WHERE iduser = :iduser 
                AND idcomentario = :idcomentario";
        
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
		$Statement->bindValue(":idcomentario", $Data->idcomentario);
        $Statement->bindValue(":data_modificado", time());
        $Statement->execute();

        return Utils::sendResponse("NEUTRALIZADO", 200);
    }

    public function descurtirComentario($Data){
        if($this->estaDescurtido($Data))
            return $this->neutralizar($Data);
        
        $Sql = "INSERT INTO usuarios_comentarios_curtidas (iduser , idcomentario , data_criado, tipo)
                VALUES (:iduser, :idcomentario, :data_criado, :tipo)
                ON DUPLICATE KEY UPDATE
                tipo = :tipo,
                data_modificado = :data_modificado";

        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
		$Statement->bindValue(":idcomentario", $Data->idcomentario);
		$Statement->bindValue(":data_criado", $Data->data_criado);
        $Statement->bindValue(":data_modificado", time());
        $Statement->bindValue(":tipo", 'DISLIKE');
        $Statement->execute();

        return Utils::sendResponse("DESCURTIDO", 200);
    }

    public function estaDescurtido($Data){
        if(empty($Data))
            return false;

        $Sql = "SELECT * FROM usuarios_comentarios_curtidas 
                WHERE iduser = :iduser 
                AND idcomentario = :idcomentario
                AND tipo = 'DISLIKE'";
        $Statement = $this->Database->prepare($Sql);
        $Statement->bindValue(":iduser", $Data->iduser);
        $Statement->bindValue(":idcomentario", $Data->idcomentario);
        $Statement->execute();
        $Resultado = $Statement->fetch(PDO::FETCH_ASSOC);

        if(!$Resultado)
            return false;
        
        
        return $Statement->rowCount() > 0 ? true : false;
    }
}