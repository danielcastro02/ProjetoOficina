<?php
include_once '../Controles/server.php';
?>

<?php
$comentarios = $d->query("select c.*, u.nome from comentarios_maq as c, users as u where u.id = c.id_user and c.id_evento =" . $_GET['maq'] . ";");
if ($comentarios) {
    while ($coment = mysqli_fetch_assoc($comentarios)) {
        ?>
        <div class="card col s12 grey lighten-2"></div>
        <p class="left-align">
            <?php
            echo $coment['hora'] . " | " . $coment['nome'] . ".<br>" . $coment['comentario'] . "<br>";
            ?>
        </p>
        <?php
    }
}
?>