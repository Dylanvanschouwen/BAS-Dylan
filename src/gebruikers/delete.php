<?php 
// auteur: Dylan van schouwen
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\gebruikers;

if(isset($_POST["verwijderen"])){
	
	// Maak een object gebruikers
	
	
	// Delete gebruikers op basis van NR
	

	echo '<script>alert("gebruikers verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



