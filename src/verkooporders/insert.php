<?php
// auteur: Dylan van schouwen
// functie: verkooporder toevoegen

session_start();
require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';
require_once '../classes/Klant.php';
require_once '../classes/artikel.php';

use Bas\classes\verkooporders;
use Bas\classes\Klant;
use Bas\classes\artikel;

$melding = '';
$verkoopordersObj = new verkooporders();
$klantObj = new Klant();
$artikelObj = new artikel();

$klanten = $klantObj->getKlanten();
$artikelen = $artikelObj->getArtikelen();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        try {
            if ($verkoopordersObj->insertVerkooporder($data)) {
                if ($rol === 'magazijnmedewerker') {
                    header("Location: ../User Interaction/magazijn-medewerker-menu.php?success=1");
                } elseif ($rol === 'magazijnmeester') {
                    header("Location: ../User Interaction/magazijn-meester.php?success=1");
                } elseif ($rol === 'inkoper') {
                    header("Location: ../User Interaction/inkoper-menu.php?success=1");
                } elseif ($rol === 'verkoper') {
                    header("Location: ../User Interaction/verkoper-menu.php?success=1");
                } elseif ($rol === 'admin') {
                    header("Location: ../User Interaction/admin-menu.php?success=1");
                } else {
                    header("Location: ../index.php?success=1");
                }
                exit;
            } else {
                $melding = "Toevoegen mislukt!";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $melding = "Deze klant/artikel combinatie bestaat al!";
            } else {
                $melding = "Databasefout: " . $e->getMessage();
            }
        }
    }
}
?>

<?php require_once '../Includes/header.php'; ?>

<main>
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Verkooporder toevoegen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="crud-form-message">Verkooporder succesvol toegevoegd!</div>
            <?php endif; ?>

            <label class="crud-form-label" for="klantId">Klant</label>
            <select class="crud-form-input" id="klantId" name="klantId" required>
                <option value="">-- Kies een klant --</option>
                <?php foreach ($klanten as $klant): ?>
                    <option value="<?= htmlspecialchars($klant['klantId']) ?>" <?= (isset($_POST['klantId']) && $_POST['klantId'] == $klant['klantId']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($klant['klantNaam']) ?> (ID: <?= $klant['klantId'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="crud-form-label" for="artId">Artikel</label>
            <select class="crud-form-input" id="artId" name="artId" required>
                <option value="">-- Kies een artikel --</option>
                <?php foreach ($artikelen as $artikel): ?>
                    <option value="<?= htmlspecialchars($artikel['artId']) ?>" <?= (isset($_POST['artId']) && $_POST['artId'] == $artikel['artId']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($artikel['artOmschrijving']) ?> (ID: <?= $artikel['artId'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="crud-form-label" for="verkOrdDatum">Besteldatum</label>
            <input class="crud-form-input" type="date" id="verkOrdDatum" name="verkOrdDatum" value="<?= isset($_POST['verkOrdDatum']) ? htmlspecialchars($_POST['verkOrdDatum']) : '' ?>" required>

            <label class="crud-form-label" for="verkOrdBestAantal">Aantal</label>
            <input class="crud-form-input" type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" min="1" value="<?= isset($_POST['verkOrdBestAantal']) ? htmlspecialchars($_POST['verkOrdBestAantal']) : '' ?>" required>

            <label class="crud-form-label" for="verkOrdStatus">Status</label>
            <select class="crud-form-input" id="verkOrdStatus" name="verkOrdStatus" required>
                <option value="0" <?= (isset($_POST['verkOrdStatus']) && $_POST['verkOrdStatus'] == "0") ? 'selected' : '' ?>>Nieuw</option>
                <option value="1" <?= (isset($_POST['verkOrdStatus']) && $_POST['verkOrdStatus'] == "1") ? 'selected' : '' ?>>In behandeling</option>
                <option value="2" <?= (isset($_POST['verkOrdStatus']) && $_POST['verkOrdStatus'] == "2") ? 'selected' : '' ?>>Verzonden</option>
                <option value="3" <?= (isset($_POST['verkOrdStatus']) && $_POST['verkOrdStatus'] == "3") ? 'selected' : '' ?>>Afgeleverd</option>
                <option value="4" <?= (isset($_POST['verkOrdStatus']) && $_POST['verkOrdStatus'] == "4") ? 'selected' : '' ?>>Geannuleerd</option>
            </select>

            <div class="crud-form-btns">
                <button type="submit" name="toevoegen" class="crud-form-btn">Toevoegen</button>
                <button type="submit" name="terug" class="crud-form-btn">Terug</button>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>



