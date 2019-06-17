<?php
if (!isset($_SESSION)) {
    session_start();
}
//if (!isset($_SESSION['id'])) {
//    header("location: ../index.php");
//}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <link rel="icon" href="../img/favicon.ico" type="image/ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="../css/custom.css">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <title>Registro Usuário</title>
    </head>
    <body class="homeimg">
        <?php
        include_once '../Modelos/navB.php';
        ?>
        <main>
            <div class="row">
                <div class="container  col s4 push-s4 center hide-on-med-and-down">
                    <div class="card col s12  grey lighten-2" style="padding: 15px">
                        <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Criar conta</h4>
                        <form id="formulario" class="input-field col s12" method="post" action="../Controles/server.php">
                            <div class="input-field">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="nome" required="true"type="text" class="input-text">
                                        <label for="last_name">Nome Completo</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="email"required="true" type="text" class="input-text">
                                        <label for="email">Usuário</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="senha1"name="senha1"required="true" type="password" class="input-text">
                                        <label for="password">Senha</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="senha2"name="senha2"required="true" type="password" class="input-text" >
                                        <label id="label2"for="password">Repetir Senha</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <select name="level">                             
                                            <!--<option value="Administrador">Administrador</option>-->
                                            <option value="Usuario">Usuario</option>
                                        </select>
                                        <label>Nivel:</label>
                                    </div>
                                </div>
                                <input type="submit" name="btRegistrar" value="Confirmar" class="btn z-depth-3 black">
                                <a href="../index.php" class="btn z-depth-3 black">Cancelar</a>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $("#formulario").submit(function () {
                                        if ($("#senha1").val() == $("#senha2").val()) {
                                            return true;
                                        } else {
                                            alert("Você errou a senha!")
                                            $("#label2").text("Senha não coincide!")
                                            $("#senha2").attr("class", "input-text invalid");
                                            $("#senha2").click(function () {
                                                $("#label2").text("Repita a senha")
                                                $("#senha2").attr("class", "input-text");
                                            });
                                            return false;
                                        }
                                    });
                                });
                            </script>
                        </form>
                    </div>
                </div>

                <!--Mobile-->

                <div class="container  col s12 center hide-on-large-only">
                    <div class="card col s12  grey lighten-2" style="padding: 15px">
                        <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Criar conta</h4>
                        <form class="input-field col s12" method="post" action="../server.php">
                            <div class="input-field">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="nome" type="text" class="input-text">
                                        <label for="last_name">Nome Completo</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="email" type="text" class="input-text">
                                        <label for="email">Usuário</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input name="senha1" type="password" class="input-text">
                                        <label for="password">Senha</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input name="senha2" type="password" class="input-text">
                                        <label for="password">Repetir Senha</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <select name="level">                             
                                            <option value="Rui">Rui</option>
                                            <option value="Bolsista">Bolsista</option>
                                        </select>
                                        <label>Nivel:</label>
                                    </div>
                                </div>
                                <input type="submit" name="btRegistrar" value="Confirmar" class="btn z-depth-3">
                                <a href="../index.php" class="btn z-depth-3">Cancelar</a>
                            </div>
                        </form>
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