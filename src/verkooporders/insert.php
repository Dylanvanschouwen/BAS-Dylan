<?php
// auteur: Dylan van schouwen
// functie: insert class verkooporders

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\verkooporders;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		// Code insert verkooporders
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

	<h1>CRUD verkooporders</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">verkoopordersnaam:</label>
	<input type="text" id="nv" name="verkoopordersnaam" placeholder="verkoopordersnaam" required/>
	<br>   
	<label for="an">verkoopordersemail:</label>
	<input type="text" id="an" name="verkoopordersemail" placeholder="verkoopordersemail" required/>
	<br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>



