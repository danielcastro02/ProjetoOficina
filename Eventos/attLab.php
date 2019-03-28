<?php
include_once '../Controles/server.php';
?>
<?php
$comentarios = $d->query("select c.*, u.nome from comentarios_lab as c, users as u where u.id = c.id_user and c.id_evento =" . $_GET['maq'] . ";");
if ($comentarios) {
    while ($coment = mysqli_fetch_assoc($comentarios)) {
        ?>
        <p class="left-align">
            <?php
            echo $coment['comentario'] . " / " . $coment['hora'] . "<br>" . $coment['nome'] . ".<br>";
            ?>
        </p>
        <?php
    }
}
?>