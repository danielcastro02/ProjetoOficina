<?php
if(!isset($_SESSION)){
    session_start();
}
if (realpath('../Controles/conexao.php')) {
    include_once '../Controles/conexao.php';
} else {
    include_once './Controles/conexao.php';
}

class dados {

    private $con;

    public function __construct() {
        $cone = new conexao();
        $this->con = $cone->getCon();
    }
    
    public function transact($sql){
       
    }

    public function query($sql) {
       
        return mysqli_query($this->con, $sql);
    }

    public function selectEvtGeral() {
        $sql = "select hi.*, ma.nome as nomemaq, la.nome as nomelab from laboratorios as la, maquinas as ma, historico as hi where hi.maq = ma.id and la.id = ma.lab order by situacao, hora desc;";
        return $this->query($sql);
    }
    public function comentMaq($sql){
        ?><script> alert("foi");</script><?php
        return $this->query($sql);
    }
    public function selectEvtGeralLab() {
        $sql = "select hi.*, la.nome as nomelab from laboratorios as la, evt_lab as hi where hi.lab = la.id order by status, hora desc;";
        return $this->query($sql);
    }

    public function buscarPats($var2, $var) {
        $sql = "select p.* , d.descricao, d.id as iddesc from patrimonio as p, descricao as d where d.id = p.id_desc and (pat like '%$var%' or p.nome like '%$var%' or localizacao like '%$var%') and localizacao like '%$var2%' ORDER BY p.nome;";
        return $this->query($sql);
    }
    
    
    public function regSugest($dados){
        $sql = "insert into sugestoes values (default,".$dados['id_user'].",'".$dados['nome']."','".$dados['page']."','".$dados['desc']."',default, default);";
        return $this->query($sql);
    }

    public function selectPats() {
        $sql = 'select p.*, d.descricao from patrimonio as p, descricao as d where d.id = p.id_desc ORDER BY p.localizacao, p.nome;';
        return $this->query($sql);
    }

    public function buscar_descs() {
        $sql = 'select * from descricao;';
        return $this->query($sql);
    }

    public function inserir_dados($tabela, $colunas) {

        $sql = "";
        $sql .= "INSERT INTO " . $tabela;
        $sql .= " values ('" . implode("','", array_values($colunas)) . "');";
        //echo $sql;
        return $this->query($sql);
    }

    public function excluir_dados($tabela, $id) {
        $sql = "DELETE FROM $tabela WHERE id = $id";
        return $this::query($sql);
    }

    public function login_usuario($email, $senha) {
        $sql = "SELECT * FROM users WHERE user = '$email' AND password = '$senha'";
        return $this->query($sql);
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
        return $this->query($sql);
    }

    public function buscar_labs() {
        $sql = "SELECT * FROM laboratorios;";
        return $this->query($sql);
    }

    public function selectMaq() {
        $sql = "SELECT ma.id, ma.nome, ma.maq, la.nome as nomelab, ma.situacao , ma.patrimonio as patrimonio, ma.w_serial from maquinas as ma, laboratorios as la where la.id = ma.lab;";
        return $this->query($sql);
    }

    public function selectNot($id) {
        $sql = "select count(id) as numero from historico where maq = $id and situacao = 'Ativa';";
        return $this->query($sql);
    }
    public function comentar($id) {
        $sql = "insert into comentarios values(default, ".$id['idprob'].",". $_SESSION['id'].",". $id['comentario'].";";
        return $this->query($sql);
    }

    public function selectMaqLab($lab, $nome) {
        if($lab == "" && $nome == ""){
            return $this->selectMaq();
        }
        if ($lab == "") {
            $sql = "SELECT ma.id, ma.nome, ma.maq, la.nome as nomelab,ma.situacao , ma.patrimonio as patrimonio, ma.w_serial from maquinas as ma, laboratorios as la where la.id = ma.lab and ma.nome like '%$nome%';";
        } else {
            if ($nome == "") {
                $sql = "SELECT ma.id, ma.nome, ma.maq, la.nome as nomelab,ma.situacao , ma.patrimonio as patrimonio, ma.w_serial from maquinas as ma, laboratorios as la where la.id = ma.lab and la.id = $lab;";
            } else {
                $sql = "SELECT ma.id, ma.nome, ma.maq, la.nome as nomelab,ma.situacao , ma.patrimonio as patrimonio, ma.w_serial from maquinas as ma, laboratorios as la where la.id = ma.lab and la.id = $lab and ma.nome like '%$nome%';";
            }
        }
        return $this->query($sql);
    }

    public function selectLab() {
        return $this->buscar_labs();
    }

    public function selectMaqId($id) {
        $sql = "select maquinas.*, laboratorios.nome as nomelab from maquinas, laboratorios where maquinas.id = $id and laboratorios.id = maquinas.lab;";
        return $this->query($sql);
    }

    public function selectMaqConcat($id) {
        $sql = "select maquinas.*, laboratorios.nome as nomelab from maquinas, laboratorios where concat(laboratorios.id, maquinas.nome) like '%$id%' and laboratorios.id = maquinas.lab;";
        return $this->query($sql);
    }

    public function updateMaq($dados) {
        $sql = "update maquinas set nome = '" . $dados['nome'] . "', lab = " . $dados['lab'] . ", patrimonio = '" . $dados['patrimonio'] . "', n_serie ='" . $dados['n_serie'] . "'"
                . ", w_serial ='" . $dados['w_serial'] . "', situacao ='" . $dados['situacao'] . "', maq  = '" . $dados['maq'] . "' where id =" . $dados['id'] . ";";
        return $this->query($sql);
    }

    public function updatePat($dados) {
        $sql = "update patrimonio set pat = '".$dados['pat']."', nome = '" . $dados['nome'] . "', id_desc = " . $dados['desc'] . ", localizacao = '" . $dados['localizacao'] . "', estado ='" . $dados['estado'] . "' where pat like'%" . $dados['oldpat'] . "%';";
        
        return $this->query($sql);
    }

    public function selectLabId($var) {
        $sql = "select * from laboratorios where id = $var;";
        return $this->query($sql);
    }

    public function selectSoft($var) {
        $sql = "select * from softwares where lab = $var;";
        return $this->query($sql);
    }

    public function buscaMaqes($var) {
        $sql = "select ma.id, ma.maq, ma.nome as nome, la.nome as lnome from maquinas as ma, laboratorios as la where ma.lab = la.id and (ma.nome like '%$var%' or ma.maq like '%$var%' or la.nome like '%$var%') ";
        //echo $sql;  
        return $this->query($sql);
    }

    public function buscaLabes($var) {
        $sql = "select * from laboratorios where nome like '%$var%';";
        return $this->query($sql);
    }

    public function buscaPates($var) {
        $sql = "select * from patrimonio where nome like '%$var%' or pat like '%$var%' or localizacao like '%$var%';";
        return $this->query($sql);
    }

    public function insertHistorico($dados) {
        $sql = "insert into historico values(default,'" . $dados["nome"] . "','" . $dados["maq"] . "', default,'" . $dados["situacao"] . "');";
        return $this->query($sql);
    }

    public function selectEvt($var) {
        $sql = "select * from historico where maq = $var order by hora desc;";
        return $this->query($sql);
    }

    public function insertEvtLab($dados) {
        $sql = "insert into evt_lab values(default," . $dados["maq"] . ",'" . $dados["nome"] . "', default,'" . $dados["situacao"] . "');";
        return $this->query($sql);
    }

}
