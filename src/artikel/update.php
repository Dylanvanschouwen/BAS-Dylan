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
    $rol = $_SESSION['rol'] ?? '';
    if (isset($_POST['terug'])) {
        if ($rol === 'magazijnmedewerker') {
            header("Location: ../User Interaction/magazijn-medewerker-menu.php");
        } elseif ($rol === 'magazijnmeester') {
            header("Location: ../User Interaction/magazijn-meester.php");
        } elseif ($rol === 'inkoper') {
            header("Location: ../User Interaction/inkoper-menu.php");
        } elseif ($rol === 'verkoper') {
            header("Location: ../User Interaction/verkoper-menu.php");
        } elseif ($rol === 'admin') {
            header("Location: ../User Interaction/admin-menu.php");
        } else {
            header("Location: ../index.php");
        }
        exit;
    }
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
        if ($rol === 'magazijnmedewerker') {
            header("Location: ../User Interaction/magazijn-medewerker-menu.php");
        } elseif ($rol === 'magazijnmeester') {
            header("Location: ../User Interaction/magazijn-meester.php");
        } elseif ($rol === 'inkoper') {
            header("Location: ../User Interaction/inkoper-menu.php");
        } elseif ($rol === 'verkoper') {
            header("Location: ../User Interaction/verkoper-menu.php");
        } elseif ($rol === 'admin') {
            header("Location: ../User Interaction/admin-menu.php");
        } else {
            header("Location: ../index.php");
        }
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

<main class = "bas-main">
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Artikel wijzigen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <input type="hidden" name="artId" value="<?= htmlspecialchars($artikel['artId']) ?>">

            <label class="crud-form-label" for="artOmschrijving">Artikel omschrijving</label>
            <input class="crud-form-input" type="text" id="artOmschrijving" name="artOmschrijving" value="<?= htmlspecialchars($artikel['artOmschrijving']) ?>" required>

            <label class="crud-form-label" for="artInkoop">Artikel inkoop</label>
            <input class="crud-form-input" type="number" step="0.01" id="artInkoop" name="artInkoop" value="<?= htmlspecialchars($artikel['artInkoop']) ?>" required>

            <label class="crud-form-label" for="artVerkoop">Artikel verkoop</label>
            <input class="crud-form-input" type="number" step="0.01" id="artVerkoop" name="artVerkoop" value="<?= htmlspecialchars($artikel['artVerkoop']) ?>" required>

            <label class="crud-form-label" for="artVoorraad">Artikel voorraad</label>
            <input class="crud-form-input" type="number" id="artVoorraad" name="artVoorraad" value="<?= htmlspecialchars($artikel['artVoorraad']) ?>" required>

            <label class="crud-form-label" for="artMinVoorraad">Artikel Min voorraad</label>
            <input class="crud-form-input" type="number" id="artMinVoorraad" name="artMinVoorraad" value="<?= htmlspecialchars($artikel['artMinVoorraad']) ?>" required>

            <label class="crud-form-label" for="artMaxVoorraad">Artikel Max voorraad</label>
            <input class="crud-form-input" type="number" id="artMaxVoorraad" name="artMaxVoorraad" value="<?= htmlspecialchars($artikel['artMaxVoorraad']) ?>" required>

            <label class="crud-form-label" for="artLocatie">Artikel locatie</label>
            <input class="crud-form-input" type="text" id="artLocatie" name="artLocatie" value="<?= htmlspecialchars($artikel['artLocatie']) ?>" required>

            <div class="crud-form-btns">
                <button type="submit" name="wijzigen" class="crud-form-btn">Wijzigen</button>
                <button type="submit" name="terug" class="crud-form-btn">Terug</button>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>