<?php
    // auteur: Dylan van schouwen
    // functie: update class leverancier

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    require_once '../classes/leverancier.php';
    use Bas\classes\leverancier;
    
    $leverancierObj = new leverancier();
    $melding = '';

    if (isset($_GET['levId'])) {
        $levId = (int)$_GET['levId'];
        $row = $leverancierObj->zoekOpId($levId);
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
            'levNaam'       => $_POST['levNaam'],
            'levContact'    => $_POST['levContact'],
            'levEmail'      => $_POST['levEmail'],
            'levAdres'      => $_POST['levAdres'],
            'levPostcode'   => $_POST['levPostcode'],
            'levWoonplaats' => $_POST['levWoonplaats']
        ];
        if ($leverancierObj->updateLeverancier($levId, $data)) {
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
            <h2 class="bas-formulier-title">Leverancier wijzigen</h2>
            <?php if ($melding): ?>
                <div class="bas-formulier-melding"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="bas-formulier-label" for="levNaam">Naam</label>
            <input class="bas-formulier-input" type="text" id="levNaam" name="levNaam" value="<?= htmlspecialchars($row['levNaam']) ?>" required>

            <label class="bas-formulier-label" for="levContact">Contactpersoon</label>
            <input class="bas-formulier-input" type="text" id="levContact" name="levContact" value="<?= htmlspecialchars($row['levContact']) ?>" required>

            <label class="bas-formulier-label" for="levEmail">Email</label>
            <input class="bas-formulier-input" type="email" id="levEmail" name="levEmail" value="<?= htmlspecialchars($row['levEmail']) ?>" required>

            <label class="bas-formulier-label" for="levAdres">Adres</label>
            <input class="bas-formulier-input" type="text" id="levAdres" name="levAdres" value="<?= htmlspecialchars($row['levAdres']) ?>" required>

            <label class="bas-formulier-label" for="levPostcode">Postcode</label>
            <input class="bas-formulier-input" type="text" id="levPostcode" name="levPostcode" value="<?= htmlspecialchars($row['levPostcode']) ?>" required>

            <label class="bas-formulier-label" for="levWoonplaats">Woonplaats</label>
            <input class="bas-formulier-input" type="text" id="levWoonplaats" name="levWoonplaats" value="<?= htmlspecialchars($row['levWoonplaats']) ?>" required>

            <div class="bas-formulier-btns">
                <input type="submit" name="update" value="Wijzigen" class="bas-tabel-btn">
                <a href="read.php" class="bas-tabel-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>