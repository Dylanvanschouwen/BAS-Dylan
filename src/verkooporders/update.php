<?php
// auteur: Dylan van schouwen
// functie: update verkooporder

session_start();
require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';

use Bas\classes\verkooporders;

$verkoopordersObj = new verkooporders();
$melding = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verkOrdId'])) {
    $rol = $_SESSION['rol'] ?? '';
    if (isset($_POST['terug'])) {
        header("Location: read.php");
        exit;
    }

    // Normale update-flow
    $data = [
        'klantId'           => $_POST['klantId'],
        'artId'             => $_POST['artId'],
        'verkOrdDatum'      => $_POST['verkOrdDatum'],
        'verkOrdBestAantal' => $_POST['verkOrdBestAantal'],
        'verkOrdStatus'     => $_POST['verkOrdStatus']
    ];
    if ($verkoopordersObj->updateVerkooporder((int)$_POST['verkOrdId'], $data)) {
        header("Location: read.php?success=1");
        exit;
    } else {
        $melding = "Wijzigen mislukt!";
    }
}

// Ophalen van verkoopordergegevens
if (isset($_GET['verkoopordersId'])) {
    $order = $verkoopordersObj->getVerkooporder((int)$_GET['verkoopordersId']);
    if (!$order) {
        echo "Verkooporder niet gevonden.";
        exit;
    }
} else {
    echo "Geen verkoopordersId opgegeven.";
    exit;
}
?>

<?php require_once '../Includes/header.php'; ?>

<main>
    <div class="verkooporders-formulier-container">
        <form method="post" class="verkooporders-formulier-grid">
            <h2 class="verkooporders-formulier-title">Verkooporder wijzigen</h2>
            <?php if ($melding): ?>
                <div class="verkooporders-melding"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <input type="hidden" name="verkOrdId" value="<?= htmlspecialchars($order['verkOrdId']) ?>">

            <label class="verkooporders-formulier-label" for="klantId">Klant ID</label>
            <input class="verkooporders-formulier-input" type="number" id="klantId" name="klantId" value="<?= htmlspecialchars($order['klantId']) ?>" required>

            <label class="verkooporders-formulier-label" for="artId">Artikel ID</label>
            <input class="verkooporders-formulier-input" type="number" id="artId" name="artId" value="<?= htmlspecialchars($order['artId']) ?>" required>

            <label class="verkooporders-formulier-label" for="verkOrdDatum">Besteldatum</label>
            <input class="verkooporders-formulier-input" type="date" id="verkOrdDatum" name="verkOrdDatum" value="<?= htmlspecialchars($order['verkOrdDatum']) ?>" required>

            <label class="verkooporders-formulier-label" for="verkOrdBestAantal">Aantal</label>
            <input class="verkooporders-formulier-input" type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" min="1" value="<?= htmlspecialchars($order['verkOrdBestAantal']) ?>" required>

            <label class="verkooporders-formulier-label" for="verkOrdStatus">Status</label>
            <select class="verkooporders-formulier-input" id="verkOrdStatus" name="verkOrdStatus" required>
                <option value="0" <?= $order['verkOrdStatus'] == 0 ? 'selected' : '' ?>>Nieuw</option>
                <option value="1" <?= $order['verkOrdStatus'] == 1 ? 'selected' : '' ?>>In behandeling</option>
                <option value="2" <?= $order['verkOrdStatus'] == 2 ? 'selected' : '' ?>>Verzonden</option>
                <option value="3" <?= $order['verkOrdStatus'] == 3 ? 'selected' : '' ?>>Afgeleverd</option>
                <option value="4" <?= $order['verkOrdStatus'] == 4 ? 'selected' : '' ?>>Geannuleerd</option>
            </select>

            <div class="verkooporders-formulier-btns">
                <button type="submit" class="verkooporders-btn">Wijzigen</button>
                <button type="submit" name="terug" class="verkooporders-btn">Terug</button>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>