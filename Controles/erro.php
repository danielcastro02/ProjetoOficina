<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
?>

<html>
    <head>
        <meta charset="utf-8"> 
<link rel="icon" href="..//img/favicon.ico" type="image/ico">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="../css/custom.css">
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
        <div class="row" style="height: 200px;"></div>

        <div class="row absolut-center">
            <a class="btn" style="height: 115px" href="javascript:window.history.go(-1)">
                    <h4>ERRO!!!</h4>
                    <span>Continuar</span><i class="material-icons inline-icon" style="font-size: 25px">arrow_forward</i>
                </a>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>
<?php
include_once '../Modelos/footer.php';
?>
</html>


