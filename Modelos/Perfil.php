<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}
?>
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
</head>

<body style="background-image: url('./img//bg2.jpg')"> 
    <?php
include_once '../Modelos/navGeral.php';
?>
    <div class="row">
        <div class="col s6">
            <img src="img/dog_perfil.jpeg" id="foto_de_perfil">
        </div>
        <div class="col s6 ">
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <li id="meu_nome" class="truncate">Meu Nome Completo</li>
            <li id="meu_curso" class="truncate">Nome por extenso do meu curso</li>
        </div>
    </div>

</body>


