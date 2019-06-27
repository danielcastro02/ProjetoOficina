<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Descricao.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Descricao.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Descricao.php';
        }
    }
}


class DescricaoPDO{
    function inserirDescricao() {
        $descricao = new descricao($_POST);
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Descricao values(default , :nome , :descricao);' );

        $stmt->bindValue(':nome', $descricao->getNome());    
        
        $stmt->bindValue(':descricao', $descricao->getDescricao());    
        
        if($stmt->execute()){ 
            header('location: ../ModuloPatrimonio/registrarTipoPat.php?msg=descricaoInserido');
        }else{
            header('location: ../ModuloPatrimonio/registrarTipoPat.php?msg=descricaoErroInsert');
        }
    }
    
    
    function inserir(Descricao $descricao){
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Descricao values(default , :nome , :descricao);' );

        $stmt->bindValue(':nome', $descricao->getNome());    
        
        $stmt->bindValue(':descricao', $descricao->getDescricao());    
        
        if($stmt->execute()){ 
            $stmt = $pdo ->prepare("select max(id) as id from descricao;");
            $stmt->execute();
            $descricao->atualizar($stmt->fetch());
            return $descricao;
        }else{
            return false;
        }
    }

            

    public function selectDescricao(){
            
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectDescricaoId_descricao($id_descricao){
            
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao where id = :id_descricao;');
        $stmt->bindValue(':id_descricao', $id_descricao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectDescricaoNome($nome){
            
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectDescricaoDescricao($descricao){
            
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from descricao where descricao = :descricao;');
        $stmt->bindValue(':descricao', $descricao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateDescricao(Descricao $Descricao){        
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('updatedescricaoset nome = :nome , descricao = :descricao where id_descricao = :id_descricao;');
             
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteDescricao($definir){
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from descricao where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
