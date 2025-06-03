<?php
// auteur: Dylan van schouwen
// functie: insert class inkooporders

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\inkooporders;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		// Code insert inkooporders
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

	<h1>CRUD inkooporders</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">inkoopordersnaam:</label>
	<input type="text" id="nv" name="inkoopordersnaam" placeholder="inkoopordersnaam" required/>
	<br>   
	<label for="an">inkoopordersemail:</label>
	<input type="text" id="an" name="inkoopordersemail" placeholder="inkoopordersemail" required/>
	<br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>



