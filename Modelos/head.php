<?php
if(realpath('../home.php')){
    $pontos = '.';
}else{
    $pontos = '';
}
?>
<meta charset="utf-8"> 
<link rel="icon" href="<?phpecho $pontos;?>./img/favicon.ico" type="image/ico">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="<?phpecho $pontos;?>./css/custom.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
