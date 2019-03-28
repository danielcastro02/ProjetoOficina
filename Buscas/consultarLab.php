<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
}
include_once '../Controles/server.php';
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="icon" href="../img/favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <title>Ciet - Consulta Lab</title>
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
        <div class="row"></div>
        <div class="row container">

            <div class="card col s6  grey lighten-2 offset-s3 hide-on-med-and-down">
                <div class="row">
                    <h4>Lista de Laboratórios</h4>
                </div>
                <div class="row">
                    <table class="bordered striped" style="font-size: 20px">
                        <thead>
                            <tr style="margin-left: 1%; margin-right: 1% ;">
                                <th>Nome</th>
                                <th class="center-align">Quantidade de Maquinas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $d->selectLab();
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr style="margin-left: 2%; margin-right: 1% ;">
                                        <td style=":first-letter{text-transform: uppercase}"><b><?php
                                                echo $row['nome'];
                                                ?>
                                            </b></td>
                                        <td class="center-align">
                                            <?php echo $row['n_maquinas']; ?>
                                        </td>

                                        <td>
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatar evento" href="../Eventos/regeventlab.php?msg=<?php echo $row['id']; ?>" class="">
                                                <i class="material-icons black-text">assignment_late</i>
                                            </a>
                                            <a href="listaSoft.php?msg=<?php echo $row['id']; ?>" class="tooltipped" data-tooltip="Lista de Softwares.">
                                                <i class="material-icons">assignment</i>
                                            </a></td>
                                        <td>
                                            <form method="post" action="consultaMaq.php">
                                                <input type="text" name="lab" value="<?php echo $row['id']; ?>" hidden="true"/>
                                                <input type="text" name="nome" value="" hidden="true"/>

                                                <button type="submit" name="btBuscarMaq" value="Buscar" class="" style="border: none; background: none">
                                                    <i class="material-icons">send</i>
                                                </button>
                                            </form>
                                        </td>
                                        <?php
                                    }
                                }
                                ?>

                        </tbody>
                    </table>
                </div>
            </div>



            <!--Div para mobile-->

            <div class="card col grey lighten-2 s12  hide-on-large-only">
                <div class="row">
                    <h4>Lista de Laboratórios</h4>
                </div>
                <div class="row">
                    <table class="bordered striped  grey lighten-2" style="font-size: 20px">
                        <thead>
                            <tr style="margin-left: 1%; margin-right: 1% ;">
                                <th>Nome</th>
                                <th class="center-align">Qtd Maq</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $d->selectLab();
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr style="margin-left: 2%; margin-right: 1% ;">
                                        <td style=":first-letter{text-transform: uppercase}"><b><?php
                                                echo $row['nome'];
                                                ?>
                                            </b></td>
                                        <td class="center-align">
                                            <?php echo $row['n_maquinas']; ?>
                                        </td>
                                        <td><a href="listaSoft.php?msg=<?php echo $row['id']; ?>" class="tooltipped" data-position="left" data-tooltip="Lista de Softwares.">
                                                <i class="material-icons">assignment</i>
                                            </a></td>
                                        <td>
                                            <form method="post" action="consultaMaq.php">
                                                <input type="text" name="lab" value="<?php echo $row['id']; ?>" hidden="true"/>
                                                <input type="text" name="nome" value="" hidden="true"/>

                                                <button type="submit" name="btBuscarMaq" value="Buscar" class="" style="border: none; background: none">
                                                    <i class="material-icons">send</i>
                                                </button>
                                            </form>
                                        </td>
                                        <?php
                                    }
                                }
                                ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
        $(document).ready(function () {
            $('.tooltipped').tooltip({delay: 10});

        });
    </script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>

