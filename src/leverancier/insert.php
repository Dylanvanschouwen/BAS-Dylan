<?php
// auteur: Dylan van schouwen
// functie: leverancier toevoegen

require '../../vendor/autoload.php';
require_once '../classes/leverancier.php';
use Bas\classes\leverancier;

$melding = '';
if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $data = [
        'levNaam'       => $_POST['levNaam'],
        'levContact'    => $_POST['levContact'],
        'levEmail'      => $_POST['levEmail'],
        'levAdres'      => $_POST['levAdres'],
        'levPostcode'   => $_POST['levPostcode'],
        'levWoonplaats' => $_POST['levWoonplaats']
    ];
    $leverancierObj = new leverancier();
    if ($leverancierObj->insertLeverancier($data)) {
        header("Location: read.php?success=1");
        exit;
    } else {
        $melding = "Toevoegen mislukt!";
    }
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="bas-formulier-container">
        <form method="post" class="bas-formulier-grid">
            <h2 class="bas-formulier-title">Leverancier toevoegen</h2>
            <?php if ($melding): ?>
                <div class="bas-formulier-melding"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="bas-formulier-label" for="levNaam">Naam</label>
            <input class="bas-formulier-input" type="text" id="levNaam" name="levNaam" required>

            <label class="bas-formulier-label" for="levContact">Contactpersoon</label>
            <input class="bas-formulier-input" type="text" id="levContact" name="levContact" required>

            <label class="bas-formulier-label" for="levEmail">Email</label>
            <input class="bas-formulier-input" type="email" id="levEmail" name="levEmail" required>

            <label class="bas-formulier-label" for="levAdres">Adres</label>
            <input class="bas-formulier-input" type="text" id="levAdres" name="levAdres" required>

            <label class="bas-formulier-label" for="levPostcode">Postcode</label>
            <input class="bas-formulier-input" type="text" id="levPostcode" name="levPostcode" required>

            <label class="bas-formulier-label" for="levWoonplaats">Woonplaats</label>
            <input class="bas-formulier-input" type="text" id="levWoonplaats" name="levWoonplaats" required>

            <div class="bas-formulier-btns">
                <input type="submit" name="insert" value="Toevoegen" class="bas-tabel-btn">
                <a href="read.php" class="bas-tabel-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>



