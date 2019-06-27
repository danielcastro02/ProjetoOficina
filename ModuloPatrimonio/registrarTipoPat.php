<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<head>

    <title>EDITAR</title>
    <meta charset="utf-8"> 
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
    <main>
        <div class="row">
            <div class="container  col s4 push-s4 center hide-on-med-and-down">
                <div class="col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12  grey lighten-2 " style="padding: 15px">Criar Descrição Geral</h4>
                    <form class="input-field col s12" method="post" action="../Controle/descricaoControle.php?function=inserirDescricao">
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="nome" type="text" required="true" class="input-text">
                                    <label for="last_name">Nome</label>
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
                            <input type="submit" name="btRegistrarTipoPat" value="Confirmar" class="btn z-depth-3">
                            <a href="../index.php" class="btn z-depth-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!--Mobile-->

            <div class="container  col s12 center hide-on-large-only">
                <div class="col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12  grey lighten-2 " style="padding: 15px">Criar Descrição Geral</h4>
                    <form class="input-field col s12" method="post" action="server.php">
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="nome" type="text" class="input-text">
                                    <label for="last_name">Nome</label>
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
                            <input type="submit" name="btRegistrarTipoPat" value="Confirmar" class="btn z-depth-3">
                            <a href="index.php" class="btn z-depth-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <script type="text/javascript">
        $('#textarea1').val('');
        M.textareaAutoResize($('#textarea1'));</script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>