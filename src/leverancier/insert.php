<?php
// auteur: Dylan van schouwen
// functie: insert class leverancier

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\leverancier;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

		// Code insert leverancier
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

	<h1>CRUD leverancier</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">leveranciernaam:</label>
	<input type="text" id="nv" name="leveranciernaam" placeholder="leveranciernaam" required/>
	<br>   
	<label for="an">leverancieremail:</label>
	<input type="text" id="an" name="leverancieremail" placeholder="leverancieremail" required/>
	<br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>



