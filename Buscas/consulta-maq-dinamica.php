<?php
include_once '../Controles/server.php';
?>
<ul class="bordered striped collapsible popout grey lighten-2">
    <?php
    if ($_GET['idlab'] == "" && $_GET['numero'] == "") {
        $result = $d->selectMaq();
    } else {
          $result = $d->selectMaqLab($_GET['idlab'], $_GET['numero']);
        }
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <li class="collection-item">
                <div class="collapsible-header grey lighten-2">

                    <div><span style=":first-letter{text-transform: uppercase}"><?php
                            echo $row['nomelab'];
                            echo $row['nome'];
                            ?>
                            <i class="material-icons">expand_more</i>
                        </span>
                        <div class="secondary-content">
                            <?php
                            $not = $d->selectNot($row['id']);
                            if ($not) {
                                $num = mysqli_fetch_array($not);
                                if ($num['numero'] > 0) {
                                    ?><a href="./verProblema.php?msg=<?php echo $row['id']; ?>"><span class="new badge red" data-badge-caption="Problemas"><?php echo $num['numero']; ?></span></a><?php
                                } else {
                                    ?>
                                        <span class="new badge transparent transparent-text"  data-badge-caption="Problemas">0</span><?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="collapsible-body">
                    <table class="striped">
                        <tr>
                            <td>MAC:<?php echo " " . $row['maq']; ?></td>
                            <td>
                                Serial Windows: <?php echo " " . $row['w_serial']; ?>
                            </td>
                            <td>
                                Patrimônio: <?php echo " " . $row['patrimonio'] ?>
                            </td>
                            <td>
                                Status: <?php
                                echo $row['situacao'];
                                ?>
                            </td>
                            <td>
                                <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Relatar evento" href="../Eventos/regeventmaq.php?msg=<?php echo $row['id']; ?>" class="">
                                    <i class="material-icons black-text">assignment_late</i>
                                </a>
                            </td>
                            <td>
                                <a href="./detalhesMaq.php?msg=<?php echo $row['id']; ?>" class="">
                                    <i class="material-icons black-text">border_color</i>
                                </a>
                            </td>

                        </tr>

                    </table>
                </div>
            </li>
            <?php
        }
    } else {
        ?>
        <p class="red-text">Nenhuma maquina encontrada!</p>
        <?php
    }
    ?>
</ul>
<script>
    $('.collapsible').collapsible();
</script>

