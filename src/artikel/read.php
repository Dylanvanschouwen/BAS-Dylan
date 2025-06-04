<?php
// auteur: Dylan van schouwen
// functie: Overzicht artikelen voor magazijnmedewerker

session_start();
require '../../vendor/autoload.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

$artikelObj = new artikel();

// Zoekfunctionaliteit
$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekOmschrijving = isset($_GET['zoekOmschrijving']) ? trim($_GET['zoekOmschrijving']) : '';

if ($zoekId !== '') {
    $artikelen = $artikelObj->zoekOpId((int)$zoekId);
} elseif ($zoekOmschrijving !== '') {
    $artikelen = $artikelObj->zoekOpOmschrijving($zoekOmschrijving);
} else {
    $artikelen = $artikelObj->getArtikelen();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="artikel-zoek-container">
        <form method="get" class="artikel-zoek-form">
            <input type="number" name="zoekId" class="formulier-input" placeholder="Zoek op artikel-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekOmschrijving" class="formulier-input" placeholder="Zoek op omschrijving" value="<?= htmlspecialchars($zoekOmschrijving) ?>">
            <button type="submit" class="bas-tabel-btn">Zoek</button>
            <a href="read.php" class="bas-tabel-btn">Reset</a>
        </form>
        <a href="insert.php" class="artikel-toevoegen-btn">Artikel toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Omschrijving</th>
                <th>Inkoop</th>
                <th>Verkoop</th>
                <th>Voorraad</th>
                <th>Min</th>
                <th>Max</th>
                <th>Locatie</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($artikelen)): ?>
            <tr>
                <td colspan="10">Geen artikelen gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($artikelen as $artikel): ?>
                <tr>
                    <td><?= htmlspecialchars($artikel['artId']) ?></td>
                    <td><?= htmlspecialchars($artikel['artOmschrijving']) ?></td>
                    <td><?= htmlspecialchars($artikel['artInkoop']) ?></td>
                    <td><?= htmlspecialchars($artikel['artVerkoop']) ?></td>
                    <td><?= htmlspecialchars($artikel['artVoorraad']) ?></td>
                    <td><?= htmlspecialchars($artikel['artMinVoorraad']) ?></td>
                    <td><?= htmlspecialchars($artikel['artMaxVoorraad']) ?></td>
                    <td><?= htmlspecialchars($artikel['artLocatie']) ?></td>
                    <td>
                        <a href="update.php?artId=<?= $artikel['artId'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?');">
                            <input type="hidden" name="artId" value="<?= $artikel['artId'] ?>">
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
</body>
</html>