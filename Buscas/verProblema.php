<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
include_once '../Controles/dados.php';
$d = new dados();
$result = $d->selectMaqId($_GET['msg']);
$maq = mysqli_fetch_array($result);
?>

<head>
    <meta charset="utf-8"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="icon" href="../img/favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <title>EDITAR</title>

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
    <main>
        <div class="row"></div>
        <div class="row container">

            <div class="card col s12 grey lighten-2 hide-on-med-and-down">
                <div class="row">
                    <h4>Lista de Eventos <?php
                        echo $maq['nomelab'] . $maq['nome'];
                        ?></h4>
                </div>
                <div class="row">
                    <ul class="bordered striped collapsible popout grey lighten-2">
                        <?php
                        $result = $d->selectEvt($_GET['msg']);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <li class="collection-item">
                                    <div class="collapsible-header grey lighten-2">

                                        <div><span style=":first-letter{text-transform: uppercase}"><?php
                                                echo $row['hora'] . "/";
                                                echo $row['nome']
                                                ?>
                                                <i class="material-icons">expand_more</i>
                                            </span>
                                            <div class="secondary-content">
                                                <?php
                                                if ($row['situacao'] == 'Ativa') {
                                                    ?><span class="new badge red darken-3" data-badge-caption="Ativa"></span><?php
                                                } else {
                                                    if ($row['situacao'] == 'Em andamento') {
                                                        ?><span class="new badge yellow darken-3" data-badge-caption="Resolvendo"></span><?php
                                                    }
                                                    ?><?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapsible-body grey lighten-3">
                                        <h5 class="left-align">Comentários:</h5>
                                        <p class="left-align">
                                            <?php
                                            echo $row['descricao'];
                                            ?>
                                        </p>
                                        <div class="row">
                                            <div class="col s12">
                                                <form class="input-field col s12" method="post" action="../Controles/server.php">
                                                    <input class="col s10" name="idprob" value="<?php echo $row['id'] ?>" type="text" hidden="true"/>
                                                    <div class="input-field">
                                                        <input type="text" class="col s10" name="comentario" id="comentario"/>
                                                        <label>Adicionar Comentário</label>
                                                    </div>
                                                    <input name="idprob" value="<?php echo $row['id'] ?>" type="text" hidden="true"/>
                                                    <button type="submit"class="btn" name="btComentar" value="Resolvido"><i class="material-icons">arrow_forward</i></button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <form class="input-field" method="post" action="../Controles/server.php">
                                                    <input name="idmaq" value="<?php echo $_GET['msg'] ?>" type="text" hidden="true"/>
                                                    <input name="idprob" value="<?php echo $row['id'] ?>" type="text" hidden="true"/>
                                                    <button type="submit"class="btn green" name="btResolvido" value="Resolvido2">Resolvido</button>
                                                    <button type="submit"class="btn yellow darken-3" name="btAndamento" value="Andando2">Em andamento</button>
                                                    <button type="submit"class="btn red darken-3" name="btProblema" value="Problema2">Problema</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            ?>
                            <p class="red-text">Nada relatado!</p>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>