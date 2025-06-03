<?php 
// auteur: Dylan van schouwen
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\inkooporders;

if(isset($_POST["verwijderen"])){
	
	// Maak een object inkooporders
	
	
	// Delete inkooporders op basis van NR
	

	echo '<script>alert("inkooporders verwijderd")</script>';
	echo "<script> location.replace('read.php'); </script>";
}
?>



