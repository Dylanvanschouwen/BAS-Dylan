<!--
	Auteur: Dylan van schouwen
	Function: home page CRUD Klant
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
	<h1>CRUD Klant</h1>
	<nav>
		<a href='../index.php'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe klant</a><br><br>
	</nav>
	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Klant;

// Maak een object Klant
$klant = new Klant;

// Start CRUD
$klant->crudKlant();

?>
<main class="bas-main">
    <div class="klant-zoek-container">
        <form method="get" class="bas-tabel-zoek-form">
            <input type="number" name="zoekId" class="bas-tabel-input" placeholder="Zoek op klant-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekNaam" class="bas-tabel-input" placeholder="Zoek op naam" value="<?= htmlspecialchars($zoekNaam) ?>">
            <button type="submit" class="bas-tabel-btn">Zoek</button>
            <a href="read.php" class="bas-tabel-btn">Reset</a>
        </form>
        <a href="insert.php" class="bas-tabel-btn">Klant toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Woonplaats</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <!-- foreach klant ... -->
        </tbody>
    </table>
</main>
</body>
</html>