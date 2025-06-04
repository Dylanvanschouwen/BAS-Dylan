<?php
session_start();
if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'verkoper') {
    header("Location: ../User Interaction/Login.php");
    exit;
}
require_once '../Includes/header.php';
?>
<main class="bas-main">
    <h1 class="bas-main-title">Verkoper menu</h1>
    <div class="bas-main-grid">
        <a href="../artikel/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Artikel<br>beheer</span>
            <span class="bas-main-btn-desc">
                Beheer producten: voeg toe, pas aan of verwijder<br>
                Zoek op artikelnaam, controleer voorraad
            </span>
        </a>
        <a href="../verkooporders/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Verkoop<br>orders</span>
            <span class="bas-main-btn-desc">
                Beheer klantbestellingen: Voeg toe, wijzig, verwijder<br>
                Zoek op order-ID, klantnummer of datum
            </span>
        </a>
        <a href="../klant/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Klanten<br>beheer</span>
            <span class="bas-main-btn-desc">
                Beheer klanten: Bekijk, wijzig of verwijder klantinformatie<br>
                Zoek op klantnaam of postcode
            </span>
        </a>
    </div>
</main>
<?php require_once '../Includes/footer.php'; ?>