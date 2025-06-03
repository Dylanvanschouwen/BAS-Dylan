<!--
	Auteur: Studentnaam
	Function: home page CRUD leverancier
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
	<h1>CRUD leverancier</h1>
	<nav>
		<a href='../index.html'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe leverancier</a><br><br>
	</nav>
	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\leverancier;

// Maak een object leverancier
$leverancier = new leverancier;

// Start CRUD
$leverancier->crudleverancier();

?>
</body>
</html>