<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['id'])) {
    header("location: home.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="./css/custom.css">
        <link rel="icon" href="./img/favicon.ico" type="image/ico">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <title>CIET</title>


    </head>


    <body class="homeimg">
        <?PHP
        include_once './Modelos/navB.php';
        ?>
        <main>
            <div class="row hide-on-med-and-down">
                <div  class="card col s4 offset-s6 white absolut-center z-depth-5" class="valign-wrapper">
                    <form id="formulario" method="post" action="./Controles/server.php" class="col s12" style="padding: 20px">
                        <h4>Identifique-se</h4>
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="user" type="text" name="user">
                                    <label for="usuario">Usuario</label>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" name="password" class="input-text">
                                    <label for="password">Senha</label>
                                </div>
                            </div>
                            <a href="./Registros/registro.php" class="btn black">Registre-se</a>
                            <input type="submit" name="btLogin" value="Confirmar" class="btn z-depth-5 black">
                        </div>
                    </form>
                </div>
            </div>


            <!-- Mobile -->

            <div class="row hide-on-large-only">
                <div  class="card col s10 offset-s1 white valign-wrapper">
                    <form id="formulario" method="post" action="./Controles/server.php" class="col s12" style="padding: 20px">
                        <h4>Identifique-se</h4>
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="user" type="text" name="user">
                                    <label for="usuario">Usuario</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" name="password" class="input-text">
                                    <label for="password">Senha</label>
                                </div>
                            </div>
                            <input type="submit" name="btLogin" value="Confirmar" class="btn z-depth-8" style="margin-bottom: 10px">
                            <p class="teal-text center" style="margin-bottom: 8px"><a href="./Registros/registro.php">Registre-se</a></p>
                        </div>
                    </form>
                </div>
            </div>


        </main>
        <?PHP
        include_once './Modelos/footer.php';
        ?>
    </body>
</html>