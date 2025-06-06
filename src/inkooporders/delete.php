<?php 
// auteur: Dylan van schouwen
// functie: inkooporder verwijderen

require '../../vendor/autoload.php';
use Bas\classes\inkooporder;

if (isset($_POST["verwijderen"]) && isset($_POST["inkOrdId"])) {
    $inkooporderObj = new inkooporder();
    $inkOrdId = (int)$_POST["inkOrdId"];
    $inkooporderObj->deleteInkooporder($inkOrdId);
    header("Location: read.php?deleted=1");
    exit;   exit;
} else {
    header("Location: read.php");   header("Location: read.php");
    exit;    exit;
}
?>



