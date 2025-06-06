<?php
// auteur: Dylan van schouwen
// functie: insert class gebruikers

session_start();
require '../../vendor/autoload.php';
require_once '../classes/gebruikers.php';

use Bas\classes\gebruikers;

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

    $gebruikersObj = new gebruikers();
    $data = [
        'gebruikersnaam' => $_POST['gebruikersnaam'],
        'wachtwoord'     => password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT),
        'rol'            => $_POST['rol']
    ];
    if ($gebruikersObj->insertGebruiker($data)) {
        header("Location: insert.php?success=1");
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
            <h2 class="crud-form-title">Gebruiker toevoegen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="crud-form-message">Gebruiker succesvol toegevoegd!</div>
            <?php endif; ?>

            <label class="crud-form-label" for="gebruikersnaam">Gebruikersnaam</label>
            <input class="crud-form-input" type="text" id="gebruikersnaam" name="gebruikersnaam" required>

            <label class="crud-form-label" for="wachtwoord">Wachtwoord</label>
            <input class="crud-form-input" type="password" id="wachtwoord" name="wachtwoord" required>

            <label class="crud-form-label" for="rol">Rol</label>
            <select class="crud-form-input" id="rol" name="rol" required>
                <option value="">Kies een rol</option>
                <option value="Admin">Admin</option>
                <option value="Magazijnmeester">Magazijnmeester</option>
                <option value="Magazijnmedewerker">Magazijnmedewerker</option>
                <option value="Verkoper">Verkoper</option>
                <option value="Inkoper">Inkoper</option>
                <option value="Bezorger">Bezorger</option>
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



