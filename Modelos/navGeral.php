<?php
if(realpath('../home.php')){
    $pontos = '.';
}else{
    $pontos = '';
}
?>
<nav  class="black hide-on-med-and-down z-depth-5" style="position: fixed; z-index: 1;">
    <div class = "row nav-wrapper">
        <a class="col s1 left-align" tabindex="2" href = "<?php echo $pontos; ?>./home.php" style = "margin-left: 30px; font-size: 40px">CIET</a>
        <form class="col s3 hide-on-med-and-down " action="<?php echo $pontos; ?>./Buscas/telabuscageral.php" method="post">
            <div class="input-field">
                <input id="search" name="buscar" placeholder="Pesquisar" class="grey darken-3 white-text" type="search" required/>
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
            </div>
        </form>
        <ul class = "right-align right hide-on-med-and-down">
            <li class="hoverable"><a href = "<?php echo $pontos;?>./index.php">Home</a></li>
            <li class="hoverable"><a href = "https://glpi.svs.iffarroupilha.edu.br/front/reservation.php?reservationitems_id=&mois_courant=9&annee_courante=2018">Horários</a></li>
            <li class="hoverable"><a href = "<?php echo $pontos; ?>./Buscas/consultarLab.php">Laboratórios</a></li>
            <li class="hoverable"><a href = "<?php echo $pontos; ?>./Buscas/consultaMaq.php">Máquinas</a></li>
            <li class="hoverable"><a href = ""><?php echo $_SESSION['nome']; ?></a></li>
            <li class="hoverable"><a href = "<?php echo $pontos; ?>./Controles/server.php?logout=sair" style="margin-right: 25px">Sair</a></li>
        </ul>

    </div>

</nav>
<a class="btn-floating hide-on-med-and-down btn-large grey darken-2" href="javascript:history.back()" style=" position: fixed; top: 80px; left: 20px; "><i class="material-icons">keyboard_backspace</i></a>
<nav class="hide-on-large-only black">
    <div class = "row nav-wrapper">
        <a tabindex="2" href = "home.php" class = "col s2 brand-logo hide-on-large-only">CIET</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse large"><i class="material-icons">menu</i></a>
        <ul class="side-nav left-align" id="mobile-demo"
            <li><a href=""><?php echo $_SESSION['nome']; ?></a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="https://glpi.svs.iffarroupilha.edu.br/front/reservation.php?reservationitems_id=&mois_courant=9&annee_courante=2018">Horários</a></li>
            <li><a href="consultarLab.php">Laboratórios</a></li>
            <li><a href="consultaMaq.php">Máquinas</a></li>
            <li><a href="server.php?logout=sair">Logout</a></li>
        </ul>
    </div>
</nav>