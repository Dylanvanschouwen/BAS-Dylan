<?php 
// auteur: Dylan van schouwen
// functie: klant verwijderen

require '../../vendor/autoload.php';
use Bas\classes\Klant;

if (isset($_POST["verwijderen"]) && isset($_POST["klantId"])) {
    $klantObj = new Klant();
    $klantId = (int)$_POST["klantId"];
    $klantObj->deleteKlant($klantId);
    header("Location: read.php?deleted=1");
    exit;
} else {
    header("Location: read.php");
    exit;
}
?>



