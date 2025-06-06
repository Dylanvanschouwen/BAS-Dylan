<?php
// auteur: Dylan van schouwen
// functie: leverancier toevoegen

session_start();
require '../../vendor/autoload.php';
require_once '../classes/leverancier.php';
use Bas\classes\leverancier;

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

    $leverancierObj = new leverancier();
    $data = [
        'levNaam'       => $_POST['levNaam'],
        'levContact'    => $_POST['levContact'],
        'levEmail'      => $_POST['levEmail'],
        'levAdres'      => $_POST['levAdres'],
        'levPostcode'   => $_POST['levPostcode'],
        'levWoonplaats' => $_POST['levWoonplaats']
    ];
    if ($leverancierObj->insertLeverancier($data)) {
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
            <h2 class="crud-form-title">Leverancier toevoegen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="crud-form-message">Leverancier succesvol toegevoegd!</div>
            <?php endif; ?>

            <label class="crud-form-label" for="levNaam">Naam</label>
            <input class="crud-form-input" type="text" id="levNaam" name="levNaam" required>

            <label class="crud-form-label" for="levContact">Contactpersoon</label>
            <input class="crud-form-input" type="text" id="levContact" name="levContact" required>

            <label class="crud-form-label" for="levEmail">Email</label>
            <input class="crud-form-input" type="email" id="levEmail" name="levEmail" required>

            <label class="crud-form-label" for="levAdres">Adres</label>
            <input class="crud-form-input" type="text" id="levAdres" name="levAdres" required>

            <label class="crud-form-label" for="levPostcode">Postcode</label>
            <input class="crud-form-input" type="text" id="levPostcode" name="levPostcode" required>

            <label class="crud-form-label" for="levWoonplaats">Woonplaats</label>
            <input class="crud-form-input" type="text" id="levWoonplaats" name="levWoonplaats" required>

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



