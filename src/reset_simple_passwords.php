<?php
require_once 'classes/Database.php';

$db = new Bas\classes\Database();
$conn = $db->getConnection();

// Fetch all users
$stmt = $conn->query("SELECT id FROM gebruikers");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    $id = $user['id'];
    $newPassword = (string)$id; // Password will be "1" for id=1, "2" for id=2, etc.
    $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE gebruikers SET wachtwoord = :wachtwoord WHERE id = :id");
    $update->execute(['wachtwoord' => $hashed, 'id' => $id]);
    echo "User ID $id password set to '$newPassword'.<br>";
}

echo "Done!";
?>