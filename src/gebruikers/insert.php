<?php
// auteur: Dylan van schouwen
// functie: insert class gebruikers

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\gebruikers;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		// Code insert gebruikers
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

	<h1>CRUD gebruikers</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">gebruikersnaam:</label>
	<input type="text" id="nv" name="gebruikersnaam" placeholder="gebruikersnaam" required/>
	<br>   
	<label for="an">gebruikersemail:</label>
	<input type="text" id="an" name="gebruikersemail" placeholder="gebruikersemail" required/>
	<br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>



