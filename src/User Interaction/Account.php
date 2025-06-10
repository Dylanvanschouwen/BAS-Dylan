<?php
// auteur: Dylan van Schouwen
// functie: Accountpagina voor ingelogde gebruikers

session_start();
require_once '../Includes/header.php';
require_once '../classes/Database.php';

if (!isset($_SESSION['user_id'])) {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        showPopup('Niet ingelogd', 'Je moet ingelogd zijn om deze pagina te bekijken.');
    });
    function showPopup(titel, tekst) {
        let popup = document.createElement('div');
        popup.className = 'popup-overlay';
        popup.innerHTML = `
            <div class="popup-form">
                <h2 class="popup-title">${titel}</h2>
                <p class="popup-message">${tekst}</p>
                <button id="closePopup" class="btn-primary">Sluiten</button>
            </div>
        `;
        document.body.appendChild(popup);
        document.getElementById('closePopup').onclick = function() {
            popup.remove();
            window.location.href = 'login.php';
        };
    }
    </script>
    <?php
    require_once '../Includes/footer.php';
    exit;
}

$db = new Bas\classes\Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT gebruikersnaam, rol FROM gebruikers WHERE id = :id LIMIT 1");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$gebruikersnaam = htmlspecialchars($user['gebruikersnaam']);
$rol = htmlspecialchars($user['rol']);
$wachtwoord = '********';
?>

<main class="bas-main">
    <section class="account-card">
        <h2 class="account-title">Mijn Account</h2>
        <div class="account-info">
            <div class="account-row">
                <span class="account-label">Gebruikersnaam:</span>
                <span class="account-value" id="account-username"><?= $gebruikersnaam ?></span>
            </div>
            <div class="account-row">
                <span class="account-label">Wachtwoord:</span>
                <span class="account-value" id="account-password"><?= $wachtwoord ?></span>
            </div>
            <div class="account-row">
                <span class="account-label">Rol:</span>
                <span class="account-value" id="account-role"><?= $rol ?></span>
            </div>
        </div>
        <div class="account-actions">
            <a href="../User Interaction/Logout.php" class="btn btn-logout" id="logout-btn">Uitloggen</a>
        </div>
    </section>
</main>

<?php require_once '../Includes/footer.php'; ?>