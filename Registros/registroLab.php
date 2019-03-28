<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="icon" href="../img/favicon.ico" type="image/ico">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <title>Registrar Lab</title>
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
                <div class="container  col s4 push-s4 center">
                    <div class="card col s12  grey lighten-2" style="padding: 15px">
                        <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Cadastrar Laboratório</h4>
                        <form class="input-field col s12" method="post" action="../Controles/server.php">
                            <div class="input-field">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="nome" type="text" class="input-text">
                                        <label for="last_name">Nome</label>
                                    </div>
                                </div>
                                <input type="submit" name="btRegistrarLab" value="Confirmar" class="btn z-depth-3">
                                <a href="../home.php" class="btn z-depth-3">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?PHP
        include_once '../Modelos/footer.php  ';
        ?>
    </body>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
</html>
