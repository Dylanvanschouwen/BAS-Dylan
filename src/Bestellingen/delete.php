<?php 
// auteur: Dylan van schouwen
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\bestellingen;

if(isset($_POST["verwijderen"])){
	
	// Maak een object bestellingen
	
	
	// Delete bestellingen op basis van NR
	

	echo '<script>alert("bestellingen verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



