<?php 
// auteur: Dylan van schouwen
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
require_once '../classes/leverancier.php';
use Bas\classes\leverancier;

if (isset($_POST['levId'])) {
    $leverancierObj = new leverancier();
    $leverancierObj->deleteLeverancier((int)$_POST['levId']);

	echo '<script>alert("leverancier verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



