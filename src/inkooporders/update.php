<?php
    // auteur: Dylan van schouwen
    // functie: update class inkooporders

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    require_once '../classes/inkooporder.php';
    use Bas\classes\inkooporder;

    $inkooporderObj = new inkooporder();
    $melding = '';

    if (isset($_GET['inkOrdId'])) {
        $inkOrdId = (int)$_GET['inkOrdId'];
        $row = $inkooporderObj->zoekOpId($inkOrdId);
        if (!$row) {
            header("Location: inkooporders/read.php");
            exit;
        }
    } else {
        header("Location: inkooporders/read.php");
        exit;
    }

    if (isset($_POST['update'])) {
        $data = [
            'levId'            => $_POST['levId'],
            'artId'            => $_POST['artId'],
            'inkOrdDatum'      => $_POST['inkOrdDatum'],
            'inkOrdBestAantal' => $_POST['inkOrdBestAantal'],
            'inkOrdStatus'     => $_POST['inkOrdStatus']
        ];
        if ($inkooporderObj->updateInkooporder($inkOrdId, $data)) {
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
            <h2 class="bas-formulier-title">Inkooporder wijzigen</h2>
            <?php if ($melding): ?>
                <div class="bas-formulier-melding"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="bas-formulier-label" for="levId">Leverancier ID</label>
            <input class="bas-formulier-input" type="number" id="levId" name="levId" value="<?= htmlspecialchars($row['levId']) ?>" required>

            <label class="bas-formulier-label" for="artId">Artikel ID</label>
            <input class="bas-formulier-input" type="number" id="artId" name="artId" value="<?= htmlspecialchars($row['artId']) ?>" required>

            <label class="bas-formulier-label" for="inkOrdDatum">Datum</label>
            <input class="bas-formulier-input" type="date" id="inkOrdDatum" name="inkOrdDatum" value="<?= htmlspecialchars($row['inkOrdDatum']) ?>" required>

            <label class="bas-formulier-label" for="inkOrdBestAantal">Besteld aantal</label>
            <input class="bas-formulier-input" type="number" id="inkOrdBestAantal" name="inkOrdBestAantal" value="<?= htmlspecialchars($row['inkOrdBestAantal']) ?>" required>

            <label class="bas-formulier-label" for="inkOrdStatus">Status</label>
            <input class="bas-formulier-input" type="number" id="inkOrdStatus" name="inkOrdStatus" value="<?= htmlspecialchars($row['inkOrdStatus']) ?>" required>

            <div class="bas-formulier-btns">
                <input type="submit" name="update" value="Wijzigen" class="bas-tabel-btn">
                <a href="read.php" class="bas-tabel-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>