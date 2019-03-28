<?php
try {
    include_once '../Controles/dados.php';
    $pontos = '.';
} catch (Exception $e) {
    try {
        include_once './Controles/dados';
        $pontos = '';
    } catch (Exception $ex) {
        
    }
}
$d = new dados();
if (isset($_POST['textdesc'])) {
    if ($_POST['nomedesc'] != "") {
        try {
            $pdo = new PDO("mysql:host=200.132.17.18;dbname=oficina", "dcastro", "Class.7ufo");
            $pdo->beginTransaction();
            $pdo->exec("set @a := (select max(id) from descricao);");
            $pdo->exec("insert into descricao values (@a+1, '" . $_POST['nomedesc'] . "','" . $_POST['textdesc'] . "');");
            $pdo->exec("insert into patrimonio values('" . $_POST['pat'] . "', '" . $_POST['nome'] . "',@a+1,'" . $_POST['localizacao'] . "','" . $_POST['estado'] . "');");
            $pdo->commit();
            echo "Inserido com Sucesso";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        if ($d->query("insert into patrimonio values('" . $_POST['pat'] . "', '" . $_POST['nome'] . "'," . $_POST['desc'] . ", '" . $_POST['localizacao'] . "','" . $_POST['estado'] . "');")) {
            echo "Inserido com Sucesso";
        } else {
            echo "Erro!";
        }
    }
}


if (isset($_POST["deletar"])) {
    $d->query("delete from comentarios_maq where id = " . $_POST['deletar'] . ";");
}
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['idpatcoment'])) {
    $sql = "insert into comentario_pat values(default, '" . $_POST['idpatcoment'] . "'," . $_SESSION['id'] . ",'" . $_POST['comentario'] . "', default);";
    if ($d->query($sql)) {
        header("location: " . $pontos . "./Eventos/EventosRecentesMaq.php?maq=" . $_POST['idprob']);
    } else {
        header('./erro.php');
    }
}

if (isset($_POST['idprob'])) {
    $sql = "insert into comentarios_maq values(default, " . $_POST['idprob'] . "," . $_SESSION['id'] . ",'" . $_POST['comentario'] . "', default);";
    if ($d->query($sql)) {
        header("location: " . $pontos . "./Eventos/EventosRecentesMaq.php?maq=" . $_POST['idprob']);
    } else {
        header('./erro.php');
    }
}

if (isset($_POST['idprobLab'])) {
    if ($d->query("insert into comentarios_lab values(default," . $_POST['idprobLab'] . "," . $_SESSION['id'] . ",'" . $_POST['comentario'] . "',default);")) {
        header('location: ' . $pontos . './Eventos/EventosRecentesLab.php');
    } else {
        header('location: ' . $pontos . './Controles/Erro.php');
    }
}

if (isset($_POST['btRegistrarMaq'])) {
    $dados = array(
        "id" => "default",
        "lab" => $_POST['lab'],
        "nome" => $_POST['nome'],
        "patrimonio" => $_POST['patrimonio'],
        "n_serie" => $_POST['n_serie'],
        "w_serial" => $_POST['w_serial'],
        "situacao" => $_POST['situacao'],
        "maq" => $_POST['maq']
    );
//print_r($dados);
    if ($d->inserir_dados("maquinas", $dados)) {
        header("location: $pontos./Controles/sucesso.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}


if (isset($_POST['btRegSugest'])) {
    $dados = array(
        "id_user" => $_SESSION['id'],
        "nome" => $_POST['nome'],
        "desc" => $_POST['descricao'],
        "page" => $_POST['pagina']
    );
    if ($d->regSugest($dados)) {
        header("location: $pontos./Controles/sucesso.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

function selectMaq() {
    $result = $d->selectMaq();
    return $result;
}

if (isset($_POST['btUpdateMaq'])) {
    $dados = array(
        "id" => $_POST['id'],
        "lab" => $_POST['lab'],
        "nome" => $_POST['nome'],
        "patrimonio" => $_POST['patrimonio'],
        "n_serie" => $_POST['n_serie'],
        "w_serial" => $_POST['w_serial'],
        "situacao" => $_POST['situacao'],
        "maq" => $_POST['maq']
    );
//print_r($dados);
    if ($d->updateMaq($dados)) {
        header("location: $pontos./Buscas/consultaMaq.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}
if (isset($_POST['btRegistrar'])) {

    if ($_POST['senha1'] != $_POST['senha2']) {
        header("location: $pontos./Registros/registro.php?msg=1");
    } else {

        $senha = md5($_POST['senha1']);
        $dados = array(
            "id" => "default",
            "user" => $_POST['email'],
            "password" => $senha,
            "nome" => $_POST['nome'],
            "level" => $_POST['level']
        );
        if ($d->inserir_dados("users", $dados)) {
            ?><SCRIPT>alert("foi")</script><?php
            header('location: ' . $pontos . './index.php');
        } else {
            header('location: ' . $pontos . './Registro/registro.php?msg=2');
        }
    }
}

if (isset($_POST['btRegistrarLab'])) {
    $dados = array(
        "id" => "default",
        "nome" => $_POST['nome'],
        "maqs" => 0,
        "prob" => 0
    );
    if ($d->inserir_dados("laboratorios", $dados)) {
        header('location: ' . $pontos . './Controles/sucesso.php');
    } else {
        header('location: ' . $pontos . './Controles/erro.php');
    }
}

if (isset($_POST['btLogin'])) {
    $_POST['user'] = preg_replace('/[^[:alpha:]_]/', '', $_POST['user']);

    $result = $d->login_usuario($_POST['user'], md5($_POST['password']));
    if (!$result) {
        header('location: index.php?msg=1');
    } else {
        $dados = mysqli_fetch_array($result);
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['level'] = $dados['level'];
        header('location: ' . $pontos . './home.php');
    }
}

if (isset($_POST['btRegistrarTipoPat'])) {
    $dados = array(
        "id" => 'default',
        "nome" => $_POST['nome'],
        "desc" => $_POST['descricao']
    );

    if ($d->inserir_dados('descricao', $dados)) {
        header('location: ' . $pontos . './Controles/sucesso.php?msg=descPat');
    } else {
        header('location: ' . $pontos . './Controles/erro.php');
    }
}


if (isset($_POST['btUpdatePat'])) {
    $dados = array(
        'oldpat' => $_POST['oldpat'],
        'pat' => $_POST['pat'],
        'nome' => $_POST['nome'],
        'desc' => $_POST['desc'],
        'localizacao' => $_POST['localizacao'],
        'estado' => $_POST['estado']
    );
    if ($d->updatePat($dados)) {
        header('location: ' . $pontos . './Controles/sucesso.php?msg=updPat');
    } else {
        header('location: ' . $pontos . './Controles/erro.php');
    }
}

if (isset($_POST['btRegistrarSoft'])) {
    $dados = array(
        'id' => 'default',
        'lab' => $_POST['lab'],
        'nome' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'instalacao' => 'false'
    );
    if ($d->inserir_dados('softwares', $dados)) {
        header('location: ' . $pontos . './Controles/sucesso.php');
    } else {
        header('location: ' . $pontos . './Controles/erro.php');
    }
}


if (isset($_POST['btInsereEventMaq'])) {
    $dados = array(
        'id' => 'default',
        'nome' => $_POST['nome'],
        'maq' => $_POST['idmaq'],
        'hora' => 'default',
        'situacao' => $_POST['situacao']
    );
    $d->insertHistorico($dados);
    $var = $_POST['statsmaq'];
    $id = $_POST['idmaq'];
    $d->query("insert into comentarios_maq values (default, (select id from historico order by hora desc limit 1)," . $_SESSION['id'] . ",'" . $_POST['descricao'] . "',default);");
    $d->query("update maquinas set situacao = '$var' where id = $id;");
    header('location: ' . $pontos . './Controles/sucesso.php');
}

if (isset($_POST['btInsereEventLab'])) {
    $dados = array(
        'id' => 'default',
        'nome' => $_POST['nome'],
        'maq' => $_POST['idlab'],
        'hora' => 'default',
        'descricao' => $_POST['descricao'] . "<br>Usuário: " . $_SESSION['nome'] . "<br>",
        'situacao' => $_POST['situacao']
    );

    if ($d->insertEvtLab($dados)) {
        $d->query("insert into comentarios_lab values(default, (select id from evt_lab order by hora desc limit 1;)," . $_SESSION['id'] . ",'" . $_POST['descricao'] . "', default);");
        header('location: ' . $pontos . './Controles/sucesso.php');
    } else {
        header('location: ' . $pontos . './Controles/erro.php');
    }
}

if (isset($_POST['btResolvido'])) {
    $dados = $_POST['idprob'];
    $id = mysqli_fetch_array($d->query("select maq from historico where id = $dados;"))['maq'];
    $d->query("update maquinas set situacao = 'Funcionando' where id = $id;");
    if ($d->query("update historico set situacao = 'Resolvido' where id = $dados;")) {
        if ($_POST['btResolvido'] == 'Resolvido2') {
            header("location: $pontos./Buscas/verProblema.php?msg=" . $_POST['idmaq']);
        } else {
            header("location: $pontos./Eventos/EventosRecentesMaq.php");
        }
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btProblema'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update historico set situacao = 'Ativa' where id = $dados;")) {
        if ($_POST['btProblema'] == 'Problema2') {
            header("location: $pontos./Buscas/verProblema.php?msg=" . $_POST['idmaq']);
        } else {
            header("location: $pontos./Eventos/EventosRecentesMaq.php");
        }
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btAndamento'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update historico set situacao = 'Em andamento' where id = $dados;")) {
        if ($_POST['btAndamento'] == 'Andando2') {
            header("location: $pontos./Buscas/verProblema.php?msg=" . $_POST['idmaq']);
        } else {
            header("location: $pontos./Eventos/EventosRecentesMaq.php");
        }
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btResolvidoLab'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update evt_lab set status = 'Resolvido' where id = $dados;")) {
        header("location: $pontos./Eventos/EventosRecentesLab.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btProblemaLab'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update evt_lab set status = 'Ativa' where id = $dados;")) {
        header("location: $pontos./Eventos/EventosRecentesLab.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btAndamentoLab'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update evt_lab set status = 'Em andamento' where id = $dados;")) {
        header("location: $pontos./Eventos/EventosRecentesLab.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btResolvidoSug'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update sugestoes set status = 'Resolvido' where id = $dados;")) {
        header("location: $pontos./Sugestoes/verSugestoes.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btProblemaSug'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update sugestoes set status = 'Ativa' where id = $dados;")) {
        header("location: $pontos./Sugestoes/verSugestoes.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}

if (isset($_POST['btAndamentoSug'])) {
    $dados = $_POST['idprob'];
    if ($d->query("update sugestoes set status = 'Em andamento' where id = $dados;")) {
        header("location: $pontos./Sugestoes/verSugestoes.php");
    } else {
        header("location: $pontos./Controles/erro.php");
    }
}


if (isset($_GET['logout'])) {
    session_destroy();
    header("location: " . $pontos . "./index.php");
}
    