<?php
// auteur: Dylan van schouwen
// functie: insert class artikel

session_start(); 
require '../../vendor/autoload.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

$melding = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artikelObj = new artikel();
    $data = [
        'artOmschrijving'   => $_POST['artOmschrijving'],
        'artInkoop'         => $_POST['artInkoop'],
        'artVerkoop'        => $_POST['artVerkoop'],
        'artVoorraad'       => $_POST['artVoorraad'],
        'artMinVoorraad'    => $_POST['artMinVoorraad'],
        'artMaxVoorraad'    => $_POST['artMaxVoorraad'],
        'artLocatie'        => $_POST['artLocatie']
    ];
    if ($artikelObj->insertArtikel($data)) {
        $rol = $_SESSION['rol'] ?? '';
        if ($rol === 'magazijnmeester') {
            header("Location: ../User-Interaction/Magazijn-meester.php?success=1");
        } elseif ($rol === 'inkoopmedewerker') {
            header("Location: ../User-Interaction/Inkoop-medewerker.php?success=1");
        } elseif ($rol === 'verkoopmedewerker') {
            header("Location: ../User-Interaction/Verkoop-medewerker.php?success=1");
        } elseif ($rol === 'admin') {
            header("Location: ../User-Interaction/Admin.php?success=1");
        } else {
            header("Location: ../index.php?success=1");
        }
        exit;
    } else {
        $melding = "Toevoegen mislukt!";
    }
}
?>

<?php require_once '../Includes/header.php'; ?>

<main>
    <div class="formulier-container">
        <form method="post" class="formulier-grid">
            <h2 class="formulier-title" style="grid-column: 1 / -1;">Artikel toevoegen</h2>
            <?php if ($melding): ?>
                <div id="verwijder-melding" style="display:block;grid-column:1/-1;"><?= $melding ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div id="verwijder-melding" style="display:block;">Artikel succesvol toegevoegd!</div>
            <?php endif; ?>
            <label class="formulier-label" for="artOmschrijving">Artikel omschrijving</label>
            <input class="formulier-input" type="text" id="artOmschrijving" name="artOmschrijving" required>

            <label class="formulier-label" for="artInkoop">Artikel inkoop</label>
            <input class="formulier-input" type="number" step="0.01" id="artInkoop" name="artInkoop" required>

            <label class="formulier-label" for="artVerkoop">Artikel verkoop</label>
            <input class="formulier-input" type="number" step="0.01" id="artVerkoop" name="artVerkoop" required>

            <label class="formulier-label" for="artVoorraad">Artikel voorraad</label>
            <input class="formulier-input" type="number" id="artVoorraad" name="artVoorraad" required>

            <label class="formulier-label" for="artMinVoorraad">Artikel Min voorraad</label>
            <input class="formulier-input" type="number" id="artMinVoorraad" name="artMinVoorraad" required>

            <label class="formulier-label" for="artMaxVoorraad">Artikel Max voorraad</label>
            <input class="formulier-input" type="number" id="artMaxVoorraad" name="artMaxVoorraad" required>

            <label class="formulier-label" for="artLocatie">Artikel locatie</label>
            <input class="formulier-input" type="text" id="artLocatie" name="artLocatie" required>

            <div class="formulier-btns" style="grid-column: 1 / -1;">
                <button type="submit" class="artikel-btn">Toevoegen</button>
                <a href="../User-Interaction/Magazijn-meester.php" class="artikel-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>