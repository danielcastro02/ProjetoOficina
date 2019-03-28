<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: ./index.php");
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="icon" href="./img/favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <title>Home</title>

</head>


<body class="homeimg"> 
    <?php
    include_once './Modelos/navGeral.php';
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });
    </script>
    <main>


        <input type="text" id="nulo" name="teste" hidden="true" value=""/>
        <div class="hide-on-med-and-down">
            <div class="row"></div>
            <div class="row container truncate">
                <div class="col s5 grey lighten-2 card container z-depth-5" style="height: 330px;">
                    <h5>Status:</h5>
                    <div class="row">
                        <div class="card black white-text col s10 offset-s1 left-align  z-depth-5 ">
                            <h5>Maquinas
                                <?php
                                include_once './Controles/dados.php';
                                $d = new dados();
                                $x = mysqli_fetch_array($d->query("select count(id) as num from historico where situacao = 'Ativa';"))['num'];
                                if ($x > 0) {
                                    ?><a href="./Eventos/EventosRecentesMaq.php">
                                        <span class="new badge red" data-badge-caption="Problemas"><?php echo $x; ?>
                                        </span>
                                    </a>
                                </h5><?php
                            } else {
                                ?><a href="./Eventos/EventosRecentesMaq.php"><span class="new badge green" data-badge-caption="">
                                        Ok<!--<i class="material-icons white-text inline-icon">done</i>--></span>
                                </a></h5><?php
                            }
                            ?>
                        </div>
                        <div class="card black white-text col s10 offset-s1 left-align z-depth-5">
                            <h5>Laboratórios
                                <?php
                                include_once './Controles/dados.php';
                                $d = new dados();
                                $x = mysqli_fetch_array($d->query("select count(id) as num from evt_lab where status = 'Ativa';"))['num'];
                                $result = $d->selectEvtGeralLab();
                                if ($x > 0) {
                                    ?><a href="./Eventos/EventosRecentesLab.php"><span class="new badge red" data-badge-caption="Problemas">
                                            <?php echo $x; ?></span>
                                    </a>
                                </h5><?php
                            } else {
                                ?><a href="./Eventos/EventosRecentesLab.php"><span class="new badge green" data-badge-caption="">
                                        Ok<!--<i class="material-icons white-text inline-icon">done</i>--></span>
                                </a></h5><?php
                            }
                            ?>
                        </div>
                        <div class="card black white-text col s10 offset-s1 left-align hide z-depth-5">
                            <h5>Rotina
                                <?php
                                include_once './Controles/dados.php';
                                $d = new dados();
                                $x = mysqli_fetch_array($d->query("select count(id) as num from evt_rotina where status = 'Ativa';"))['num'];
                                $result = $d->selectEvtGeralLab();
                                if ($x > 0) {
                                    ?><a href="./Eventos/EventosRecentesLab.php"><span class="new badge red" data-badge-caption="Problemas">
                                            <?php echo $x; ?></span>
                                    </a>
                                </h5><?php
                            } else {
                                ?><a href="./Eventos/EventosRecentes.php"><span class="new badge green" data-badge-caption="">
                                        Ok<!--<i class="material-icons white-text inline-icon">done</i>--></span>
                                </a></h5></a><?php
                            }
                            ?>
                        </div>
                        <div class="card black white-text col s10 offset-s1 left-align z-depth-5">
                            <h5>Fog
                                <a href="http://200.132.17.8/fog"><span id="mudar-ajax" class="new badge yellow darken-3" data-badge-caption="Carregando...">
                                    </span>
                                </a>
                            </h5>
                        </div>
                        <?php
                        if ($_SESSION['id'] == 11) {
                            ?>
                            <div class="card black white-text col s10 offset-s1 left-align z-depth-5">
                                <h5>Sugestões<?php
                                    $x = mysqli_fetch_array($d->query("select count(id) as num from sugestoes where status = 'Ativa';"))['num'];
                                    ?>
                        <a href="./Sugestoes/verSugestoes.php"><span class="new badge <?php if($x >0){echo "red";}else{echo "green";}?> " data-badge-caption="<?php if($x>0){echo $x . "Sugestões";}else{ echo "Ok";}?>">
                                        </span>
                                    </a>
                                </h5>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="card col grey lighten-2 s5 offset-s2 z-depth-5" style="height: 330px;">
                    <div class="row"  style="height: 100px;">
                        <div class="col s12">
                            <i class="material-icons large" style="margin-bottom: 0px">computer</i>
                        </div>
                        <div class="row">
                            <a href="./Buscas/consultaMaq.php">
                                <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Computadores<i class="inline-icon material-icons">arrow_forward</i></button>
                            </a>
                        </div>
                        <div class="row">
                            <a href="./Registros/registroMaq.php">
                                <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Registrar<i class="inline-icon material-icons">arrow_forward</i></button>
                            </a>
                        </div>
                        <div class="row">
                            <a href="./Eventos/EventosRecentesMaq.php">
                                <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Eventos Recentes<i class="inline-icon material-icons">arrow_forward</i></button>
                            </a>
                        </div>
                    </div>


                </div>
            </div>

            <div class="row container truncate">

                <div class="col s5 grey lighten-2 card container z-depth-5" style="height: 330px;">
                    <div class="row"  style="height: 76px;">
                        <div class="col s12">
                            <i class="material-icons large" style="margin-bottom: 0px">assignment</i>
                        </div>
                    </div>
                    <div class="row">
                        <a href="./Buscas/consultarPat.php">
                            <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Patrimônio<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="./Registros/registroPat.php">
                            <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Registrar Patrimônio<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="./Registros/registrarTipoPat.php">
                            <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Registrar Descrição Geral<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                </div>

                <div class="col s5 card grey lighten-2 container offset-s2 z-depth-5" style="height: 330px;">
                    <div class="row"  style="height: 76px;">
                        <div class="col s12">
                            <img style="width: 70px; margin-top: 15px; margin-bottom: 0px" src="./img/lab.png"/>
                        </div>
                    </div>
                    <div class="row">
                        <a href="./Registros/registroLab.php">
                            <button class=" black btn-large col s10 offset-s1 center-align z-depth-5">Registrar Laboratório<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="./Buscas/consultarLab.php">
                            <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Consultar Laboratórios<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="./Eventos/EventosRecentesLab.php">
                            <button class="btn-large black col s10 offset-s1 center-align z-depth-5">Eventos Recentes<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--
        Mobile
        -->
        <div class="hide-on-large-only">
            <div class="row container truncate">

                <div class="col s10 offset-s1 card container" style="height: 335px;">
                    <div class="row"  style="height: 76px;">
                        <div class="col s12">
                            <img style="width: 70px; margin-top: 15px; margin-bottom: 0px" src="./img/lab.png"/>
                        </div>
                    </div>
                    <div class="row">
                        <a href="registroLab.php">
                            <button class="btn-large col s10 offset-s1 center-align">Registrar Laboratório<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="consultarLab.php">
                            <button class="btn-large col s10 offset-s1 center-align">Consultar Laboratórios<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="EventosRecentes.php">
                            <button class="btn-large col s10 offset-s1 center-align">Eventos Recentes<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row container truncate">
                <div class="col s10 offset-s1 card container" style="height: 335px;">
                    <div class="row"  style="height: 100px;">
                        <div class="col s12">
                            <i class="material-icons large" style="margin-bottom: 0px">computer</i>
                        </div>
                        <div class="row">
                            <a href=".\registroMaq.php">
                                <button class="btn-large col s10 offset-s1 center-align">Registrar Computador<i class="inline-icon material-icons">arrow_forward</i></button>
                            </a>
                        </div>
                        <div class="row">
                            <a href="consultaMaq.php">
                                <button class="btn-large col s10 offset-s1 center-align">Consultar Computadores<i class="inline-icon material-icons">arrow_forward</i></button>
                            </a>
                        </div>
                        <div class="row">
                            <a href="consultaLab.php">
                                <button class="btn-large col s10 offset-s1 center-align">Eventos Recentes<i class="inline-icon material-icons">arrow_forward</i></button>
                            </a>
                        </div>
                    </div>


                </div>
            </div>

            <div class="row container truncate">

                <div class="col s10 offset-s1 card container" style="height: 335px;">
                    <div class="row"  style="height: 76px;">
                        <div class="col s12">
                            <i class="material-icons large" style="margin-bottom: 0px">assignment</i>
                        </div>
                    </div>
                    <div class="row">
                        <a href="registroPat.php">
                            <button class="btn-large col s10 offset-s1 center-align">Registrar Patrimônio<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="consultarPat.php">
                            <button class="btn-large col s10 offset-s1 center-align">Consultar Patrimônio<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                    <div class="row">
                        <a href="registrarTipoPat.php">
                            <button class="btn-large col s10 offset-s1 center-align">Registrar Des/ Geral<i class="inline-icon material-icons">arrow_forward</i></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                var intervalo = setInterval(function () {
                    var $d = document.getElementById("mudar-ajax");
                    $d.removeAttribute("data-badge-caption");
                    $d.setAttribute("data-badge-caption", "");
                    if ($d.innerHTML === "Online") {
                        $d.removeAttribute("class");
                        $d.setAttribute("class", "new badge green");
                        clearInterval(intervalo);
                    } else {
                        if ($d.innerHTML === "Offline") {
                            $d.removeAttribute("class");
                            $d.setAttribute("class", "new badge red");
                            clearInterval(intervalo);
                        } else {
                            $d.removeAttribute("data-badge-caption");
                            $d.setAttribute("data-badge-caption", "Carregando...");
                        }
                    }
                }
                , 50);

                $("#mudar-ajax").load("./Controles/pingFog.php");

            });
        </script>

    </main>
    <?php
    include_once './Modelos/footer.php';
    ?>
</body>


