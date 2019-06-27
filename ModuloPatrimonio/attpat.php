<div class="bodydoreload">
    <?php
    include_once '../Controle/comentario_patPDO.php';
    include_once '../Controle/usersPDO.php';
    include_once '../Modelo/Comentario_pat.php';
    include_once '../Modelo/Users.php';
    $comPDO = new Comentario_patPDO();
    $userPDO = new UsersPDO();
    $comentarios = $comPDO->selectComentario_patPat($_GET['pat']);
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