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
    <title>Detalhes Patrimônio</title>

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
    $result = $d->buscarPats("",$_GET['msg']);
    $maq = mysqli_fetch_array($result);
    ?>
    <main>
        <div class="row"></div>
         <div class="row">
            <div class="container  col s6 push-s3 center hide-on-med-and-down">
                <div class="card col s12  grey lighten-3" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Cadastrar Patrimônio</h4>
                    <form class="input-field col s12" method="post" action="../Controles/server.php">
                        <div class="input-field">
                            <input type="text" value="<?php echo $_GET['msg'];?>" hidden="true" name="oldpat"/>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="pat" value="<?php echo$maq['pat'];?>" type="text" class="input-text">
                                    <label for="last_name">Patrimônio *</label>
                                </div>
                                <div class="input-field col s6">
                                    <select name="desc" id="desc">  
                                        <option selected value="">Nenhum</option>
                                        <?php
                                        $d = new dados();
                                        $result = $d->buscar_descs();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                        <option <?php if($row['id'] == $maq['iddesc']) echo 'selected';?> data="<?php echo $row["descricao"]; ?>"value="<?php echo $row["id"]; ?>"><?php echo $row["nome"]; ?></option>
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
                                    <input name="nome" value="<?php echo$maq['nome'];?>"type="text" class="input-text">
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="localizacao">  
                                        <option <?php if($maq['localizacao']=='Lab2'){echo 'selected ';}?>value="Lab2">Lab2</option>
                                        <option <?php if($maq['localizacao']=='Lab3'){echo 'selected ';}?>value="Lab3">Lab3</option>
                                        <option <?php if($maq['localizacao']=='Lab4'){echo 'selected ';}?>value="Lab4">Lab4</option>
                                        <option <?php if($maq['localizacao']=='Lab5'){echo 'selected ';}?>value="Lab5">Lab5</option>
                                        <option <?php if($maq['localizacao']=='Lab6'){echo 'selected ';}?>value="Lab6">Lab6</option>
                                        <option <?php if($maq['localizacao']=='LabGeo'){echo 'selected ';}?>value="LabGeo">LabGeo</option>
                                        <option <?php if($maq['localizacao']=='LabRedes'){echo 'selected ';}?>value="LabRedes">LabRedes</option>
                                        <option <?php if($maq['localizacao']=='LabHardware'){echo 'selected ';}?>value="LabHardware">LabHardware</option>
                                        <option <?php if($maq['localizacao']=='LabRobotica'){echo 'selected ';}?>value="LabRobotica">LabRobotica</option>
                                        <option <?php if($maq['localizacao']=='LabEstudos'){echo 'selected ';}?>value="LabEstudos">LabEstudos</option>
                                        <option <?php if($maq['localizacao']=='Oficina'){echo 'selected ';}?>value="Oficina">Oficina</option>
                                        <option <?php if($maq['localizacao']=='Sala Professores'){echo 'selected ';}?>value="Sala Professores">Sala Professores</option>
                                        <option <?php if($maq['localizacao']=='Sala Projetos'){echo 'selected';}?>value="Sala Projetos">Sala Projetos</option>
                                        <option <?php if($maq['localizacao']=='Deposito'){echo 'selected';}?>value="Deposito">Deposito</option>
                                        <option <?php if($maq['localizacao']=='Auditório'){echo 'selected';}?>value="Auditório">Auditório</option>
                                        <option <?php if($maq['localizacao']=='Mini Auditório'){echo 'selected';}?>value="Mini Auditório">Mini Auditório</option>
                                        <option <?php if($maq['localizacao']=='Corredores'){echo 'selected ';}?>value="Corredores">Corredores</option>
                                    </select>
                                    <label>Localização</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="estado">  
                                        <option <?php if($maq['estado']=='Em uso'){echo 'selected ';}?>value="Em uso">Em uso</option>
                                        <option <?php if($maq['estado']=='Danificado'){echo 'selected ';}?>value="Danificado">Danificado</option>
                                        <option <?php if($maq['estado']=='Desuso'){echo 'selected ';}?>value="Desuso">Desuso</option>
                                        
                                    </select>
                                    <label>Estado</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea readonly="readonly" id="textdesc" name="textdesc2" class="materialize-textarea grey-text"><?php echo $maq['descricao']?></textarea>
                                        <label for="textarea1">Descrição</label>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $("#desc").change(function(){
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
             
             
             <!--Mobile-->
             
             
             <div class="container  col s12 center hide-on-large-only">
                <div class="card col s12  grey lighten-2" style="padding: 15px">
                    <h4 class=" col s12 card  grey lighten-2 z-depth-3" style="padding: 15px">Cadastrar Patrimônio</h4>
                    <form class="input-field col s12" method="post" action="server.php">
                        <div class="input-field">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input name="pat" value="<?php echo$maq['pat'];?>" type="text" class="input-text">
                                    <label for="last_name">Patrimônio *</label>
                                </div>
                                <div class="input-field col s6">
                                    <select name="desc">  
                                        <option selected value="">Nenhum</option>
                                        <?php
                                        $d = new dados();
                                        $result = $d->buscar_descs();

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option value="<?php echo $row["descricao"]; ?>"><?php echo $row["nome"]; ?></option>
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
                                    <input name="nome" value="<?php echo$maq['nome'];?>"type="text" class="input-text">
                                    <label for="nome">Nome</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="localizacao">  
                                        <option <?php if($maq['localizacao']=='Lab2'){echo 'selected ';}?>value="Lab2">Lab2</option>
                                        <option <?php if($maq['localizacao']=='Lab3'){echo 'selected ';}?>value="Lab3">Lab3</option>
                                        <option <?php if($maq['localizacao']=='Lab4'){echo 'selected ';}?>value="Lab4">Lab4</option>
                                        <option <?php if($maq['localizacao']=='Lab5'){echo 'selected ';}?>value="Lab5">Lab5</option>
                                        <option <?php if($maq['localizacao']=='Lab6'){echo 'selected ';}?>value="Lab6">Lab6</option>
                                        <option <?php if($maq['localizacao']=='LabGeo'){echo 'selected ';}?>value="LabGeo">LabGeo</option>
                                        <option <?php if($maq['localizacao']=='LabRedes'){echo 'selected ';}?>value="LabRedes">LabRedes</option>
                                        <option <?php if($maq['localizacao']=='LabHardware'){echo 'selected ';}?>value="LabHardware">LabHardware</option>
                                        <option <?php if($maq['localizacao']=='LabRobotica'){echo 'selected ';}?>value="LabRobotica">LabRobotica</option>
                                        <option <?php if($maq['localizacao']=='LabEstudos'){echo 'selected ';}?>value="LabEstudos">LabEstudos</option>
                                        <option <?php if($maq['localizacao']=='Oficina'){echo 'selected ';}?>value="Oficina">Oficina</option>
                                        <option <?php if($maq['localizacao']=='Sala Professores'){echo 'selected ';}?>value="Sala Professores">Sala Professores</option>
                                        <option <?php if($maq['localizacao']=='Sala Projetos'){echo 'selected';}?>value="Sala Projetos">Sala Projetos</option>
                                        <option <?php if($maq['localizacao']=='Deposito'){echo 'selected';}?>value="Deposito">Deposito</option>
                                        <option <?php if($maq['localizacao']=='Auditório'){echo 'selected';}?>value="Auditório">Auditório</option>
                                        <option <?php if($maq['localizacao']=='Mini Auditório'){echo 'selected';}?>value="Mini Auditório">Mini Auditório</option>
                                        <option <?php if($maq['localizacao']=='Corredores'){echo 'selected ';}?>value="Corredores">Corredores</option>
                                    </select>
                                    <label>Localização</label>
                                </div>
                                <div class="input-field col s4">
                                    <select name="estado">  
                                        <option <?php if($maq['estado']=='Em uso'){echo 'selected ';}?>value="Em uso">Em uso</option>
                                        <option <?php if($maq['estado']=='Danificado'){echo 'selected ';}?>value="Danificado">Danificado</option>
                                        <option <?php if($maq['estado']=='Desuso'){echo 'selected ';}?>value="Desuso">Desuso</option>
                                        
                                    </select>
                                    <label>Estado</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="textdesc" name="textdesc" class="materialize-textarea"><?php echo $maq['descricao']?></textarea>
                                        <label for="textarea1">Descrição</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" name="btUpdatePat" value="Confirmar" class="btn z-depth-3">
                                <a href="index.php" class="btn z-depth-3">Cancelar</a>
                            </div>
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
