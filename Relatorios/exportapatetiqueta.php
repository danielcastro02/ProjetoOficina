<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$htmlContent = "
  <style>
        table{
            margin-top: 35px;
            margin-bottom: 3%;
            width: 100%;
            height: 100%;
            align-items: center;
            text-align: center;
        }
        .pat{
            width: 50%;
            height: 13.2%;
        }
    </style>
";



include_once '../Controles/dados.php';
$d = new dados();
if (isset($_GET['local'])) {
    $result = $d->buscarPats($_GET['local'], $_GET['nome']);
} else {
    $result = $d->selectPats();
}
$local = null;
if (mysqli_num_rows($result) > 0) {
    $htmlContent = $htmlContent . "<page><table border='0' cellspacing='0' cellpadding='0'>";
    $xpramudar = 0;
    $mudapagina = 0;
    while ($row = mysqli_fetch_assoc($result)) {

        
        if ($xpramudar % 2 == 0) {
            $htmlContent = $htmlContent . "
        <tr>
            <td class='pat'><big><big><h1>" . $row['pat'] . "</h1></big></big></td>
  ";
            $xpramudar++;
        } else {
            $htmlContent = $htmlContent . "
            <td class='pat'><big><big><h1>" . $row['pat'] . "</h1></big></big></td>
        </tr>";
            $xpramudar++;
            $mudapagina++;
        }
        if ($mudapagina == 7) {
            $htmlContent = $htmlContent . "</table></page>";
            $htmlContent = $htmlContent . "<page><table border='0' cellspacing='0' cellpadding='0'>";
            $mudapagina = 0;
        }
    }
}
if(!endsWith($htmlContent, "</tr></table></page>")){
    if(endsWith($htmlContent, "</tr>")){
        $htmlContent = $htmlContent . "</table></page>";
    }else{
        $htmlContent = $htmlContent . "</tr></table></page>";
    }
    
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

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}
?>
<!--<body style="width: 720px; border: solid black 1px">

    <style>
        table{
            margin-top: 3%;
            margin-bottom: 3%;
            width: 100%;
            height: 100%;
            text-align: center;
        }
        .pat{
            width: 50%;
        }

    </style>
    <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <th class="pat"><big><big>Patrimônio</big></big></th>
    <th class="pat"><big><big>Nome</big></big></th>
</tr>
<tr>
    <th class="pat"><big><big>Patrimônio</big></big></th>
<th class="pat"><big><big>Nome</big></big></th>
</tr>
<tr>
    <th class="pat"><big><big>Patrimônio</big></big></th>
<th class="pat"><big><big>Nome</big></big></th>
</tr>
<tr>
    <th class="pat"><big><big>Patrimônio</big></big></th>
<th class="pat"><big><big>Nome</big></big></th>
</tr>
<tr>
    <th class="pat">Patrimônio</th>
    <th class="pat">Nome</th>
</tr>
<tr>
    <th class="pat">Patrimônio</th>
    <th class="pat">Nome</th>
</tr>
<tr>
    <th class="pat">Patrimônio</th>
    <th class="pat">Nome</th>
</tr>
</table>
</body>
-->
