<?php
    // auteur: Dylan van schouwen
    // functie: update class inkooporders

    require '../../vendor/autoload.php';
    require_once '../classes/inkooporder.php';
    use Bas\classes\inkooporder;

    $inkooporderObj = new inkooporder();
    $melding = '';

    if (isset($_GET['inkOrdId'])) {
        $inkOrdId = (int)$_GET['inkOrdId'];
        $row = $inkooporderObj->zoekOpId($inkOrdId);
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
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Inkooporder wijzigen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="crud-form-label" for="levId">Leverancier ID</label>
            <input class="crud-form-input" type="number" id="levId" name="levId" value="<?= htmlspecialchars($row['levId']) ?>" required>

            <label class="crud-form-label" for="artId">Artikel ID</label>
            <input class="crud-form-input" type="number" id="artId" name="artId" value="<?= htmlspecialchars($row['artId']) ?>" required>

            <label class="crud-form-label" for="inkOrdDatum">Datum</label>
            <input class="crud-form-input" type="date" id="inkOrdDatum" name="inkOrdDatum" value="<?= htmlspecialchars($row['inkOrdDatum']) ?>" required>

            <label class="crud-form-label" for="inkOrdBestAantal">Besteld aantal</label>
            <input class="crud-form-input" type="number" id="inkOrdBestAantal" name="inkOrdBestAantal" value="<?= htmlspecialchars($row['inkOrdBestAantal']) ?>" required>

            <label class="crud-form-label" for="inkOrdStatus">Status</label>
            <select class="crud-form-input" id="inkOrdStatus" name="inkOrdStatus" required>
                <option value="0" <?= $row['inkOrdStatus'] == 0 ? 'selected' : '' ?>>0</option>
                <option value="1" <?= $row['inkOrdStatus'] == 1 ? 'selected' : '' ?>>1</option>
            </select>

            <div class="crud-form-btns">
                <button type="submit" name="update" class="crud-form-btn">Wijzigen</button>
                <a href="read.php" class="crud-form-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>