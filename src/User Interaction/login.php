<?php

session_start();
require_once '../Includes/header.php';
require_once '../classes/Database.php';

// Error message variable
$error = '';

// Handle login POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['gebruikersnaam'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    // Connect to DB
    $db = new Bas\classes\Database();
    $conn = $db->getConnection();

    // Prepare and execute
    $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam");
    $stmt->execute(['gebruikersnaam' => $gebruikersnaam]);
    $user = $stmt->fetch();

    // Check password (assuming wachtwoord is hashed in DB)
    if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['rol'] = strtolower($user['rol']);

        // Redirect based on role
        switch (strtolower($user['rol'])) {
            case 'verkoper':
                header('Location: verkoper.php');
                exit;
            case 'inkoper':
                header('Location: inkoper.php');
                exit;
            case 'magazijn medewerker':
                header('Location: magazijnmedewerker.php');
                exit;
            case 'bezorger':
                header('Location: bezorger.php');
                exit;
            case 'magazijnmeester':
                header('Location: magazijn-meester.php');
                exit;
            case 'admin':
                header('Location: admin.php');
                exit;
            default:
                $error = "Onbekende rol.";
        }
    } else {
        $error = "Gebruikersnaam of wachtwoord klopt niet.";
    }
}
?>

<main id="login-main">
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" id="login-form" autocomplete="off">
            <div class="login-row">
                <label for="gebruikersnaam">Username:</label>
                <input type="text" name="gebruikersnaam" id="gebruikersnaam" required>
            </div>
            <div class="login-row">
                <label for="wachtwoord">Password:</label>
                <input type="password" name="wachtwoord" id="wachtwoord" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>