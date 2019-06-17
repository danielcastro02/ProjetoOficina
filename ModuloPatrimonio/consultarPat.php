<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: index.php");
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
    <title>Ciet - Consulta Patrimônio</title>
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
        <a class="btn-floating btn-large waves-effect waves-light grey darken-2" href="../Registros/registroPat.php" style="position: fixed;
           right: 2%;
           bottom: 6%;"><i class="material-icons">add</i></a>
        <div class="row"></div>
        <div class="row container">

            <div class="card col s12 grey lighten-2 hide-on-med-and-down">
                <div class="row">
                    <h4>Lista de Patrimônios</h4>

                </div>
                <div class="row">
                    <form class="input-field col s6 offset-s3" method="post" action="consultarPat.php">
                        <div class="input-field col s4">
                            <select id="selecionador" name="local"> 
                                <option value="">Todos</option>
                                <option value="Lab2">Lab2</option>
                                <option value="Lab3">Lab3</option>
                                <option value="Lab4">Lab4</option>
                                <option value="Lab5">Lab5</option>
                                <option value="Lab6">Lab6</option>
                                <option value="LabGeo">LabGeo</option>
                                <option value="LabRedes">LabRedes</option>
                                <option value="LabHardware">LabHardware</option>
                                <option value="LabRobotica">LabRobotica</option>
                                <option value="LabEstudos">LabEstudos</option>
                                <option value="Oficina">Oficina</option>
                                <option value="SalaProfessores">Sala Professores</option>
                                <option value="SalaProjetos">Sala Projetos</option>
                                <option value="Deposito">Deposito</option>
                                <option value="Auditório">Auditório</option>
                                <option value="MiniAuditório">Mini Auditório</option>
                                <option value="Corredores">Corredores</option>
                                <option value="Outro">Outro</option>
                            </select>
                            <label>Localização</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="nome" type="text" name="nome" value="">
                            <label for="nome">Buscar</label>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn black" type="submit" name="btBuscarPat" value="Buscar">Buscar</button>
                        </div>

                    </form>
                </div>
                <div class="row">
                    <a id="linkexportapdf" href="../Relatorios/exportarPats.php<?php
                    if (isset($_POST['btBuscarPat'])) {
                        echo "?local=" . $_POST['local'] . "&nome=" . $_POST['nome'];
                    }
                    ?>" class="btn black">Exportar em PDF</a>
                    <a id="linkexportapdfetiquetas" href="../Relatorios/exportapatetiqueta.php<?php
                    if (isset($_POST['btBuscarPat'])) {
                        echo "?local=" . $_POST['local'] . "&nome=" . $_POST['nome'];
                    }
                    ?>" class="btn black">Exportar PDF para etiquetas</a>
                </div>
                <div class="row" id="busca">
                    <ul class="bordered striped collapsible popout grey lighten-2 left-align">
                        <?php
                        if (isset($_POST['btBuscarPat'])) {
                            if ($_POST['local'] == "SalaProfessores") {
                                $_POST['local'] = 'Sala Professores';
                            }
                            if ($_POST['local'] == "MiniAuditorio") {
                                $_POST['local'] = 'Mini Auditorio';
                            }
                            if ($_POST['local'] == "SalaProjetos") {
                                $_POST['local'] = 'Sala Projetos';
                            }
                            $result = $d->buscarPats($_POST['local'], $_POST['nome']);
                        } else {
                            $result = $d->selectPats();
                        }
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="collection-item">
                                        <div class="collapsible-header grey lighten-2">
                                            <div><span style=":first-letter{text-transform: uppercase}"><?php
                                                    echo "<n>Patrimônio:</n> " . $row['pat'] . " / " . $row['nome'];
                                                    ?>
                                                </span>
                                                <div class="secondary-content">
                                                    <i class="material-icons">expand_more</i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapsible-body left-align grey lighten-3">
                                            <p><n>Localizacao:</n><?php echo " " . $row['localizacao'] . "  "; ?><a href="detalhesPat.php?msg=<?php echo $row['pat']; ?>" class="left-align">
                                                <i class="material-icons tiny">border_color</i>
                                            </a><br><n>Estado:</n> <?php echo $row['estado'] ?></p>
                                            <p><n>Descrição:</n> <br> <?php echo $row['descricao'] ?>
                                            </p>

                                            <h5 class="left-align">Comentários:</h5>

                                            <div class="row">
                                                <div class="col s12">
                                                    <form class="formulario" class="input-field col s12" method="post" action="../Controles/server.php">
                                                        <div class="bodydoreload">
                                                            <?php
                                                            $comentarios = $d->query("select c.*, u.nome from comentario_pat as c, users as u where u.id = c.id_user and c.pat ='" . $row['pat'] . "';");
                                                            if ($comentarios) {
                                                                while ($coment = mysqli_fetch_assoc($comentarios)) {
                                                                    ?>
                                                                    <div class="card col s12 grey lighten-2"></div>
                                                                    <p class="left-align">
                                                                        <?php
                                                                        echo $coment['hora'] . " / " . $coment['nome'] . "<br>" . $coment['comentario'] . ".<br>";
                                                                        ?>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="input-field">
                                                            <input class="comentario" type="text" class="col s10" name="comentario" id="comentario"/>
                                                            <label>Adicionar Comentário</label>
                                                        </div>
                                                        <input class="idpatcoment"name="idpatcoment" value="<?php echo $row['pat'] ?>" type="text" hidden="true"/>
                                                        <button type="submit"class="btn" name="btComentarLab" value="Resolvido"><i class="material-icons">arrow_forward</i></button>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <?php }
                                ?>
                                <script>
                                    $(document).ready(function () {
                                        $(".formulario").submit(function () {
                                            var form = $(this);
                                            var dados = form.serialize();
                                            $.ajax({
                                                type: 'POST',
                                                url: "../Controles/server.php",
                                                data: dados,
                                                success: function () {
                                                    form.children(".bodydoreload").load("attpat.php?maq="+form.children(".idpatcoment").val());
                                                    form.find(".comentario").val("");
                                                }
                                            });
                                            return false;
                                        });
                                    });
                                </script><?php
                            }
                        } else {
                            ?>
                            <p class="red-text">Nenhuma maquina encontrada!</p>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <script>
                    $(document).ready(function () {
                        $("#linkexportapdf").click(function(){
                            $('#busca').text("");
                            $('#busca').load("../Relatorios/teste.php");
                            
                        });
                        
                        $('#selecionador').change(consultar);

                        $('#nome').keyup(consultar);
                        function consultar() {
                            $("#linkexportapdf").removeAttr("href");
                            $("#linkexportapdf").attr("href","../Relatorios/exportarPats.php?local="+ $('#selecionador').val() + "&nome=" + $('#nome').val());
                            $("#linkexportapdfetiquetas").removeAttr("href");
                            $("#linkexportapdfetiquetas").attr("href","../Relatorios/exportapatetiqueta.php?local="+ $('#selecionador').val() + "&nome=" + $('#nome').val());
                            $('#busca').text("");
                            $('#busca').load("./consulta-pat-dinamica.php?localizacao=" + $('#selecionador').val() + "&nome=" + $('#nome').val());
                        }
                    });
                </script>

            </div>


            <!--Mobile-->


            

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
