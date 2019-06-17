<?php
include_once '../Controles/dados.php';
$d = new dados();
?>

<ul class="bordered striped collapsible popout grey lighten-2 left-align">
                        <?php
                        if (isset($_GET['localizacao'])) {
                            if ($_GET['localizacao'] == "SalaProfessores") {
                                $_GET['localizacao'] = 'Sala Professores';
                            }
                            if ($_GET['localizacao'] == "MiniAuditorio") {
                                $_GET['localizacao'] = 'Mini Auditorio';
                            }
                            if ($_GET['localizacao'] == "SalaProjetos") {
                                $_GET['localizacao'] = 'Sala Projetos';
                            }
                            $result = $d->buscarPats($_GET['localizacao'], $_GET['nome']);
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
<script>  $(document).ready(function () {
        $('.collapsible').collapsible();
    });
</script>