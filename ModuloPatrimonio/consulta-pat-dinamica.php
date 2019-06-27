<?php
include_once '../Controles/dados.php';
$d = new dados();
$_POST = $_GET;
?>

<ul class="bordered striped collapsible popout grey lighten-2 left-align">
    <?php
    include_once '../Modelo/Patrimonio.php';
    include_once '../Modelo/Users.php';
    include_once '../Modelo/Descricao.php';
    include_once '../Controle/descricaoPDO.php';
    include_once '../Controle/patrimonioPDO.php';
    include_once '../Controle/usersPDO.php';
    include_once '../Controle/comentario_patPDO.php';
    include_once '../Modelo/Comentario_pat.php';
    $patpdo = new PatrimonioPDO();
    $comPDO = new Comentario_patPDO();
    $userPDO = new UsersPDO();
    $descPDO = new DescricaoPDO();
    $patpesquisa = new patrimonio($_POST);
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
                                    <input class="iduser"name="id_user" value="<?php echo $_SESSION['id'] ?>" type="text" hidden="true"/>
                                    <input class="idpatcoment"name="pat" value="<?php echo $patrimonio->getPat() ?>" type="text" hidden="true"/>
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
                            url: "../Controle/comentario_patControle.php?inserir",
                            data: dados,
                            success: function (data){
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
<script>  $(document).ready(function () {
        $('.collapsible').collapsible();
    });
</script>