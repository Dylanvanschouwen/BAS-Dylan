<?php
// auteur: Dylan van schouwen
// functie: insert class artikel

session_start(); 
require '../../vendor/autoload.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

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

    $artikelObj = new artikel();
    $data = [
        'artOmschrijving'   => $_POST['artOmschrijving'],
        'artInkoop'         => $_POST['artInkoop'],
        'artVerkoop'        => $_POST['artVerkoop'],
        'artVoorraad'       => $_POST['artVoorraad'],
        'artMinVoorraad'    => $_POST['artMinVoorraad'],
        'artMaxVoorraad'    => $_POST['artMaxVoorraad'],
        'artLocatie'        => $_POST['artLocatie']
    ];
    if ($artikelObj->insertArtikel($data)) {
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
            <h2 class="crud-form-title">Artikel toevoegen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="crud-form-message">Artikel succesvol toegevoegd!</div>
            <?php endif; ?>

            <label class="crud-form-label" for="artOmschrijving">Artikel omschrijving</label>
            <input class="crud-form-input" type="text" id="artOmschrijving" name="artOmschrijving" required>

            <label class="crud-form-label" for="artInkoop">Artikel inkoop</label>
            <input class="crud-form-input" type="number" step="0.01" id="artInkoop" name="artInkoop" required>

            <label class="crud-form-label" for="artVerkoop">Artikel verkoop</label>
            <input class="crud-form-input" type="number" step="0.01" id="artVerkoop" name="artVerkoop" required>

            <label class="crud-form-label" for="artVoorraad">Artikel voorraad</label>
            <input class="crud-form-input" type="number" id="artVoorraad" name="artVoorraad" required>

            <label class="crud-form-label" for="artMinVoorraad">Artikel Min voorraad</label>
            <input class="crud-form-input" type="number" id="artMinVoorraad" name="artMinVoorraad" required>

            <label class="crud-form-label" for="artMaxVoorraad">Artikel Max voorraad</label>
            <input class="crud-form-input" type="number" id="artMaxVoorraad" name="artMaxVoorraad" required>

            <label class="crud-form-label" for="artLocatie">Artikel locatie</label>
            <input class="crud-form-input" type="text" id="artLocatie" name="artLocatie" required>

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