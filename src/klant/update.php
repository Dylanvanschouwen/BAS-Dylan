<?php
    // auteur: Dylan van schouwen
    // functie: klant wijzigen

    require '../../vendor/autoload.php';
    require_once '../classes/Klant.php';
    use Bas\classes\Klant;

    $klantObj = new Klant();
    $melding = '';

    if (isset($_GET['klantId'])) {
        $klantId = (int)$_GET['klantId'];
        $row = $klantObj->getKlantById($klantId);
        if (!$row) {
            header("Location: read.php");
            exit;
        }
    } else {
        header("Location: read.php");
        exit;
    }

    if (isset($_POST['update'])) {
        $data = [
            'klantNaam'      => $_POST['klantNaam'],
            'klantEmail'     => $_POST['klantEmail'],
            'klantAdres'     => $_POST['klantAdres'],
            'klantPostcode'  => $_POST['klantPostcode'],
            'klantWoonplaats'=> $_POST['klantWoonplaats']
        ];
        if ($klantObj->updateKlant($klantId, $data)) {
            header("Location: read.php?success=1");
            exit;
        } else {
            $melding = "Wijzigen mislukt!";
        }
    }

    require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="bas-formulier-container">
        <form method="post" class="bas-formulier-grid">
            <h2 class="bas-formulier-title">Klant wijzigen</h2>
            <?php if ($melding): ?>
                <div class="bas-formulier-melding"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="bas-formulier-label" for="klantNaam">Naam</label>
            <input class="bas-formulier-input" type="text" id="klantNaam" name="klantNaam" value="<?= htmlspecialchars($row['klantNaam']) ?>" required>

            <label class="bas-formulier-label" for="klantEmail">Email</label>
            <input class="bas-formulier-input" type="email" id="klantEmail" name="klantEmail" value="<?= htmlspecialchars($row['klantEmail']) ?>" required>

            <label class="bas-formulier-label" for="klantAdres">Adres</label>
            <input class="bas-formulier-input" type="text" id="klantAdres" name="klantAdres" value="<?= htmlspecialchars($row['klantAdres']) ?>" required>

            <label class="bas-formulier-label" for="klantPostcode">Postcode</label>
            <input class="bas-formulier-input" type="text" id="klantPostcode" name="klantPostcode" value="<?= htmlspecialchars($row['klantPostcode']) ?>" required>

            <label class="bas-formulier-label" for="klantWoonplaats">Woonplaats</label>
            <input class="bas-formulier-input" type="text" id="klantWoonplaats" name="klantWoonplaats" value="<?= htmlspecialchars($row['klantWoonplaats']) ?>" required>

            <div class="bas-formulier-btns">
                <input type="submit" name="update" value="Wijzigen" class="bas-tabel-btn">
                <a href="read.php" class="bas-tabel-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>