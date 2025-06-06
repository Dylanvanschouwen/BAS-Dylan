<?php
// auteur: Dylan van schouwen
// functie: Overzicht leveranciers

require '../../vendor/autoload.php';
require_once '../classes/leverancier.php';

use Bas\classes\leverancier;

$leverancierObj = new leverancier();

$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekNaam = isset($_GET['zoekNaam']) ? trim($_GET['zoekNaam']) : '';
$leveranciers = [];

if ($zoekId !== '') {
    $row = $leverancierObj->zoekOpId((int)$zoekId);
    if ($row) $leveranciers[] = $row;
} elseif ($zoekNaam !== '') {
    $leveranciers = $leverancierObj->zoekOpNaam($zoekNaam);
} else {
    $leveranciers = $leverancierObj->getLeveranciers();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekId" class="crud-searchbar-input" placeholder="Zoek op leverancier-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekNaam" class="crud-searchbar-input" placeholder="Zoek op naam" value="<?= htmlspecialchars($zoekNaam) ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="read.php" class="crud-searchbar-btn">Reset</a>
        </form>
        <a href="insert.php" class="crud-add-btn">Leverancier toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Woonplaats</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($leveranciers)): ?>
            <tr>
                <td colspan="9">Geen leveranciers gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($leveranciers as $lev): ?>
                <tr>
                    <td><?= htmlspecialchars($lev['levId']) ?></td>
                    <td><?= htmlspecialchars($lev['levNaam']) ?></td>
                    <td><?= htmlspecialchars($lev['levContact']) ?></td>
                    <td><?= htmlspecialchars($lev['levEmail']) ?></td>
                    <td><?= htmlspecialchars($lev['levAdres']) ?></td>
                    <td><?= htmlspecialchars($lev['levPostcode']) ?></td>
                    <td><?= htmlspecialchars($lev['levWoonplaats']) ?></td>
                    <td>
                        <a href="update.php?levId=<?= $lev['levId'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je deze leverancier wilt verwijderen?');">
                            <input type="hidden" name="levId" value="<?= $lev['levId'] ?>">
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