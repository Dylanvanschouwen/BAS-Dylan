<?php
// auteur: Dylan van schouwen
// functie: insert inkooporder

session_start();
require '../../vendor/autoload.php';
require_once '../classes/inkooporder.php';
use Bas\classes\inkooporder;

$melding = '';
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

    $data = [
        'levId'            => $_POST['levId'],
        'artId'            => $_POST['artId'],
        'inkOrdDatum'      => $_POST['inkOrdDatum'],
        'inkOrdBestAantal' => $_POST['inkOrdBestAantal'],
        'inkOrdStatus'     => $_POST['inkOrdStatus']
    ];
    $inkooporderObj = new inkooporder();
    if ($inkooporderObj->insertInkooporder($data)) {
        header("Location: read.php?success=1");
        exit;
    } else {
        $melding = "Toevoegen mislukt!";
    }
}
?>

<?php require_once '../Includes/header.php'; ?>

<main class="bas-main">
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Inkooporder toevoegen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="crud-form-message">Inkooporder succesvol toegevoegd!</div>
            <?php endif; ?>

            <label class="crud-form-label" for="levId">Leverancier ID</label>
            <input class="crud-form-input" type="number" id="levId" name="levId" required>

            <label class="crud-form-label" for="artId">Artikel ID</label>
            <input class="crud-form-input" type="number" id="artId" name="artId" required>

            <label class="crud-form-label" for="inkOrdDatum">Datum</label>
            <input class="crud-form-input" type="date" id="inkOrdDatum" name="inkOrdDatum" required>

            <label class="crud-form-label" for="inkOrdBestAantal">Besteld aantal</label>
            <input class="crud-form-input" type="number" id="inkOrdBestAantal" name="inkOrdBestAantal" required>

            <label class="crud-form-label" for="inkOrdStatus">Status</label>
            <select class="crud-form-input" id="inkOrdStatus" name="inkOrdStatus" required>
                <option value="0">0</option>
                <option value="1">1</option>
            </select>

            <div class="crud-form-btns">
                <button type="submit" name="toevoegen" class="crud-form-btn">Toevoegen</button>
                <button type="button" id="terugBtn" class="crud-form-btn">Terug</button>
            </div>
        </form>
    </div>
</main>

<script>
document.getElementById('terugBtn').onclick = function() {
    <?php
    $rol = $_SESSION['rol'] ?? '';
    if ($rol === 'magazijnmedewerker') {
        $url = "../User Interaction/magazijn-medewerker-menu.php";
    } elseif ($rol === 'magazijnmeester') {
        $url = "../User Interaction/magazijn-meester.php";
    } elseif ($rol === 'inkoper') {
        $url = "../User Interaction/inkoper-menu.php";
    } elseif ($rol === 'verkoper') {
        $url = "../User Interaction/verkoper-menu.php";
    } elseif ($rol === 'admin') {
        $url = "../User Interaction/admin-menu.php";
    } else {
        $url = "../index.php";
    }
    ?>
    window.location.href = "<?= $url ?>";
};
</script>

<?php require_once '../Includes/footer.php'; ?>



