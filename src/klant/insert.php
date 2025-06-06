<?php
// auteur: Dylan van schouwen
// functie: insert class Klant

session_start();
require '../../vendor/autoload.php';
require_once '../classes/Klant.php';

use Bas\classes\Klant;

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

    $klantObj = new Klant();
    $data = [
        'klantNaam'      => $_POST['klantNaam'],
        'klantEmail'     => $_POST['klantEmail'],
        'klantAdres'     => $_POST['klantAdres'],
        'klantPostcode'  => $_POST['klantPostcode'],
        'klantWoonplaats'=> $_POST['klantWoonplaats']
    ];
    if ($klantObj->insertKlant($data)) {
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
}
?>

<?php require_once '../Includes/header.php'; ?>

<main class="bas-main">
    <div class="crud-form-container">
        <form method="post" class="crud-form-grid">
            <h2 class="crud-form-title">Klant toevoegen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="crud-form-message">Klant succesvol toegevoegd!</div>
            <?php endif; ?>

            <label class="crud-form-label" for="klantNaam">Klantnaam</label>
            <input class="crud-form-input" type="text" id="klantNaam" name="klantNaam" required>

            <label class="crud-form-label" for="klantEmail">Klantemail</label>
            <input class="crud-form-input" type="email" id="klantEmail" name="klantEmail" required>

            <label class="crud-form-label" for="klantAdres">Adres</label>
            <input class="crud-form-input" type="text" id="klantAdres" name="klantAdres" required>

            <label class="crud-form-label" for="klantPostcode">Postcode</label>
            <input class="crud-form-input" type="text" id="klantPostcode" name="klantPostcode" required>

            <label class="crud-form-label" for="klantWoonplaats">Woonplaats</label>
            <input class="crud-form-input" type="text" id="klantWoonplaats" name="klantWoonplaats" required>

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