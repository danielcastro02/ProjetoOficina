<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"> 
    <link rel="icon" href="ProjetoOficinaL/img/favicon.ico" type="image/ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="icon" href="img/favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <title>EDITAR</title>

</head>
<body class="homeimg">

<?php
include_once '../Modelos/navGeral.php';
?>
    <main>


    </main>
    <?php
    include_once './footer.php';
    ?>
</body>