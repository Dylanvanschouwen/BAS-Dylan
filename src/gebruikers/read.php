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
$zoekRol = isset($_GET['zoekRol']) ? trim($_GET['zoekRol']) : '';

if ($zoekId !== '') {
    $gebruikers = $gebruikersObj->zoekOpId((int)$zoekId);
} elseif ($zoekNaam !== '') {
    $gebruikers = $gebruikersObj->zoekOpNaam($zoekNaam);
} elseif ($zoekRol !== '') {
    $gebruikers = $gebruikersObj->zoekOpRol($zoekRol);
} else {
    $gebruikers = $gebruikersObj->getGebruikers();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekId" class="crud-searchbar-input" placeholder="Zoek op gebruikers-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekNaam" class="crud-searchbar-input" placeholder="Zoek op naam" value="<?= htmlspecialchars($zoekNaam) ?>">
            <input type="text" name="zoekRol" class="crud-searchbar-input" placeholder="Zoek op rol" value="<?= htmlspecialchars($zoekRol) ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="read.php" class="crud-searchbar-btn">Reset</a>
        </form>
        <a href="insert.php" class="crud-add-btn">Gebruiker toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Rol</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($gebruikers)): ?>
            <tr>
                <td colspan="5">Geen gebruikers gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($gebruikers as $gebruiker): ?>
                <tr>
                    <td><?= htmlspecialchars($gebruiker['id']) ?></td>
                    <td><?= htmlspecialchars($gebruiker['gebruikersnaam']) ?></td>
                    <td><?= htmlspecialchars($gebruiker['rol']) ?></td>
                    <td>
                        <a href="update.php?gebruikersId=<?= $gebruiker['id'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');" style="margin:0;">
                            <input type="hidden" name="gebruikersId" value="<?= $gebruiker['id'] ?>">
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