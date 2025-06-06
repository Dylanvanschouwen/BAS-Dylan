<?php
    // auteur: Dylan van schouwen
    // functie: leverancier wijzigen

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
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Leverancier wijzigen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="crud-form-label" for="levNaam">Naam</label>
            <input class="crud-form-input" type="text" id="levNaam" name="levNaam" value="<?= htmlspecialchars($row['levNaam']) ?>" required>

            <label class="crud-form-label" for="levContact">Contactpersoon</label>
            <input class="crud-form-input" type="text" id="levContact" name="levContact" value="<?= htmlspecialchars($row['levContact']) ?>" required>

            <label class="crud-form-label" for="levEmail">Email</label>
            <input class="crud-form-input" type="email" id="levEmail" name="levEmail" value="<?= htmlspecialchars($row['levEmail']) ?>" required>

            <label class="crud-form-label" for="levAdres">Adres</label>
            <input class="crud-form-input" type="text" id="levAdres" name="levAdres" value="<?= htmlspecialchars($row['levAdres']) ?>" required>

            <label class="crud-form-label" for="levPostcode">Postcode</label>
            <input class="crud-form-input" type="text" id="levPostcode" name="levPostcode" value="<?= htmlspecialchars($row['levPostcode']) ?>" required>

            <label class="crud-form-label" for="levWoonplaats">Woonplaats</label>
            <input class="crud-form-input" type="text" id="levWoonplaats" name="levWoonplaats" value="<?= htmlspecialchars($row['levWoonplaats']) ?>" required>

            <div class="crud-form-btns">
                <button type="submit" name="update" class="crud-form-btn">Wijzigen</button>
                <a href="read.php" class="crud-form-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>