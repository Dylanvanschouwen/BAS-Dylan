<?php
// auteur: Dylan van schouwen
// functie: insert verkooporder

require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';
use Bas\classes\verkooporders;

$melding = '';

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
    $data = [
        'klantId'           => $_POST['klantId'],
        'artId'             => $_POST['artId'],
        'verkOrdDatum'      => $_POST['verkOrdDatum'],
        'verkOrdBestAantal' => $_POST['verkOrdBestAantal'],
        'verkOrdStatus'     => $_POST['verkOrdStatus']
    ];
    $verkoopordersObj = new verkooporders();
    if($verkoopordersObj->insertVerkooporder($data)){
        header("Location: read.php?success=1");
        exit;
    } else {
        $melding = "Toevoegen mislukt!";
    }
}
?>

<?php require_once '../Includes/header.php'; ?>

<main>
    <div class="verkooporders-formulier-container">
        <form method="post" class="verkooporders-formulier-grid">
            <h2 class="verkooporders-formulier-title">Verkooporder toevoegen</h2>
            <?php if ($melding): ?>
                <div class="verkooporders-melding"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="verkooporders-formulier-label" for="klantId">Klant ID</label>
            <input class="verkooporders-formulier-input" type="number" id="klantId" name="klantId" required>

            <label class="verkooporders-formulier-label" for="artId">Artikel ID</label>
            <input class="verkooporders-formulier-input" type="number" id="artId" name="artId" required>

            <label class="verkooporders-formulier-label" for="verkOrdDatum">Besteldatum</label>
            <input class="verkooporders-formulier-input" type="date" id="verkOrdDatum" name="verkOrdDatum" required>

            <label class="verkooporders-formulier-label" for="verkOrdBestAantal">Aantal</label>
            <input class="verkooporders-formulier-input" type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" min="1" required>

            <label class="verkooporders-formulier-label" for="verkOrdStatus">Status</label>
            <select class="verkooporders-formulier-input" id="verkOrdStatus" name="verkOrdStatus" required>
                <option value="0">Nieuw</option>
                <option value="1">In behandeling</option>
                <option value="2">Verzonden</option>
                <option value="3">Afgeleverd</option>
                <option value="4">Geannuleerd</option>
            </select>

            <div class="verkooporders-formulier-btns">
                <input type="submit" name="insert" value="Toevoegen" class="verkooporders-btn">
                <a href="read.php" class="verkooporders-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>



