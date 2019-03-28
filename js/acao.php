<?php

include "bd.php";

class OperacaoDados extends Banco {

    public function inserir_dados($tabela, $colunas) {
        $sql = "";
        $sql .= "INSERT INTO " . $tabela;
        $sql .= " (" . implode(",", array_keys($colunas)) . ") VALUES";
        $sql .= " ('" . implode("','", array_values($colunas)) . "')";
        return $this::query($sql);
    }

    public function excluir_dados($tabela, $id){
        $sql = "DELETE FROM $tabela WHERE id = $id";
        return $this::query($sql);
    }

    public function login_usuario($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        return $this::query($sql);
    }

    public function perfil_usuario($id) {
        $sql = "SELECT * FROM perfil WHERE id_usuario = $id";
        return $this::query($sql);
    }

    public function alterar_dados($id, $dados, $tabela) {
        $sql = "";
        $sql .= "UPDATE " . $tabela;
        $sql .= " SET ";
        foreach ($dados as $key => $value) {
            $sql .= $key . " = '" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " WHERE id_usuario = " . $id;
        echo $sql;
        return $this::query($sql);
    }

    public function buscar_produtos($id, $procura){
        $sql = "SELECT * FROM produtos WHERE nome LIKE '%$procura%' AND id_usuario != $id";
        return $this::query($sql);
    }

    public function buscar_produto($id){
        $sql = "SELECT * FROM produtos WHERE id = $id";
        return $this::query($sql);
    }

    public function meus_produtos($id){
        $sql = "SELECT * FROM produtos WHERE id_usuario = $id";
        return $this::query($sql);
    }

    public function buscar_compras($id){
        $sql = "SELECT v.valor as valort, v.data as data, v.quantidade as quantidade, p.nome as nome, p.descricao as descricao, p.valor as valorp FROM vendas as v, produtos as p WHERE v.id_comprador = $id AND v.id_produto = p.id";
        return $this::query($sql);
    }

}

if(!isset($_SESSION)){
    session_start();
}

$od = new OperacaoDados;

if (isset($_POST['btRegistrar'])) {

    if ($_POST["senha1"] != $_POST["senha2"]) {
        header("location: register.php?msg=2");
    } else {

        $senha_md5 = md5($_POST["senha1"]);

        $usuario = array(
            "nome" => $_POST["nome"],
            "senha" => $senha_md5,
            "email" => $_POST["email"],
            "cep" => $_POST["cep"],
            "classe" => $_POST["classe"],
            "cpf_cnpj" => $_POST["cpfcnpj"]
        );

        if ($od->inserir_dados("usuarios", $usuario)) {
            header("location: registro.php?msg=1");
        } else {
            header("location: registro.php?msg=0");
        }
    }
}
if (isset($_POST['btLogin'])) {

    echo "login";

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $senha_md5 = md5($senha);

    $result = $od->login_usuario($email, $senha_md5);

    if (!$result) {
        echo "erro login";
        header("location: login.php?msg=0");
    } else {
        echo "sucesso login";
        $dados = mysqli_fetch_array($result);
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        echo $_SESSION['nome'];
        header("location: home.php");
    }
}

if (isset($_POST['btAlterarDados'])) {

    $id = $_SESSION['id'];

    $caminho = 'uploads/'.$_FILES['imagem']['name'];

    move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);

    $dados = array();

    if($caminho != "uploads/"){
        $dados = array(
            "descricao" => $_POST["descricao"],
            "imagem" => $caminho
        );
    }else{
        $dados = array(
            "descricao" => $_POST["descricao"],
        );
    }

    $result = $od->alterar_dados($id, $dados, "perfil");
    if (!$result) {
        header("location: alterar_dados.php?msg=0");
    } else {
        header("location: alterar_dados.php?msg=1");
    }
}

if(isset($_POST['btCProduto'])){
    $produto = array(
        "nome" => $_POST["nome"],
        "quantidade" => $_POST["qtd"],
        "valor" => $_POST["valor"],
        "taxa_reducao" => $_POST["reducao"],
        "desconto" => $_POST["porcentagem"],
        "descricao" => $_POST["descricao"],
        "id_usuario" => $_SESSION['id']
    );

    if ($od->inserir_dados("produtos", $produto)) {
        header("location: vendas.php");
    } else {
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $result = $od->excluir_dados('produtos', $id);
    if(!$result){
        header("location: vendas.php?msg=0");
    }else{
        header("location: vendas.php?msg=1");
    }
}

if(isset($_POST['btComprar'])){

    $valor_total = $_POST['quantidade'] * $_POST['valor'];

    $compra = array(
        "id_comprador" => $_SESSION['id'],
        "id_vendedor" => $_POST['idvendedor'],
        "id_produto" => $_POST['idproduto'],
        "quantidade" => $_POST['quantidade'],
        "valor" => $valor_total,
        "data" => 'now()'

    );

    $result = $od->inserir_dados('vendas', $compra);
    if(!$result){
        header("location: produto.php?msg=0");
    }else{
        header("location: produto.php?msg=1");
    }
}

if(isset($_GET['logout'])){
    session_destroy();
    header("location: index.php");
}

?>