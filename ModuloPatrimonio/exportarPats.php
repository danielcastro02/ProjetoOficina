<?php
require '../vendor/autoload.php';
include_once '../Controle/patrimonioPDO.php';
include_once '../Modelo/Patrimonio.php';
include_once '../Modelo/Descricao.php';
include_once '../Controle/descricaoPDO.php';
$patPDO = new PatrimonioPDO();
$descPDO = new DescricaoPDO();

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
    $patBusca = new patrimonio($_GET);
    $patBusca->setLocalizacao($_GET['local']);
    $htmlContent = $htmlContent . "<div style='margin-left: 20px; margin-top: 15px'>
        <h4>Resultado para Local: " . $patBusca->getLocalizacao() . "  Pat: " . $patBusca->getNome() . "</h4>
    </div>";
}

include_once '../Controles/dados.php';
$d = new dados();
if (isset($_GET['local'])) {
    $result = $patPDO->selectLocalNome($patBusca);
} else {
    $result = $patPDO->selectPatrimonio();
}
$local = null;
if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
        $pat = new patrimonio($row);
        if ($local == null) {
            $local = $pat->getLocalizacao();
            $htmlContent = $htmlContent . "
                 
                     <page_header><h4>" . $local . "</h4></page_header>
    <table border='1' cellspacing='0' cellpadding='0'>
        <tr>
            <th class='pat'>Patrimônio</th>
            <th class='nome'>Nome</th>
            <th class='desc'>Descrição</th>
            <th class=' local'>Localização</th>
        </tr>
  ";
        }
        if ($local != $pat->getLocalizacao()) {
            $local = $pat->getLocalizacao();
            $htmlContent = $htmlContent . "
                 </table>
                 </page>
                 <page backtop='40px'>
                 <page_header><h4>" . $local . "</h4></page_header>
    <table border='1' cellspacing='0' cellpadding='0'>
        <tr>
            <th class='pat'>Patrimônio</th>
            <th class='nome'>Nome</th>
            <th class='desc'>Descrição</th>
            <th class=' local'>Localização</th>
        </tr>
  ";
        }
        $descresult = $descPDO->selectDescricaoId_descricao($pat->getId_desc());
        $desc = new descricao($descresult->fetch());
        $htmlContent = $htmlContent . "
            <tr>
            <td class='pat'>" . $pat->getPat() . "</td>
            <td class='nome'>" . $pat->getNome() . "</td>
            <td class='desc'>" . $desc->getDescricao() . "</td>
            <td class=' local'>" . $pat->getLocalizacao() . "</td>
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
