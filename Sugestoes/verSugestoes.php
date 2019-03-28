<?php
if (!isset($_SESSION)) {
    session_start();
    if($_SESSION['id']!=11){
        header("location: ../index.php");
    }
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"> 
    <title>Eventos Recentes</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="icon" href="../img/favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
</head>
<body class="homeimg">
    <?php
    include_once '../Modelos/navGeral.php';
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });
    </script>
    <?php
    include_once '../Controles/dados.php';
    $d = new dados();
    ?>
    <main>
        <div class="row"></div>
        <div class="row container">

            <div class="card col s12 grey lighten-2 hide-on-med-and-down">
                <div class="row">
                    <h4>Lista de Sugestões <?php ?></h4>
                </div>
                <div class="row">
                    <ul class="bordered striped collapsible popout grey lighten-2">
                        <?php
                        $result = $d->query("select s.*, u.nome as nomeus from sugestoes as s, users as u where u.id = s.id_user order by status, hora desc;");
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="collection-item">
                                        <div class="collapsible-header grey lighten-2 left-align">

                                            <div><span style=":first-letter{text-transform: uppercase}"><?php
                                                    $dados = explode(" ", $row['hora']);
                                                    $arraydata = explode("-", $dados['0']);
                                                    $row['hora'] = $arraydata["2"] . "/" . $arraydata["1"] . "/" . $arraydata["0"] . " | " . $dados["1"];
                                                    echo $row['hora'] . " | " . $row['pagina'] . " | ";
                                                    echo $row['nomeus']
                                                    ?>
                                                    <i class="material-icons">expand_more</i>
                                                </span>
                                                <div class="secondary-content">
                                                    <?php
                                                    if ($row['status'] == 'Ativa') {
                                                        ?><span class="new badge red darken-3 no-padding" data-badge-caption="Ativa"></span></a><?php
                                                    } else {
                                                        if ($row['status'] == 'Em andamento') {
                                                            ?><span class="new badge yellow darken-3" data-badge-caption="Resolvendo"></span></a><?php
                                                        }
                                                        ?><?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapsible-body grey lighten-3 left-align">
                                            <h5 class="left-align">Descrição:</h5>
                                            <p class="left-align">
                                                <?php
                                                echo $row['descricao'];
                                                ?>
                                            </p>
                                            <div class="row">
                                                <div class="col s12">
                                                    <form class="input-field" method="post" action="../Controles/server.php">
                                                        <input name="idprob" value="<?php echo $row['id'] ?>" type="text" hidden="true"/>
                                                        <button type="submit"class="btn green" name="btResolvidoSug" value="Resolvido">Resolvido</button>
                                                        <button type="submit"class="btn yellow darken-3" name="btAndamentoSug" value="Andando">Em andamento</button>
                                                        <button type="submit"class="btn red darken-3" name="btProblemaSug" value="Ativa">Problema</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <p class="red-text">Nada relatado!</p>
                                <?php
                            }
                            ?>
                            </div>
                            </div>
                            </div>

                            </main>
                            <?php
                            include_once '../Modelos/footer.php';
                            ?>
                            </body>