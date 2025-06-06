<?php
    // auteur: Dylan van schouwen
    // functie: gebruiker wijzigen

    require '../../vendor/autoload.php';
    use Bas\classes\gebruikers;

    $gebruikersObj = new gebruikers();
    $melding = '';

    if (isset($_GET['gebruikersId'])) {
        $gebruikersId = (int)$_GET['gebruikersId'];
        $row = $gebruikersObj->getGebruikerById($gebruikersId);
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
            'gebruikersnaam' => $_POST['gebruikersnaam'],
            'rol'            => $_POST['rol']
        ];

        if (!empty($_POST['wachtwoord'])) {
            $data['wachtwoord'] = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
        }

        if ($gebruikersObj->updateGebruiker($gebruikersId, $data)) {
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
            <h2 class="crud-form-title">Gebruiker wijzigen</h2>
            <?php if ($melding): ?>
                <div class="crud-form-message"><?= htmlspecialchars($melding) ?></div>
            <?php endif; ?>

            <label class="crud-form-label" for="gebruikersnaam">Gebruikersnaam</label>
            <input class="crud-form-input" type="text" id="gebruikersnaam" name="gebruikersnaam" value="<?= htmlspecialchars($row['gebruikersnaam']) ?>" required>

            <label class="crud-form-label" for="rol">Rol</label>
            <input class="crud-form-input" type="text" id="rol" name="rol" value="<?= htmlspecialchars($row['rol']) ?>" required>

            <label class="crud-form-label" for="wachtwoord">Nieuw wachtwoord (optioneel)</label>
            <input class="crud-form-input" type="password" id="wachtwoord" name="wachtwoord" autocomplete="new-password">

            <div class="crud-form-btns">
                <button type="submit" name="update" class="crud-form-btn">Wijzigen</button>
                <a href="read.php" class="crud-form-btn">Terug</a>
            </div>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>