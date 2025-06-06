<?php
// auteur: Dylan van schouwen
// functie: read class klant

session_start();
require '../../vendor/autoload.php';
require_once '../classes/Klant.php';

use Bas\classes\Klant;

$klantObj = new Klant();

$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekNaam = isset($_GET['zoekNaam']) ? trim($_GET['zoekNaam']) : '';
$zoekPostcode = isset($_GET['zoekPostcode']) ? trim($_GET['zoekPostcode']) : '';
$klanten = [];

if ($zoekId !== '') {
    $row = $klantObj->getKlantById((int)$zoekId);
    if ($row) $klanten[] = $row;
} elseif ($zoekNaam !== '') {
    $klanten = $klantObj->zoekOpNaam($zoekNaam);
} elseif ($zoekPostcode !== '') {
    $klanten = $klantObj->zoekOpPostcode($zoekPostcode);
} else {
    $klanten = $klantObj->getKlanten();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekId" class="crud-searchbar-input" placeholder="Zoek op klant-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekNaam" class="crud-searchbar-input" placeholder="Zoek op naam" value="<?= htmlspecialchars($zoekNaam) ?>">
            <input type="text" name="zoekPostcode" class="crud-searchbar-input" placeholder="Zoek op postcode" value="<?= isset($_GET['zoekPostcode']) ? htmlspecialchars($_GET['zoekPostcode']) : '' ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="read.php" class="crud-searchbar-btn">Reset</a>
        </form>
        <a href="insert.php" class="crud-add-btn">Klant toevoegen</a>
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
        <?php if (empty($klanten)): ?>
            <tr>
                <td colspan="8">Geen klanten gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($klanten as $klant): ?>
                <tr>
                    <td><?= htmlspecialchars($klant['klantId']) ?></td>
                    <td><?= htmlspecialchars($klant['klantNaam']) ?></td>
                    <td><?= htmlspecialchars($klant['klantEmail']) ?></td>
                    <td><?= htmlspecialchars($klant['klantAdres']) ?></td>
                    <td><?= htmlspecialchars($klant['klantPostcode']) ?></td>
                    <td><?= htmlspecialchars($klant['klantWoonplaats']) ?></td>
                    <td>
                        <a href="update.php?klantId=<?= $klant['klantId'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je deze klant wilt verwijderen?');">
                            <input type="hidden" name="klantId" value="<?= $klant['klantId'] ?>">
                            <button type="submit" name="verwijderen" class="bas-tabel-btn">Verwijder</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require_once '../Includes/footer.php'; ?>
</body>
</html>