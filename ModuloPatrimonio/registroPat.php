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
    <?php
    include_once '../Base/header.php';
    ?>
    <title>Registro Patrimônio</title>

</head>
<body class="homeimg">

    <?php
    include_once '../Modelos/navGeral.php';
    
    include_once '../Controle/patrimonioPDO.php';
    include_once '../Modelo/Patrimonio.php';
    include_once '../Modelo/Descricao.php';
    include_once '../Controle/descricaoPDO.php';
    $descPDO = new DescricaoPDO;
    ?>
    <script type="text/javascript">
       
    </script>
    <main>
        <div class="row"></div>
        <div class="row">
            <div class="container  col s6 push-s3 center hide-on-med-and-down">
                <div class="card col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Cadastrar Patrimônio</h4>
                    <form class="input-field col s12" method="post" action="../Controle/patrimonioControle.php?function=inserirPatrimonio" id="formulario">
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
                                    <select name="id_desc" id="selecionador">  
                                        <option value="0">Nova</option>
                                        <?php
                                         $result = $descPDO->selectDescricao();

                                        if ($result) {
                                            while ($row = $result->fetch()) {
                                                $descricao = new descricao($row);
                                                ?>
                                                <option data="<?php echo $descricao->getDescricao(); ?>" value="<?php echo $descricao->getId(); ?>"><?php echo $descricao->getNome(); ?></option>
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
                                    url: '../Controle/patrimonioControle.php?function=inserir',
                                    data: dados,
                                    success: function (dado) {
                                        //$('#modal1').modal('open');
                                        if (dado) {
                                            alert("Inserido!");
                                            $("#pat").val("");
                                        $("#nome").val("");
                                        $("#nomedesc").val("");
                                        $("#formulario textarea").val("");
                                        $("#pat").focus();
                                        } else {
                                            alert("Comportamento inesperado do sistema!");
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
             $('select').formSelect();
        });
    </script>
    <script type="text/javascript">
        $('#textarea1').val('');
        M.textareaAutoResize($('#textarea1'));</script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>