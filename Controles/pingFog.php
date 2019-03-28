<?php
$conectado = @ fsockopen('200.132.17.8', 80, $numeroDoErro, $stringDoErro, 5); // Este último é o timeout, em segundos
if ($conectado) {
    echo 'Online';
} else {
    echo 'Offline';
}
?>
