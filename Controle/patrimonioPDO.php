<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Controle/descricaoPDO.php';
    include_once './Modelo/Patrimonio.php';
    include_once './Modelo/Descricao.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Controle/descricaoPDO.php';
        include_once '../Modelo/Patrimonio.php';
        include_once '../Modelo/Descricao.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Controle/descricaoPDO.php';
            include_once '../../Modelo/Patrimonio.php';
            include_once '../../Modelo/Descricao.php';
        }
    }
}

class PatrimonioPDO {

    function inserir() {
        $patrimonio = new patrimonio($_POST);
        if ($patrimonio->getId_desc() == 0) {
            $descricao = new descricao();
            $descricao->setDescricao($_POST['textdesc']);
            $descricao->setNome($_POST['nomedesc']);
            $descPDO = new DescricaoPDO();
            $descricao = $descPDO->inserir($descricao);
            $patrimonio->setId_desc($descricao->getId());
        }
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('insert into Patrimonio values(:pat , :nome , :id_desc , :localizacao , :estado);');
        $stmt->bindValue(':pat', $patrimonio->getPat());
        $stmt->bindValue(':nome', $patrimonio->getNome());
        $stmt->bindValue(':id_desc', $patrimonio->getId_desc());
        $stmt->bindValue(':localizacao', $patrimonio->getLocalizacao());
        $stmt->bindValue(':estado', $patrimonio->getEstado());
        if ($stmt->execute()) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function selectLocalNome(patrimonio $patrimonio) {
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $patrimonio->setLocalizacao("%" . $patrimonio->getLocalizacao() . "%");
        $patrimonio->setNome("%" . $patrimonio->getNome() . "%");
        $stmt = $pdo->prepare("select *  from patrimonio where (pat like :pat or nome like :nome or localizacao like :local) and localizacao like :local2 ORDER BY nome;");
        $stmt->bindValue(":pat", $patrimonio->getNome());
        $stmt->bindValue(":nome", $patrimonio->getNome());
        $stmt->bindValue(":local", $patrimonio->getNome());
        $stmt->bindValue(":local2", $patrimonio->getLocalizacao());
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonio() {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioId_patrimonio($id_patrimonio) {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where id_patrimonio = :id_patrimonio;');
        $stmt->bindValue(':id_patrimonio', $id_patrimonio);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioPat($pat) {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where pat = :pat;');
        $stmt->bindValue(':pat', $pat);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioNome($nome) {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where nome = :nome;');
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioId_desc($id_desc) {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where id_desc = :id_desc;');
        $stmt->bindValue(':id_desc', $id_desc);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioLocalizacao($localizacao) {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where localizacao = :localizacao;');
        $stmt->bindValue(':localizacao', $localizacao);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectPatrimonioEstado($estado) {

        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('select * from patrimonio where estado = :estado;');
        $stmt->bindValue(':estado', $estado);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function update() {
        $patrimonio = new patrimonio($_POST);
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('update patrimonio set pat = :pat , nome = :nome , id_desc = :id_desc , localizacao = :localizacao , estado = :estado where pat = :oldpat;');
        $stmt->bindValue(':pat', $patrimonio->getPat());
        $stmt->bindValue(':nome', $patrimonio->getNome());
        $stmt->bindValue(':id_desc', $patrimonio->getId_desc());
        $stmt->bindValue(':localizacao', $patrimonio->getLocalizacao());
        $stmt->bindValue(':estado', $patrimonio->getEstado());
        $stmt->bindValue(':oldpat', $_POST['oldpat']);
        if ($stmt->execute()) {
            header('location: ../ModuloPatrimonio/consultarPat.php');
        }
    }

    public function deletePatrimonio($definir) {
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $stmt = $pdo->prepare('delete from patrimonio where definir = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }

}
