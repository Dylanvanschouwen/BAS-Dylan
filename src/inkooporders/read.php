<!--
	Auteur: Studentnaam
	Function: home page CRUD inkooporders
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
	<h1>CRUD inkooporders</h1>
	<nav>
		<a href='../index.html'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe inkooporders</a><br><br>
	</nav>
	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\inkooporders;

// Maak een object inkooporders
$inkooporders = new inkooporders;

// Start CRUD
$inkooporders->crudinkooporders();

?>
</body>
</html>