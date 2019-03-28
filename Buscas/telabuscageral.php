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
    <?php
    include_once '../Controles/dados.php';
    ?>
    <title>Resultados</title>

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

        <div class="hide-on-med-and-down">
            <?php
            $d = new dados();
            $resultmaq = $d->buscaMaqes($_POST['buscar']);
            if ($resultmaq) {
                if (mysqli_num_rows($resultmaq) > 0) {
                    ?>
                    <div class="row">
                        <div class="card col s10 offset-s1">
                            <h4>Maquinas</h4>
                            <table class="bordered striped">
                                <tr>
                                    <th>Nome:</th>
                                    <th>MAC:</th>
                                    <th></th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_assoc($resultmaq)) {
                                    ?>
                                    <tr>
                                        <th>
                                            <?php echo $row['lnome'] . $row['nome']; ?>
                                        </th>
                                        <th>
                                            <?php echo $row['maq'] ?>
                                        </th>
                                        <th>
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatar evento" href="regeventmaq.php?msg=<?php echo $row['id']; ?>" class="">
                                                <i class="material-icons black-text">assignment_late</i>
                                            </a>
                                            <a href="detalhesMaq.php?msg=<?php echo $row['id']; ?>">
                                                <i class="black-text material-icons">send</i>
                                            </a>
                                        </th>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                <?php } else {
                    ?>
                    <div class="row">
                        <div class="card col s10 offset-s1">
                            <h5 class="red-text">Nenhum resultado para Maquinas</h5>
                        </div>
                    </div><?php
                }
            }
            ?>

            <?php
            $d = new dados();
            $resultlab = $d->buscaLabes($_POST['buscar']);
            if ($resultlab) {
                if (mysqli_num_rows($resultlab) > 0) {
                    ?>
                    <div class="row">
                        <div class="card col s10 offset-s1">
                            <h4>Laboratórios</h4>
                            <table class="bordered striped">
                                <tr>
                                    <th>Nome</th>
                                    <th>Quantidade de maquinas</th>
                                    <th></th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_assoc($resultlab)) {
                                    ?>
                                    <tr>
                                        <th>
                                            <?php echo $row['nome']; ?>
                                        </th>
                                        <th>
                                            <?php echo $row['n_maquinas']; ?>
                                        </th>
                                        <th>
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatar evento" href="regeventlab.php?msg=<?php echo $row['id']; ?>" class="">
                                                <i class="material-icons black-text">assignment_late</i>
                                            </a>
                                            <a href="consultaMaq.php?msg=<?php echo $row['id'] ?>">
                                                <i class="material-icons black-text">send</i>
                                            </a>
                                        </th>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } else {
                ?>
                <div class="row">
                    <div class="card col s10 offset-s1">
                        <h5 class="red-text">Nenhum resultado para Laboratórios</h5>
                    </div>
                </div><?php
            }
        }
        ?>


        <?php
        $d = new dados();
        $resultlab = $d->buscaPates($_POST['buscar']);
        if ($resultlab) {
            if (mysqli_num_rows($resultlab) > 0) {
                ?>
                <div class="row">
                    <div class="card col s10 offset-s1">
                        <h4>Patrimônios</h4>
                        <table class="bordered striped">
                            <tr>
                                <th>
                                    Pat/Nome
                                </th>
                                <th>
                                    Localização
                                </th>
                                <th>

                                </th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($resultlab)) {
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $row['pat'] . " / ".$row['nome'] ?>
                                    </th>
                                    <th>
                                        <?php echo $row['localizacao'] ?>
                                    </th>
                                    <th>
                                        <a href="detalhesPat.php?msg=<?php echo $row['pat']; ?>">
                                            <i class="black-text material-icons">send</i>
                                        </a>
                                    </th>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php } else {
            ?>
            <div class="row">
                <div class="card col s10 offset-s1">
                    <h5 class="red-text">Nenhum resultado para Patrimônios</h5>
                </div>
            </div><?php
        }
    }
    ?>

    <!--Mobile-->

    <div class="hide-on-large-only">

    </div>

</main>
<?php
include_once '../Modelos/footer.php';
?>
</body>