<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$htmlContent = "<page backtop='40px'>

  <style>
        table{
            width: 100%
        }
        .pat{
            width: 15%;
        }
        .nome{
            width: 20%;
        }
        .desc{
            width: 50%
        }
        .local{
            width: 15%
        }
    </style>
    <div style='margin-left: 20px; margin-top: 15px'>
        <h3>Relatório Patrimônios</h3>
    </div>";
if (isset($_GET['local'])) {
    $htmlContent = $htmlContent."<div style='margin-left: 20px; margin-top: 15px'>
        <h4>Resultado para Local: ".$_GET['local']."  Pat: ". $_GET['nome']."</h4>
    </div>";
}




include_once '../Controles/dados.php';
$d = new dados();
if (isset($_GET['local'])) {
    $result = $d->buscarPats($_GET['local'], $_GET['nome']);
} else {
    $result = $d->selectPats();
}
$local = null;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
         if($local==null){
             $local= $row['localizacao'];
             $htmlContent = $htmlContent . "
                 
                     <page_header><h4>".$local."</h4></page_header>
    <table border='1' cellspacing='0' cellpadding='0'>
        <tr>
            <th class='pat'>Patrimônio</th>
            <th class='nome'>Nome</th>
            <th class='desc'>Descrição</th>
            <th class=' local'>Localização</th>
        </tr>
  ";
         }
         if($local!=$row['localizacao']){
             $local= $row['localizacao'];
             $htmlContent = $htmlContent . "
                 </table>
                 </page>
                 <page backtop='40px'>
                 <page_header><h4>".$local."</h4></page_header>
    <table border='1' cellspacing='0' cellpadding='0'>
        <tr>
            <th class='pat'>Patrimônio</th>
            <th class='nome'>Nome</th>
            <th class='desc'>Descrição</th>
            <th class=' local'>Localização</th>
        </tr>
  ";
         }
        
        $htmlContent = $htmlContent . "
            <tr>
            <td class='pat'>" . $row['pat'] . "</td>
            <td class='nome'>" . $row['nome'] . "</td>
            <td class='desc'>" . $row['descricao'] . "</td>
            <td class=' local'>" . $row['localizacao'] . "</td>
        </tr>";
    }
    $htmlContent = $htmlContent . "</table></page>";
} else {
    $htmlContent = $htmlContent . "</table>"
            . "<h1>Nenhum Patrimônio!</h1>";
}

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'pt');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($htmlContent);
    $html2pdf->output();
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
?>
<!--<body style="width: 720px; border: solid black 1px">
    
    <style>
        table{
            width: 100%
        }
        .pat{
            width: 10%;
        }
        .nome{
            width: 15%;
        }
        .desc{
            width: 50%
        }
        .local{
            width: 25%
        }
    </style>
    <div style="margin-left: 20px; margin-top: 15px">
        <h3>Relatório Patrimônios</h3>
    </div>
    <table border="1" cellspacing="0" cellpadding="0">
        <tr>
            <th class="pat">Patrimônio</th>
            <th class="nome">Nome</th>
            <th class="desc">Descrição</th>
            <th class="local">Localização</th>
        </tr>
    </table>
</body>

-->