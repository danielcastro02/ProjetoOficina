<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
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
    <?php
    include_once '../Controles/dados.php';
    $d = new dados();
    $result = $d->selectLabId($_GET['msg']);
    $maq = mysqli_fetch_array($result);
    ?>
    <main>
        <div class="row"></div>
        <div class="row">
            <div class="container  col s4 push-s4 center hide-on-med-and-down">
                <div class="card col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Adicionar Evento</h4>
                    <form class="input-field col s12" method="post" action="../Controles/server.php">
                        <div class="input-field">
                            <input type="text" hidden="true" value="<?php echo $_GET['msg'] ?>" name="idlab"/>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" value="<?php echo $maq['nome'] ?>" disabled="true" name="nomeMaq"/>
                                    <label>Laboratório:</label>
                                </div>

                                <div class="input-field col s6">
                                    <select name="situacao">                             
                                        <option selected="true" value="Ativa">Ativa</option>
                                        <option value="Resolvido">Resolvido</option>
                                    </select>
                                    <label>Situação: *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" name="nome"/>
                                    <label>Nome</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" name="descricao" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Descrição</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a href="../home.php" class="btn">Cancelar</a>
                                <button type="submit" class="btn" name="btInsereEventLab">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('select').material_select();
            });

            $(document).ready(function () {
                $('.collapsible').collapsible();
            });
        </script>
    </main>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>