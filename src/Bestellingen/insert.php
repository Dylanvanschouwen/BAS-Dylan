<?php
// auteur: Dylan van schouwen
// functie: insert class bestellingen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\bestellingen;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		// Code insert bestellingen
} 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

	<h1>CRUD bestellingen</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">bestellingennaam:</label>
	<input type="text" id="nv" name="bestellingennaam" placeholder="bestellingennaam" required/>
	<br>   
	<label for="an">bestellingenemail:</label>
	<input type="text" id="an" name="bestellingenemail" placeholder="bestellingenemail" required/>
	<br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>



