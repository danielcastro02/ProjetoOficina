<?php

include_once '../Modelo/Gerador.php';

try {
    include_once './conexao.php';
} catch (Exception $ex) {
    
}

class geradorPDO {

    public function criaConexao() {
        $conteudo = "<?php
    class conexao {
               
        public function getConexao(){
         
           \$con = new PDO('mysql:host=" . $_POST['host'] . ";dbname=" . $_POST['nome'] . "','" . $_POST['usuario'] . "','" . $_POST['senha'] . "');
            return \$con;
          
        }
    }";
        file_put_contents("./conexao.php", $conteudo);

        $con = new PDO("mysql:host=" . $_POST['host'] . ";", $_POST['usuario'], $_POST['senha']);
        $sql = $con->prepare("create database if not exists " . $_POST['nome']);
        $sql->execute();

        header('location: ../index.php?msg=sucesso');
    }

    public function gerarTabela() {

        $semente = new gerador($_POST);
        $con = new conexaoPDO();
        $pdo = $con->getConexao();
        $att = $semente->getAtributo();
        $tipos = $semente->getTipo();
        $regras = $semente->getRegra();
        $preSql = "create table if not exists " . $semente->getNome() . " (\n";
        $q = (count($att) - 1);
        for ($i = 0; $i < $q; $i++) {
            $preSql = $preSql . $att[$i] . " " . $tipos[$i] . " " . $regras[$i] . " ,\n";
        }
        $preSql = $preSql . $att[$q] . " " . $tipos[$q] . " " . $regras[$q] . "\n);";

        $sql = $pdo->prepare($preSql);

        echo $preSql;
        if ($sql->execute()) {



            $conteudo = "<?php \n"
                    . "\n"
                    . "class " . $semente->getNome() . "{\n\n";

            for ($i = 0; $i < count($att); $i++) {
                $conteudo = $conteudo . "private \$" . $att[$i] . ";\n";
            }
            $conteudo = $conteudo . "\n\n"
                    . "public function __construct() {
    if (func_num_args() != 0) {
        \$atributos = func_get_args()[0];
        foreach (\$atributos as \$atributo => \$valor) {
                if (isset(\$valor)) {
                    \$this->\$atributo = \$valor;
                }
            }
        }
    }

    function atualizar(\$vetor) {
        foreach (\$vetor as \$atributo => \$valor) {
            if (isset(\$valor)) {
                \$this->\$atributo = \$valor;
            }
        }
    }"
                    . "\n\n";
            for ($i = 0; $i < count($att); $i++) {
                $conteudo = $conteudo . "     public function get" . ucfirst($att[$i]) . "(){\n"
                        . "         return \$this->" . $att[$i] . ";\n"
                        . "     }\n\n"
                        . "     function set" . ucfirst($att[$i]) . "($" . $att[$i] . "){\n"
                        . "          \$this->" . $att[$i] . " = $" . $att[$i] . ";\n"
                        . "     }\n\n"
                ;
            }
            $conteudo = $conteudo . "}";

            file_put_contents("../Modelo/" . ucfirst($semente->getNome()) . ".php", $conteudo);
            $this->gerarPDO($semente);
        } else {
            header('location: ../index.php?msg=ERRO');
        }
    }

    public function gerarPDO(gerador $semente) {
        $nome = ucfirst($semente->getNome());
        $nomeNormal = $semente->getNome();
        $atributos = $semente->getAtributo();
        $regras = $semente->getRegra();
        $tipos = $semente->getTipo();
        $conteudo = "
<?php

if (realpath('./index.php')) {
    include_once './Controle/conexao.php';
    include_once './Modelo/" . $nome . ".php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/conexao.php';
        include_once '../Modelo/" . $nome . ".php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/conexao.php';
            include_once '../../Modelo/" . $nome . ".php';
        }
    }
}


class " . $nome . "PDO{
    function inserir" . $nome . "() {
        \$" . $nomeNormal . " = new " . $nomeNormal . "(\$_POST);
        \$con = new conexao();
        \$pdo = \$con->getConexao();
        \$stmt = \$pdo->prepare('insert into " . $nome . " values(";

        $buscaRegra = explode(" ", $semente->getRegra()[0]);
        $verificaDefault = false;
        if (in_array("auto_increment", $buscaRegra) || in_array("AUTO_INCREMENT", $buscaRegra)) {
            $conteudo = $conteudo . "default , ";
            $verificaDefault = true;
        } else {
            $conteudo = $conteudo . ":" . $semente->getAtributo()[0] . " , ";
        }

        for ($i = 1; $i < (count($atributos) - 1); $i++) {
            $conteudo = $conteudo . ":" . $atributos[$i] . " , ";
        }
        $conteudo = $conteudo . ":" . $atributos[$i] . ");' ";
        $conteudo = $conteudo . ");\n";
        if ($verificaDefault) {
            for ($i = 1; $i < count($atributos); $i++) {
                $conteudo = $conteudo . "
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
            }
        } else {
            for ($i = 0; $i < count($atributos); $i++) {
                $conteudo = $conteudo . "
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $nomeNormal . "->get" . ucfirst($atributos[$i]) . "());    
        ";
            }
        }

        $conteudo = $conteudo . "
        if(\$stmt->execute()){ 
            header('location: ../index.php?msg=" . $nomeNormal . "Inserido');
        }else{
            header('location: ../index.php?msg=" . $nomeNormal . "ErroInsert');
        }
    }
    
";
        file_put_contents("./" . $nomeNormal . "PDO.php", $conteudo);

        $conteudo = "
            
";

        $conteudo = $conteudo . "
    public function select" . $nome . "(){
            
        \$con = new conexao();
        \$pdo = \$con->getConexao();
        \$stmt = \$pdo->prepare('select * from " . $nomeNormal . " ;');
        \$stmt->execute();
        if (\$stmt->rowCount() > 0) {
            return \$stmt;
        } else {
            return false;
        }
    }
    
";
        file_put_contents("./" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND);

        for ($i = 0; $i < count($atributos); $i++) {

            $conteudo = "
                    
    public function select" . $nome . ucfirst($atributos[$i]) . "(\$" . $atributos[$i] . "){
            
        \$con = new conexao();
        \$pdo = \$con->getConexao();
        \$stmt = \$pdo->prepare('select * from " . $nomeNormal . " where " . $atributos[$i] . " = :" . $atributos[$i] . ";');
        \$stmt->bindValue(':" . $atributos[$i] . "', \$" . $atributos[$i] . ");
        \$stmt->execute();
        if (\$stmt->rowCount() > 0) {
            return \$stmt;
        } else {
            return false;
        }
    }
    
";
            file_put_contents("./" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND);
        }


        $conteudo = " 
    public function update" . $nome . "(" . $nome . " $" . $nome . "){        
        \$con = new conexao();
        \$pdo = \$con->getConexao();
        \$stmt = \$pdo->prepare('update" . $nomeNormal . "set ";
        for ($i = 1; $i < (count($atributos) - 1); $i++) {
            $conteudo = $conteudo . $atributos[$i] . " = :" . $atributos[$i] . " , ";
        }
        $conteudo = $conteudo . $atributos[$i] . " = :" . $atributos[$i];

        $conteudo = $conteudo . " where " . $atributos[0] . " = :" . $atributos[0] . ";');
             
        \$stmt->execute();
        return \$stmt->rowCount();
    }            ";

        file_put_contents("./" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND);
        $conteudo = "
    
    public function delete" . $nome . "(\$definir){
        \$con = new conexao();
        \$pdo = \$con->getConexao();
        \$stmt = \$pdo->prepare('delete from " . $nomeNormal . " where definir = :definir ;');
        \$stmt->bindValue(':definir', \$definir);
        \$stmt->execute();
        return \$stmt->rowCount();
    }
}
";
        if (file_put_contents("./" . $nomeNormal . "PDO.php", $conteudo, FILE_APPEND)) {
            $this->criaControle($semente);
        } else {
            header('location: ../sloth.php?msg=erroCriaPDO');
        }
    }

    public function criaControle(gerador $semente) {
        $conteudo = "<?php

if (!isset(\$_SESSION)) {
    session_start();
}

if (realpath('./index.php')) {
    include_once './Controle/" . $semente->getNome() . "PDO.php';
} else {
    if (realpath('../index.php')) {
        include_once '../Controle/" . $semente->getNome() . "PDO.php';
    } else {
        if (realpath('../../index.php')) {
            include_once '../../Controle/" . $semente->getNome() . "PDO.php';
        }
    }
}

\$classe = new " . $semente->getNome() . "PDO();

if (isset(\$_GET['function'])) {
    \$metodo = \$_GET['function'];
    \$classe->\$metodo();
}

";

        if (file_put_contents("./" . $semente->getNome() . "Controle.php", $conteudo, FILE_APPEND)) {
            header('location: ../sloth.php?msg=ok');

        } else {
            header('location: ../sloth.php?msg=erroCriaControle');
        }
    }

}
