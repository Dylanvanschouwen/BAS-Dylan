<?php
session_start();
if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'admin') {
    header("Location: ../User Interaction/Login.php");
    exit;
}
require_once '../Includes/header.php';
?>
<main class="bas-main">
    <h1 class="bas-main-title">Admin menu</h1>
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
        <a href="../leverancier/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Leveranciers<br>beheer</span>
            <span class="bas-main-btn-desc">
                Beheer leveranciers: Bekijk, wijzig of verwijder leveranciers<br>
                Zoek op naam of plaats
            </span>
        </a>
        <a href="../inkooporders/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Inkooporders</span>
            <span class="bas-main-btn-desc">
                Beheer inkooporders: Voeg toe, wijzig, verwijder<br>
                Zoek op order-ID of leverancier
            </span>
        </a>
        <a href="../gebruikers/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Gebruikers</span>
            <span class="bas-main-btn-desc">
                Beheer gebruikers: Voeg toe, wijzig, verwijder<br>
                Wijs rollen toe en beheer accounts
            </span>
        </a>
    </div>
</main>
<?php require_once '../Includes/footer.php'; ?>