<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}
include_once '../Controles/dados.php';
$d = new dados();
$result = $d->selectSoft($_GET['msg']);
?>
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
        <main>
            <div class="row"></div>
            <div class="row">
                <div class="card col s4 offset-s4 hide-on-med-and-down">
                    <h4>Lista de Softwares <?php echo mysqli_fetch_array($d->selectLabID($_GET['msg']))['nome']; ?></h4>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $cont = mysqli_num_rows($result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cont++;
                            ?>

                            <form action="#">
                                <p class="left-align black-text">
                                    <input id="<?php echo $cont; ?>" type="checkbox"/>
                                    <label for="<?php echo $cont; ?>"><strong class="black-text" style="font-size: 20px"><?php echo $row['nome'] ?></strong></label>
                                </p>
                                <div class="card col s12 black"></div>
                            </form>

                            <?php
                        }
                    } else {
                        ?>
                        <h5 class="red-text">Nenhum softwares registrado.</h5>

                    <?php }
                    ?>
                    <div class="row">

                    </div>
                        <a class="btn" href="../Registros/insereSoft.php?msg=<?php echo $_GET['msg'] ?>">Inserir Software</a>
                    <a style="margin-top: 1"class="btn" href="javascript:window.history.go(-1)">Voltar</a>
                    <div class="row"></div>
                </div>

                <!--Div para responsividade-->

                <div class="card col s10 offset-s1 hide-on-large-only">
                    <h4>Lista de Softwares <?php echo mysqli_fetch_array($d->selectLabID($_GET['msg']))['nome']; ?></h4>
                    <?php
                    $result = $d->selectSoft($_GET['msg']);
                    if (mysqli_num_rows($result) > 0) {
                        $cont = mysqli_num_rows($result) + 100;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cont++;
                            ?>

                            <form action="#">
                                <p class="left-align black-text">
                                    <input id="<?php echo $cont; ?>" type="checkbox"/>
                                    <label for="<?php echo $cont; ?>"><strong class="black-text" style="font-size: 20px"><?php echo $row['nome'] ?></strong></label>
                                </p>
                                <div class="card col s12 black"></div>
                            </form>

                            <?php
                        }
                    } else {
                        ?>
                        <h5 class="red-text">Nenhum softwares registrado.</h5>

                    <?php }
                    ?>
                    <div class="row">

                    </div>
                    <div class="row">
                        <a class="btn" href="../Registros/insereSoft.php?msg=<?php echo $_GET['msg'] ?>">Inserir Software</a>
                    </div>
                    <div class="row">
                        <a style="margin-top: 1"class="btn" href="javascript:window.history.go(-1)">Voltar</a>
                    </div>
                </div>

            </div>

        </main>
        <?php
        include_once '../Modelos/footer.php';
        ?>
    </body>
</html>


