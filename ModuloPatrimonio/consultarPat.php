<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header("location: index.php");
}
include_once '../Modelo/Patrimonio.php';
include_once '../Modelo/Users.php';
include_once '../Modelo/Descricao.php';
include_once '../Controle/patrimonioPDO.php';
include_once '../Controle/descricaoPDO.php';
include_once '../Controle/usersPDO.php';
include_once '../Controle/comentario_patPDO.php';
include_once '../Modelo/Comentario_pat.php';
?>
<!DOCTYPE html>
<head>
    <?php
    include_once '../Base/header.php';
    ?>
    <title>Ciet - Consulta Patrimônio</title>
</head>

<body class="homeimg">
    <?php
    include_once '../Modelos/navGeral.php';
    ?>
    <main>
        <a class="btn-floating btn-large waves-effect waves-light grey darken-2" href="./registroPat.php" style="position: fixed;
           right: 2%;
           bottom: 6%;"><i class="material-icons">add</i></a>
        <div class="row"></div>
        <div class="row container">

            <div class="card col s12 grey lighten-2 hide-on-med-and-down">
                <div class="row">
                    <h4>Lista de Patrimônios</h4>

                </div>
                <div class="row">
                    <form class="input-field col s6 offset-s3" method="post" action="consultarPat.php?function=consulta">
                        <div class="input-field col s4">
                            <select id="selecionador" name="localizacao"> 
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
                    <a id="linkexportapdf" href="./exportarPats.php<?php
                    if (isset($_GET['function'])) {
                        $patpesquisa = new patrimonio($_POST);
                        echo "?local=" . $patpesquisa->getLocalizacao() . "&nome=" . $patpesquisa->getNome();
                    }
                    ?>" class="btn black">Exportar em PDF</a>
                    <a id="linkexportapdfetiquetas" href="./exportapatetiqueta.php<?php
                    if (isset($_GET['function'])) {
                        echo "?local=" . $patpesquisa->getLocalizacao() . "&nome=" . $patpesquisa->getNome();
                    }
                    ?>" class="btn black">Exportar PDF para etiquetas</a>
                </div>
                <div class="row" id="busca">
                    <ul class="collapsible popout grey lighten-2 left-align">
                        <?php
                        $patpdo = new PatrimonioPDO();
                        $comPDO = new Comentario_patPDO();
                        $userPDO = new UsersPDO();
                        $descPDO = new DescricaoPDO();
                        if (isset($_GET['function'])) {
                            if ($patpesquisa->getLocalizacao() == "SalaProfessores") {
                                $patpesquisa->setLocalizacao('Sala Professores');
                            }
                            if ($patpesquisa->getLocalizacao() == "MiniAuditorio") {
                                $patpesquisa->setLocalizacao('Mini Auditorio');
                            }
                            if ($patpesquisa->getLocalizacao() == "SalaProjetos") {
                                $patpesquisa->setLocalizacao('Sala Projetos');
                            }
                            $result = $patpdo->selectLocalNome($patpesquisa);
                        } else {
                            $result = $patpdo->selectPatrimonio();
                        }
                        if ($result) {
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch()) {
                                    $patrimonio = new patrimonio($row);
                                    $resDescricao = $descPDO->selectDescricaoId_descricao($patrimonio->getId_desc());
                                    $descricao = new descricao($resDescricao->fetch());
                                    ?>
                                    <li class="collection-item">
                                        <div class="collapsible-header grey lighten-2">
                                            <div><span style=":first-letter{text-transform: uppercase}"><?php
                                                    echo "<n>Patrimônio:</n> " . $patrimonio->getPat() . " / " . $patrimonio->getNome();
                                                    ?>
                                                </span>
                                                <div class="secondary-content">
                                                    <i class="material-icons">expand_more</i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapsible-body left-align grey lighten-3">
                                            <p><n>Localizacao:</n><?php echo " " . $patrimonio->getLocalizacao() . "  "; ?><a href="detalhesPat.php?msg=<?php echo $row['pat']; ?>" class="left-align">
                                                <i class="material-icons tiny">border_color</i>
                                            </a><br><n>Estado:</n> <?php echo $patrimonio->getEstado(); ?></p>
                                            <p><n>Descrição:</n> <br> <?php echo $descricao->getDescricao(); ?>
                                            </p>

                                            <h5 class="left-align">Comentários:</h5>

                                            <div class="row">
                                                <div class="col s12">
                                                    <form class="formulario" class="input-field col s12" method="post" action="../Controles/server.php">
                                                        <div class="bodydoreload">
                                                            <?php
                                                            $comentarios = $comPDO->selectComentario_patPat($patrimonio->getPat());
                                                            if ($comentarios) {
                                                                while ($comenta = $comentarios->fetch()) {
                                                                    $coment = new comentario_pat($comenta);
                                                                    $resultUser = $userPDO->selectUsersId($coment->getId_user());
                                                                    $user = new users($resultUser->fetch());
                                                                    ?>
                                                                    <div class="card col s12 grey lighten-2"></div>
                                                                    <p class="left-align">
                                                                        <?php
                                                                        echo $coment->getHora() . " / " . $user->getNome() . "<br>" . $coment->getComentario() . ".<br>";
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
                                                        <input class="idpatcoment"name="pat" value="<?php echo $patrimonio->getPat() ?>" type="text" hidden="true"/>
                                                        <input class="iduser"name="id_user" value="<?php echo $_SESSION['id'] ?>" type="text" hidden="true"/>
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
                                                url: "../Controle/comentario_patControle.php?function=inserir",
                                                data: dados,
                                                success: function (data) {
                                                    alert(data);
                                                    form.children(".bodydoreload").load("attpat.php?pat=" + form.children(".idpatcoment").val());
                                                    form.find(".comentario").val("");
                                                }
                                            });
                                            return false;
                                        });
                                    });
                                </script><?php
                            } else {
                                ?>
                                <p class="red-text">Nenhuma maquina encontrada!</p>
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
                <script>
                    $(document).ready(function () {
                        $("#linkexportapdf").click(function () {
                            $('#busca').text("");
                            $('#busca').load("../Relatorios/teste.php");

                        });

                        $('#selecionador').change(consultar);

                        $('#nome').keyup(consultar);
                        function consultar() {
                            $("#linkexportapdf").removeAttr("href");
                            $("#linkexportapdf").attr("href", "../Relatorios/exportarPats.php?local=" + $('#selecionador').val() + "&nome=" + $('#nome').val());
                            $("#linkexportapdfetiquetas").removeAttr("href");
                            $("#linkexportapdfetiquetas").attr("href", "../Relatorios/exportapatetiqueta.php?local=" + $('#selecionador').val() + "&nome=" + $('#nome').val());
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
            $('select').formSelect();
            $('.collapsible').collapsible();
        });
    </script>
    <?php
    include_once '../Modelos/footer.php';
    ?>
</body>
