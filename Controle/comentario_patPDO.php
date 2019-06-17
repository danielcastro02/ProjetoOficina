
<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/Comentario_pat.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/Comentario_pat.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/Comentario_pat.php';
        }
    }
}


class Comentario_patPDO{
    function inserirComentario_pat() {
        $comentario_pat = new comentario_pat($_POST);
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Comentario_pat values(default , :id_user , :pat , :hora , :comentario);' );

        $stmt->bindValue(':id_user', $comentario_pat->getId_user());    
        
        $stmt->bindValue(':pat', $comentario_pat->getPat());    
        
        $stmt->bindValue(':hora', $comentario_pat->getHora());    
        
        $stmt->bindValue(':comentario', $comentario_pat->getComentario());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=comentario_patInserido');
        }else{
            header('location: ../index.php?msg=comentario_patErroInsert');
        }
    }
    

            

    public function selectComentario_pat(){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patId_comentario_pat($id_comentario_pat){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where id_comentario_pat = :id_comentario_pat;');
        $stmt->bindValue(':id_comentario_pat', $id_comentario_pat);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patId_user($id_user){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where id_user = :id_user;');
        $stmt->bindValue(':id_user', $id_user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patPat($pat){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where pat = :pat;');
        $stmt->bindValue(':pat', $pat);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patHora($hora){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where hora = :hora;');
        $stmt->bindValue(':hora', $hora);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    

                    
    public function selectComentario_patComentario($comentario){
            
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from comentario_pat where comentario = :comentario;');
        $stmt->bindValue(':comentario', $comentario);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateComentario_pat(Comentario_pat $Comentario_pat){        
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('updatecomentario_patset id_user = :id_user , pat = :pat , hora = :hora , comentario = :comentario where id_comentario_pat = :id_comentario_pat;');
             
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteComentario_pat($definir){
        $con = new conexao();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from comentario_pat where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
}