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
    <?php
    if (isset($_GET['msg'])) {
        $_POST['btBuscarMaq'] = "sla";
        $_POST['lab'] = $_GET['msg'];
        $_POST['nome'] = "";
    }
    ?>
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

            <div class="card col s12 grey lighten-2 hide-on-med-and-down">
                <div class="row">
                    <h4>Lista de Maquinas</h4>
                </div>
                <div class="row">
                    <form class="input-field col s6 offset-s3" method="post" action="./consultaMaq.php">
                        <div class="input-field col s4">
                            <select id="selecionador" name="lab">
                                <option value="">Nenhum</option>
                                <?php
                                $resulte = $d->buscar_labs();

                                if (mysqli_num_rows($resulte) > 0) {
                                    while ($row = mysqli_fetch_assoc($resulte)) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row["nome"]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <label>Laboratório:</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="numero" type="text" name="nome" value="">
                            <label for="nome">Numero</label>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn black" type="submit" name="btBuscarMaq" value="Buscar">Buscar</button>
                        </div>

                    </form>
                </div>
                <div id="busca" class="row">
                    <ul class="bordered striped collapsible popout grey lighten-2">
                        <?php
                        if (isset($_POST['btBuscarMaq'])) {
                            $result = $d->selectMaqLab($_POST['lab'], $_POST['nome']);
                        } else {
                            $result = $d->selectMaq();
                        }
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <li class="collection-item">
                                    <div class="collapsible-header grey lighten-2">

                                        <div><span style=":first-letter{text-transform: uppercase}"><?php
                                                echo $row['nomelab'];
                                                echo $row['nome']
                                                ?>
                                                <i class="material-icons">expand_more</i>
                                            </span>
                                            <div class="secondary-content">
                                                <?php
                                                $not = $d->selectNot($row['id']);
                                                if ($not) {
                                                    $num = mysqli_fetch_array($not);
                                                    if ($num['numero'] > 0) {
                                                        ?><a href="./verProblema.php?msg=<?php echo $row['id']; ?>"><span class="new badge red"  data-badge-caption="Problemas"><?php echo $num['numero']; ?></span></a><?php
                                                    } else {
                                                        ?><span class="new badge transparent transparent-text"  data-badge-caption="Problemas">0</span><?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapsible-body">
                                        <table class="striped">
                                            <tr>
                                                <td>MAC:<?php echo " " . $row['maq']; ?></td>
                                                <td>
                                                    Serial Windows: <?php echo " " . $row['w_serial']; ?>
                                                </td>
                                                <td>
                                                    Patrimônio: <?php echo " " . $row['patrimonio'] ?>
                                                </td>
                                                <td>
                                                    Status: <?php
                                                    echo $row['situacao'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatar evento" href="../Eventos/regeventmaq.php?msg=<?php echo $row['id']; ?>" class="">
                                                        <i class="material-icons black-text">assignment_late</i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="./detalhesMaq.php?msg=<?php echo $row['id']; ?>" class="">
                                                        <i class="material-icons black-text">border_color</i>
                                                    </a>
                                                </td>

                                            </tr>

                                        </table>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            ?>
                            <p class="red-text">Nenhuma maquina encontrada!</p>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!--
            Mobile
            -->
            <div class="card col s12 grey lighten-2 hide-on-large-only">
                <div class="row">
                    <h4>Lista de Maquinas</h4>
                </div>
                <div class="row">
                    <form class="input-field col s12 " method="post" action="consultaMaq.php">
                        <div class="input-field col s4">
                            <select name="lab">
                                <option value="">Nenhum</option>
                                <?php
                                $resulte = $d->buscar_labs();

                                if (mysqli_num_rows($resulte) > 0) {
                                    while ($row = mysqli_fetch_assoc($resulte)) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row["nome"]; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <label>Laboratório:</label>
                        </div>
                        <div class="input-field col s3">
                            <input type="text" name="nome" value="">
                            <label for="nome">Numero</label>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn black" type="submit" name="btBuscarMaq" value="Buscar">Buscar</button>
                        </div>

                    </form>
                </div>
                <div class="row">
                    <ul class="bordered striped collapsible grey lighten-2">
                        <?php
                        if (isset($_POST['btBuscarMaq'])) {
                            $result = $d->selectMaqLab($_POST['lab'], $_POST['nome']);
                        } else {
                            $result = $d->selectMaq();
                        }
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <li class="collection-item">
                                    <div class="collapsible-header grey lighten-2">
                                        <div><span style=":first-letter{text-transform: uppercase}"><?php
                                                echo $row['nomeLab'];
                                                echo $row['nome']
                                                ?>
                                            </span>
                                            <div class="secondary-content">
                                                <i class="material-icons">expand_more</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapsible-body">
                                        <p>MAC:<?php echo " " . $row['maq']; ?></p>
                                        <p>
                                            Serial Windows: <?php echo " " . $row['w_serial']; ?>
                                        </p>
                                        <p>
                                            Patrimônio: <?php echo " " . $row['patrimonio'] ?>
                                        </p>
                                        <p>
                                            Status: <?php
                                            if ($row['status']) {
                                                echo "Funcionando";
                                            } else {
                                                echo 'Problema!';
                                            }
                                            ?>
                                        </p>
                                        <p>
                                            <a href="detalhesMaq.php?msg=<?php echo $row['id']; ?>" class="">
                                                <i class="material-icons black-text">border_color</i>
                                            </a>
                                        </p>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            ?>
                            <p class="red-text">Nenhuma maquina encontrada!</p>
                            <?php
                        }
                        ?>
                    </ul>
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
        $(document).ready(function () {
            $('#selecionador').on('change', consultar);
            $('#numero').keyup(consultar);
            function consultar() {
                $('#busca').text("");
                $('#busca').load("./consulta-maq-dinamica.php?idlab=" + $('#selecionador').val() + "&numero=" + $('#numero').val());
            }
        });
    </script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>