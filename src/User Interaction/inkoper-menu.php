<?php
session_start();
if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'inkoper') {
    header("Location: ../User Interaction/Login.php");
    exit;
}
require_once '../Includes/header.php';
?>
<main class="bas-main">
    <div class="bas-main-grid">
        <a href="../artikel/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Artikelen<br>overzicht</span>
            <span class="bas-main-btn-desc">
                Bekijk alle artikelen, zoek op artikelnummer<br>
                Controleer voorraad en details
            </span>
        </a>
        <a href="../inkooporders/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Inkooporders</span>
            <span class="bas-main-btn-desc">
                Bekijk, voeg toe, wijzig of verwijder inkooporders<br>
                Zoek op inkooporder-ID
            </span>
        </a>
        <a href="../leverancier/read.php" class="bas-main-btn">
            <span class="bas-main-btn-title">Leveranciers</span>
            <span class="bas-main-btn-desc">
                Bekijk, voeg toe, wijzig of verwijder leveranciers<br>
                Zoek op leveranciers-ID of naam
            </span>
        </a>
    </div>
</main>
<?php require_once '../Includes/footer.php'; ?>