<?php
// auteur: Dylan van schouwen
// functie: update artikel

session_start();
require '../../vendor/autoload.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

$artikelObj = new artikel();
$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['artId'])) {
    $data = [
        'artOmschrijving'   => $_POST['artOmschrijving'],
        'artInkoop'         => $_POST['artInkoop'],
        'artVerkoop'        => $_POST['artVerkoop'],
        'artVoorraad'       => $_POST['artVoorraad'],
        'artMinVoorraad'    => $_POST['artMinVoorraad'],
        'artMaxVoorraad'    => $_POST['artMaxVoorraad'],
        'artLocatie'        => $_POST['artLocatie']
    ];
    if ($artikelObj->updateArtikel((int)$_POST['artId'], $data)) {
        header("Location: ../User-Interaction/Magazijn-meester.php?update=success");
        exit;
    } else {
        $melding = "Wijzigen mislukt!";
    }
}

if (isset($_GET['artId'])) {
    $row = $artikelObj->zoekOpId((int)$_GET['artId']);
    if ($row && isset($row[0])) {
        $artikel = $row[0];
    } else {
        echo "Artikel niet gevonden.";
        exit;
    }
} else {
    echo "Geen artId opgegeven.";
    exit;
}
?>

<?php require_once '../Includes/header.php'; ?>

<main>
    <div class="formulier-container">
        <form method="post" class="formulier-grid">
            <h2 class="formulier-title" style="grid-column: 1 / -1;">Artikel wijzigen</h2>
            <?php if ($melding): ?>
                <div id="verwijder-melding" style="display:block;grid-column:1/-1;"><?= $melding ?></div>
            <?php endif; ?>
            <input type="hidden" name="artId" value="<?= htmlspecialchars($artikel['artId']) ?>">

            <label class="formulier-label" for="artOmschrijving">Artikel omschrijving</label>
            <input class="formulier-input" type="text" id="artOmschrijving" name="artOmschrijving" value="<?= htmlspecialchars($artikel['artOmschrijving']) ?>" required>

            <label class="formulier-label" for="artInkoop">Artikel inkoop</label>
            <input class="formulier-input" type="number" step="0.01" id="artInkoop" name="artInkoop" value="<?= htmlspecialchars($artikel['artInkoop']) ?>" required>

            <label class="formulier-label" for="artVerkoop">Artikel verkoop</label>
            <input class="formulier-input" type="number" step="0.01" id="artVerkoop" name="artVerkoop" value="<?= htmlspecialchars($artikel['artVerkoop']) ?>" required>

            <label class="formulier-label" for="artVoorraad">Artikel voorraad</label>
            <input class="formulier-input" type="number" id="artVoorraad" name="artVoorraad" value="<?= htmlspecialchars($artikel['artVoorraad']) ?>" required>

            <label class="formulier-label" for="artMinVoorraad">Artikel Min voorraad</label>
            <input class="formulier-input" type="number" id="artMinVoorraad" name="artMinVoorraad" value="<?= htmlspecialchars($artikel['artMinVoorraad']) ?>" required>

            <label class="formulier-label" for="artMaxVoorraad">Artikel Max voorraad</label>
            <input class="formulier-input" type="number" id="artMaxVoorraad" name="artMaxVoorraad" value="<?= htmlspecialchars($artikel['artMaxVoorraad']) ?>" required>

            <label class="formulier-label" for="artLocatie">Artikel locatie</label>
            <input class="formulier-input" type="text" id="artLocatie" name="artLocatie" value="<?= htmlspecialchars($artikel['artLocatie']) ?>" required>

            <div class="formulier-btns" style="grid-column: 1 / -1;">
                <button type="submit" class="artikel-btn">Wijzigen</button>
                <a href="../User-Interaction/Magazijn-meester.php" class="artikel-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>