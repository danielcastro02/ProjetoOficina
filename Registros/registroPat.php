<!DOCTYPE html>
<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once '../Controles/dados.php';
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
    <title>Registro Patrimônio</title>

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
            <div class="container  col s6 push-s3 center hide-on-med-and-down">
                <div class="card col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Cadastrar Patrimônio</h4>
                    <form class="input-field col s12" method="post" action="../Controles/server.php" id="formulario">
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="pat"name="pat" required="true" type="text" class="input-text">
                                    <label for="last_name">Patrimônio *</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="nome" name="nome" required="true" type="text" class="input-text">
                                    <label for="nome">Nome</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <select name="desc" id="selecionador">  
                                        <option value="">Nova</option>
                                        <?php
                                        $d = new dados();
                                        $result = $d->buscar_descs();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option value="<?php echo $row["id"]; ?>"><?php echo $row["nome"]; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label>Descrição padrão:</label>
                                </div>

                                <div class="input-field col s4">
                                    <select name="localizacao">  
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
                                        <option value="Sala Professores">Sala Professores</option>
                                        <option value="Sala Projetos">Sala Projetos</option>
                                        <option value="Deposito">Deposito</option>
                                        <option value="Auditório">Auditório</option>
                                        <option value="Mini Auditório">Mini Auditório</option>
                                        <option value="Corredores">Corredores</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                    <label>Localização</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="estado">  
                                        <option value="Em uso">Em uso</option>
                                        <option value="Danificado">Danificado</option>
                                        <option value="Desuso">Desuso</option>

                                    </select>
                                    <label>Estado</label>
                                </div>
                            </div>
                            <div class="row" id="paraesconder">
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input  id="nomedesc" name="nomedesc" required="true" type="text" class="input-text">
                                        <label for="nomedesc">Nome Descrição</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12"  >
                                        <textarea id="textdesc" name="textdesc" class="materialize-textarea "></textarea>
                                        <label for="textarea1">Descrição</label>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {

                                });
                            </script>
                            <div class="row">
                                <input type="submit" name="btsubmit" value="Confirmar" id="submit" class="btn z-depth-3 black">
                                <a href="../index.php" class="btn z-depth-3 black">Cancelar</a>
                            </div>

                        </div>
                    </form>
                    <div id="modal1" class="modal col s4 offset-s1">
                        <div class="modal-content">
                            <h4>Inserido com Sucesso!</h4>
                        </div>
                        <div class="modal-footer">
                            <a href="#!"class="modal-close waves-effect waves-green btn black">Ok!</a>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#modal1').modal();

                            $('#formulario').submit(function () {
                                var dados = $("#formulario").serialize();
                                if ($("#desc").val() === "") {
                                    if ($("#nomedesc").val() === "") {
                                        alert("Preencha o nome da descrição!");
                                        $("#nomedesc").focus();
                                    }
                                }
                                $.ajax({
                                    type: 'POST',
                                    url: '../Controles/server.php',
                                    data: dados,
                                    success: function (dado) {
                                        //$('#modal1').modal('open');
                                        if (dado) {
                                            alert(dado);
                                            $("#pat").val("");
                                        $("#nome").val("");
                                        $("#nomedesc").val("");
                                        $("#formulario textarea").val("");
                                        $("#pat").focus();
                                        } else {
                                            alert(dado);
                                        }
                                        
                                    }
                                });
                                return false;
                            });

                            $("#selecionador").change(function () {
                                if ($("#selecionador").val() == "") {
                                    $("#paraesconder").removeAttr("class");
                                    $("#paraesconder").attr("class", "row");
                                    $("#paraesconder").attr("required", "true");
                                } else {
                                    $("#paraesconder").attr("class", "row hide");
                                    $("#nomedesc").removeAttr("required");
                                }
                            });
                        });
                    </script>
                </div>
            </div>



        </div>

    </main>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
    <script type="text/javascript">
        $('#textarea1').val('');
        M.textareaAutoResize($('#textarea1'));</script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>