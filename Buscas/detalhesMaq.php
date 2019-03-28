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
    include_once '../Controles/server.php';
    $result = $d->selectMaqId($_GET['msg']);
    $maq = mysqli_fetch_array($result);
    ?>
    <main>
        <div class="row">
            <div class="container  col s4 push-s4 center hide-on-med-and-down">
                <div class="card col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Editar Maquina</h4>
                    <form class="input-field col s12" method="post" action="../Controles/server.php">
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s4">
                                    <select name="lab">                             
                                        <?php
                                        $d = new dados();
                                        $result = $d->buscar_labs();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option <?php
                                                if ($row['id'] == $maq['lab']) {
                                                    echo 'selected';
                                                }
                                                ?> value="<?php echo $row["id"]; ?>"><?php echo $row["nome"]; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                    <label>Laboratório: *</label>
                                </div>


                                <div class="input-field col s4">
                                    <input name="nome" type="text" value="<?php echo $maq['nome'] ?>" class="input-text">
                                    <label for="last_name">Nome *</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="situacao">                             
                                        <option value="Funcionando">Funcionando</option>
                                        <option value="Problema!">Problema</option>
                                    </select>
                                    <label>Situação: *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input name="maq" type="text" value="<?php echo $maq['maq'] ?>"class="input-text">
                                    <label for="maq">MAQ</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input name="w_serial" type="text" value="<?php echo $maq['w_serial'] ?>"class="input-text">
                                    <label for="email">Serial Windows</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="n_serie" type="password" value="<?php echo $maq['n_serie'] ?>"class="input-text">
                                    <label for="password">Numero de Série</label>
                                </div>
                                <div class="input-field col s6">
                                    <input name="patrimonio" type="text" value="<?php echo $maq['patrimonio'] ?>"class="input-text">
                                    <label for="password">Patrimônio</label>
                                </div><span class="red-text">Campos com * são obrigatórios!</span>
                            </div>

                            <input name='id' value="<?php echo $maq['id'] ?>" hidden="true"/>
                            <input type="submit" name="btUpdateMaq" value="Confirmar" class="btn z-depth-3">
                            <a href="../index.php" class="btn z-depth-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!--
            Mobile             
            -->


            <div class="container  col s12 center hide-on-large-only">
                <div class="card col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Editar Maquina</h4>
                    <form class="input-field col s12" method="post" action="server.php">
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s4">
                                    <select name="lab">                             
                                        <?php
                                        $d = new dados();
                                        $result = $d->buscar_labs();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option <?php
                                                    if ($row['id'] == $maq['lab']) {
                                                        echo 'selected';
                                                    }
                                                    ?> value="<?php echo $row["id"]; ?>"><?php echo $row["nome"]; ?></option>
        <?php
    }
}
?>
                                    </select>
                                    <label>Laboratório: *</label>
                                </div>


                                <div class="input-field col s4">
                                    <input name="nome" type="text" value="<?php echo $maq['nome'] ?>" class="input-text">
                                    <label for="last_name">Nome *</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="situacao">                             
                                        <option value="Funcionando">Funcionando</option>
                                        <option value="Problema!">Problema</option>
                                    </select>
                                    <label>Situação: *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input name="maq" type="text" value="<?php echo $maq['maq'] ?>"class="input-text">
                                    <label for="maq">MAQ</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input name="w_serial" type="text" value="<?php echo $maq['w_serial'] ?>"class="input-text">
                                    <label for="email">Serial Windows</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="n_serie" type="password" value="<?php echo $maq['n_serie'] ?>"class="input-text">
                                    <label for="password">Numero de Série</label>
                                </div>
                                <div class="input-field col s6">
                                    <input name="patrimonio" type="text" value="<?php echo $maq['patrimonio'] ?>"class="input-text">
                                    <label for="password">Patrimônio</label>
                                </div><span class="red-text">Campos com * são obrigatórios!</span>
                            </div>

                            <input name='id' value="<?php echo $maq['id'] ?>" hidden="true"/>
                            <input type="submit" name="btUpdateMaq" value="Confirmar" class="btn z-depth-3">
                            <a href="index.php" class="btn z-depth-3">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });

        $(document).ready(function () {
            $('.collapsible').collapsible();
        });
    </script>
<?php
include_once '../Modelos/footer.php';
?>
</body>
