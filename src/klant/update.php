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
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Klant wijzigen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="crud-form-label" for="klantNaam">Naam</label>
            <input class="crud-form-input" type="text" id="klantNaam" name="klantNaam" value="<?= htmlspecialchars($row['klantNaam']) ?>" required>

            <label class="crud-form-label" for="klantEmail">Email</label>
            <input class="crud-form-input" type="email" id="klantEmail" name="klantEmail" value="<?= htmlspecialchars($row['klantEmail']) ?>" required>

            <label class="crud-form-label" for="klantAdres">Adres</label>
            <input class="crud-form-input" type="text" id="klantAdres" name="klantAdres" value="<?= htmlspecialchars($row['klantAdres']) ?>" required>

            <label class="crud-form-label" for="klantPostcode">Postcode</label>
            <input class="crud-form-input" type="text" id="klantPostcode" name="klantPostcode" value="<?= htmlspecialchars($row['klantPostcode']) ?>" required>

            <label class="crud-form-label" for="klantWoonplaats">Woonplaats</label>
            <input class="crud-form-input" type="text" id="klantWoonplaats" name="klantWoonplaats" value="<?= htmlspecialchars($row['klantWoonplaats']) ?>" required>

            <div class="crud-form-btns">
                <button type="submit" name="update" class="crud-form-btn">Wijzigen</button>
                <a href="read.php" class="crud-form-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>