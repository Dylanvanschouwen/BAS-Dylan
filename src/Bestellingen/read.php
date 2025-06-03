<!--
	Auteur: Studentnaam
	Function: home page CRUD bestellingen
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
	<h1>CRUD bestellingen</h1>
	<nav>
		<a href='../index.html'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe bestellingen</a><br><br>
	</nav>
	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\bestellingen;

// Maak een object bestellingen
$bestellingen = new bestellingen;

// Start CRUD
$bestellingen->crudbestellingen();

?>
</body>
</html>