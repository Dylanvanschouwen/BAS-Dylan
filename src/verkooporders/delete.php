<?php 
// auteur: Dylan van schouwen
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\verkooporders;

if(isset($_POST["verwijderen"])){
	
	// Maak een object verkooporders
	
	
	// Delete verkooporders op basis van NR
	

	echo '<script>alert("verkooporders verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



