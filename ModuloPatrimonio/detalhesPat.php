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
    <?php 
    include_once '../Base/header.php';
    ?>
    <title>Detalhes Patrimônio</title>

</head>
<body class="homeimg">

    <?php
    include_once '../Modelos/navGeral.php';
    ?>
    <script type="text/javascript">
        
    </script>
    <?php
    include_once '../Controle/patrimonioPDO.php';
    include_once '../Modelo/Patrimonio.php';
    include_once '../Modelo/Descricao.php';
    include_once '../Controle/descricaoPDO.php';
    $patPDO = new PatrimonioPDO();
    $descPDO = new DescricaoPDO();
    $result = $patPDO->selectPatrimonioPat($_GET['msg']);
    $maq = new patrimonio($result->fetch());
    $resultDesc = $descPDO->selectDescricaoId_descricao($maq->getId_desc());
    $descAtual = new descricao($resultDesc->fetch());
    ?>
    <main>
        <div class="row"></div>
        <div class="row">
            <div class="container  col s6 push-s3 center hide-on-med-and-down">
                <div class="card col s12  grey lighten-3" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Cadastrar Patrimônio</h4>
                    <form class="input-field col s12" method="post" action="../Controle/patrimonioControle.php?function=update">
                        <div class="input-field">
                            <input type="text" value="<?php echo $_GET['msg']; ?>" hidden="true" name="oldpat"/>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="pat" value="<?php echo $maq->getPat(); ?>" type="text" class="input-text">
                                    <label for="last_name">Patrimônio *</label>
                                </div>
                                <div class="input-field col s6">
                                    <select name="id_desc" id="desc">  
                                        <option selected value="0">Nenhum</option>
                                        <?php
                                        $result = $descPDO->selectDescricao();

                                        if ($result) {
                                            while ($row = $result->fetch()) {
                                                $descricao = new descricao($row);
                                                ?>
                                                <option <?php if ($descricao->getId() == $maq->getId_desc()){ echo 'selected'; }?> data="<?php echo $descricao->getDescricao(); ?>" value="<?php echo $descricao->getId(); ?>"><?php echo $descricao->getNome(); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label>Descrição padrão:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s4">
                                    <input name="nome" value="<?php echo$maq->getNome(); ?>"type="text" class="input-text">
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="localizacao">  
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Lab2') {
                                            echo 'selected ';
                                        }
                                        ?>value="Lab2">Lab2</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Lab3') {
                                            echo 'selected ';
                                        }
                                        ?>value="Lab3">Lab3</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Lab4') {
                                            echo 'selected ';
                                        }
                                        ?>value="Lab4">Lab4</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Lab5') {
                                            echo 'selected ';
                                        }
                                        ?>value="Lab5">Lab5</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Lab6') {
                                            echo 'selected ';
                                        }
                                        ?>value="Lab6">Lab6</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'LabGeo') {
                                            echo 'selected ';
                                        }
                                        ?>value="LabGeo">LabGeo</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'LabRedes') {
                                            echo 'selected ';
                                        }
                                        ?>value="LabRedes">LabRedes</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'LabHardware') {
                                            echo 'selected ';
                                        }
                                        ?>value="LabHardware">LabHardware</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'LabRobotica') {
                                            echo 'selected ';
                                        }
                                        ?>value="LabRobotica">LabRobotica</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'LabEstudos') {
                                            echo 'selected ';
                                        }
                                        ?>value="LabEstudos">LabEstudos</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Oficina') {
                                            echo 'selected ';
                                        }
                                        ?>value="Oficina">Oficina</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Sala Professores') {
                                            echo 'selected ';
                                        }
                                        ?>value="Sala Professores">Sala Professores</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Sala Projetos') {
                                            echo 'selected';
                                        }
                                        ?>value="Sala Projetos">Sala Projetos</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Deposito') {
                                            echo 'selected';
                                        }
                                        ?>value="Deposito">Deposito</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Auditório') {
                                            echo 'selected';
                                        }
                                        ?>value="Auditório">Auditório</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Mini Auditório') {
                                            echo 'selected';
                                        }
                                        ?>value="Mini Auditório">Mini Auditório</option>
                                        <option <?php
                                        if ($maq->getLocalizacao() == 'Corredores') {
                                            echo 'selected ';
                                        }
                                        ?>value="Corredores">Corredores</option>
                                    </select>
                                    <label>Localização</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="estado">  
                                        <option <?php
                                        if ($maq->getEstado() == 'Em uso') {
                                            echo 'selected ';
                                        }
                                        ?>value="Em uso">Em uso</option>
                                        <option <?php
                                        if ($maq->getEstado() == 'Danificado') {
                                            echo 'selected ';
                                        }
                                        ?>value="Danificado">Danificado</option>
                                        <option <?php
                                        if ($maq->getEstado() == 'Desuso') {
                                            echo 'selected ';
                                        }
                                        ?>value="Desuso">Desuso</option>

                                    </select>
                                    <label>Estado</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea readonly="readonly" id="textdesc" name="textdesc" class="materialize-textarea grey-text"><?php echo $descAtual->getDescricao() ?></textarea>
                                        <label for="textarea1">Descrição</label>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $("#desc").change(function () {
                                        $("#textdesc").val($("#desc :selected").attr("data"));
                                    });
                                });
                            </script>
                            <div class="row">
                                <input type="submit" name="btUpdatePat" value="Confirmar" class="btn z-depth-3 black">
                                <a href="../index.php" class="btn z-depth-3 black">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </main>

    <script>
        $(document).ready(function () {
            $('select').formSelect();
        });

        $(document).ready(function () {
            $('.collapsible').collapsible();
        });
    </script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>
