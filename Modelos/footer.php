<?php
if(realpath('../home.php')){
    $pontos = '.';
}else{
    $pontos = '';
}
?>

<div class="row" style="margin-top: 30px">
    <footer class="page-footer black grey-text lighten-3 z-depth-5">
        ©2019-CIET Developed By -- Daniel Castro
        <div style="position: fixed; bottom: 1%; right: 2%;"><a href="<?php echo $pontos;?>./Sugestoes/regSugestao.php?page=<?php echo $_SERVER["REQUEST_URI"];?>" class="grey-text" style="text-decoration: underline;">Criticas e Sugestões</a></div>
    </footer>
</div>
