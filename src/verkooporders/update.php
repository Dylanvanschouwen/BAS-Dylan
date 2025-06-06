<?php
// auteur: Dylan van schouwen
// functie: update verkooporder

session_start();
require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';
require_once '../classes/Klant.php';
require_once '../classes/artikel.php';

use Bas\classes\verkooporders;
use Bas\classes\Klant;
use Bas\classes\artikel;

$verkoopordersObj = new verkooporders();
$klantObj = new Klant();
$artikelObj = new artikel();
$melding = '';

$klanten = $klantObj->getKlanten();
$artikelen = $artikelObj->getArtikelen();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verkOrdId'])) {
    $rol = $_SESSION['rol'] ?? '';
    if (isset($_POST['terug'])) {
        header("Location: read.php");
        exit;
    }

    $klantId = $_POST['klantId'] ?? '';
    $artId = $_POST['artId'] ?? '';
    $klantBestaat = false;
    $artikelBestaat = false;

    foreach ($klanten as $klant) {
        if ($klant['klantId'] == $klantId) $klantBestaat = true;
    }
    foreach ($artikelen as $artikel) {
        if ($artikel['artId'] == $artId) $artikelBestaat = true;
    }

    if (!$klantBestaat) {
        $melding = "Deze klant bestaat niet!";
    } elseif (!$artikelBestaat) {
        $melding = "Dit artikel bestaat niet!";
    } else {
        $data = [
            'klantId'           => $klantId,
            'artId'             => $artId,
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
}
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
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Verkooporder wijzigen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <input type="hidden" name="verkOrdId" value="<?= htmlspecialchars($order['verkOrdId']) ?>">

            <label class="crud-form-label" for="klantId">Klant</label>
            <select class="crud-form-input" id="klantId" name="klantId" required>
                <option value="">-- Kies een klant --</option>
                <?php foreach ($klanten as $klant): ?>
                    <option value="<?= htmlspecialchars($klant['klantId']) ?>" <?= ($order['klantId'] == $klant['klantId']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($klant['klantNaam']) ?> (ID: <?= $klant['klantId'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="crud-form-label" for="artId">Artikel</label>
            <select class="crud-form-input" id="artId" name="artId" required>
                <option value="">-- Kies een artikel --</option>
                <?php foreach ($artikelen as $artikel): ?>
                    <option value="<?= htmlspecialchars($artikel['artId']) ?>" <?= ($order['artId'] == $artikel['artId']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($artikel['artOmschrijving']) ?> (ID: <?= $artikel['artId'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="crud-form-label" for="verkOrdDatum">Besteldatum</label>
            <input class="crud-form-input" type="date" id="verkOrdDatum" name="verkOrdDatum" value="<?= htmlspecialchars($order['verkOrdDatum']) ?>" required>

            <label class="crud-form-label" for="verkOrdBestAantal">Aantal</label>
            <input class="crud-form-input" type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" min="1" value="<?= htmlspecialchars($order['verkOrdBestAantal']) ?>" required>

            <label class="crud-form-label" for="verkOrdStatus">Status</label>
            <select class="crud-form-input" id="verkOrdStatus" name="verkOrdStatus" required>
                <option value="0" <?= $order['verkOrdStatus'] == 0 ? 'selected' : '' ?>>Nieuw</option>
                <option value="1" <?= $order['verkOrdStatus'] == 1 ? 'selected' : '' ?>>In behandeling</option>
                <option value="2" <?= $order['verkOrdStatus'] == 2 ? 'selected' : '' ?>>Verzonden</option>
                <option value="3" <?= $order['verkOrdStatus'] == 3 ? 'selected' : '' ?>>Afgeleverd</option>
                <option value="4" <?= $order['verkOrdStatus'] == 4 ? 'selected' : '' ?>>Geannuleerd</option>
            </select>

            <div class="crud-form-btns">
                <button type="submit" class="crud-form-btn">Wijzigen</button>
                <button type="submit" name="terug" class="crud-form-btn">Terug</button>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>