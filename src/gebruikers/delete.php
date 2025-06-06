<?php 
// auteur: Dylan van schouwen
// functie: gebruiker verwijderen

require '../../vendor/autoload.php';
use Bas\classes\gebruikers;

if (isset($_POST["verwijderen"]) && isset($_POST["gebruikersId"])) {
    $gebruikersObj = new gebruikers();
    $gebruikersId = (int)$_POST["gebruikersId"];
    $gebruikersObj->deleteGebruiker($gebruikersId);
    header("Location: read.php?deleted=1");
    exit;
} else {
    header("Location: read.php");
    exit;
}
?>



