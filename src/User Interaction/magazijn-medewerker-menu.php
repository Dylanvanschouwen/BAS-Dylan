<?php
session_start();
if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'magazijn medewerker') {
    header("Location: ../Login.php");
    exit;
}
require_once '../Includes/header.php';
?>
<main class="magazijn-menu-main">
    <h1 class="magazijn-menu-title">Magazijn medewerker menu</h1>
    <div class="magazijn-menu-grid">
        <a href="../artikel/read.php" class="magazijn-menu-btn">
            <span class="magazijn-menu-btn-title">Artikel<br>beheer</span>
            <span class="magazijn-menu-btn-desc">Beheer producten: voeg toe, pas aan of verwijder</span>
        </a>
        <a href="../verkooporders/read.php" class="magazijn-menu-btn">
            <span class="magazijn-menu-btn-title">Verkoop<br>orders</span>
            <span class="magazijn-menu-btn-desc">Beheer klantbestellingen: Voeg toe, wijzig, verwijder</span>
        </a>
    </div>
</main>
<?php require_once '../Includes/footer.php'; ?>