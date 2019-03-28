<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}
?>

<html>
    <head>
        <meta charset="utf-8"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="icon" href="..img/favicon.ico" type="image/ico">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <title>Sucesso!</title>
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

            <div class="row" style="height: 200px;"></div>

            <div class="row absolut-center">
                <div class="row">
                    <div class="card col s12">
                        <div class="row">
                            <h4>Inserido com sucesso!</h4>
                        </div>
                        <div class="row">
                            <a class="btn col s10 offset-s1" href="../home.php">
                                <span>Inicio</span><i class="material-icons inline-icon" style="font-size: 25px">arrow_forward</i>
                            </a>
                        </div>
                        <div class="row">
                            <form action="javascript:window.history.go(-1)">
                                <button tabindex="1" class="btn col s10 offset-s1">Registrar Outro<i class="material-icons inline-icon" style="font-size: 25px">arrow_forward</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include_once '../Modelos/footer.php';
        ?>
    </body>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
</html>

