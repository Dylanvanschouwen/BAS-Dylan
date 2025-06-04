<!--
	Auteur: Studentnaam
	Function: home page CRUD gebruikers
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
	<h1>CRUD gebruikers</h1>
	<nav>
		<a href='../index.php'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe gebruikers</a><br><br>
	</nav>
	
<?php
// auteur: Dylan van schouwen
// functie: Overzicht gebruikers

session_start();
require '../../vendor/autoload.php';
require_once '../classes/gebruikers.php';

use Bas\classes\gebruikers;

$gebruikersObj = new gebruikers();
$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekNaam = isset($_GET['zoekNaam']) ? trim($_GET['zoekNaam']) : '';

if ($zoekId !== '') {
    $gebruikers = $gebruikersObj->zoekOpId((int)$zoekId);
} elseif ($zoekNaam !== '') {
    $gebruikers = $gebruikersObj->zoekOpNaam($zoekNaam);
} else {
    $gebruikers = $gebruikersObj->getGebruikers();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="gebruikers-zoek-container">
        <form method="get" class="bas-tabel-zoek-form">
            <input type="number" name="zoekId" class="bas-tabel-input" placeholder="Zoek op gebruikers-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekNaam" class="bas-tabel-input" placeholder="Zoek op naam" value="<?= htmlspecialchars($zoekNaam) ?>">
            <button type="submit" class="bas-tabel-btn">Zoek</button>
            <a href="read.php" class="bas-tabel-btn">Reset</a>
        </form>
        <a href="insert.php" class="bas-tabel-btn">Gebruiker toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($gebruikers)): ?>
            <tr>
                <td colspan="6">Geen gebruikers gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($gebruikers as $gebruiker): ?>
                <tr>
                    <td><?= htmlspecialchars($gebruiker['gebruikersId']) ?></td>
                    <td><?= htmlspecialchars($gebruiker['gebruikersNaam']) ?></td>
                    <td><?= htmlspecialchars($gebruiker['gebruikersEmail']) ?></td>
                    <td><?= htmlspecialchars($gebruiker['gebruikersRol']) ?></td>
                    <td>
                        <a href="update.php?gebruikersId=<?= $gebruiker['gebruikersId'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                            <input type="hidden" name="gebruikersId" value="<?= $gebruiker['gebruikersId'] ?>">
                            <button type="submit" class="bas-tabel-btn">Verwijder</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require_once '../Includes/footer.php'; ?>