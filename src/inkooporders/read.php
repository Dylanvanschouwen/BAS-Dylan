<!--
	Auteur: Studentnaam
	Function: home page CRUD inkooporder
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
<?php
// auteur: Dylan van schouwen
// functie: Overzicht inkooporders

require '../../vendor/autoload.php';
require_once '../classes/inkooporder.php';
use Bas\classes\inkooporder;

$inkooporderObj = new inkooporder();

$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekLeverancier = isset($_GET['zoekLeverancier']) ? trim($_GET['zoekLeverancier']) : '';

if ($zoekId !== '') {
    $orders = [];
    $row = $inkooporderObj->zoekOpId((int)$zoekId);
    if ($row) $orders[] = $row;
} elseif ($zoekLeverancier !== '') {
    // LET OP: hier zoeken we op levId, want je hebt geen leverancierNaam in deze tabel
    $orders = $inkooporderObj->zoekOpLeverancier($zoekLeverancier);
} else {
    $orders = $inkooporderObj->getInkooporders();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <h1>CRUD inkooporder</h1>
    <div class="inkooporder-zoek-container">
        <form method="get" class="bas-tabel-zoek-form">
            <input type="number" name="zoekId" class="bas-tabel-input" placeholder="Zoek op order-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="number" name="zoekLeverancier" class="bas-tabel-input" placeholder="Zoek op leverancier-ID" value="<?= htmlspecialchars($zoekLeverancier) ?>">
            <button type="submit" class="bas-tabel-btn">Zoek</button>
            <a href="read.php" class="bas-tabel-btn">Reset</a>
        </form>
        <a href="insert.php" class="bas-tabel-btn">Inkooporder toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Leverancier ID</th>
                <th>Artikel ID</th>
                <th>Datum</th>
                <th>Besteld aantal</th>
                <th>Status</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($orders)): ?>
            <tr>
                <td colspan="8">Geen inkooporders gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['inkOrdId']) ?></td>
                    <td><?= htmlspecialchars($order['levId']) ?></td>
                    <td><?= htmlspecialchars($order['artId']) ?></td>
                    <td><?= htmlspecialchars($order['inkOrdDatum']) ?></td>
                    <td><?= htmlspecialchars($order['inkOrdBestAantal']) ?></td>
                    <td><?= htmlspecialchars($order['inkOrdStatus']) ?></td>
                    <td>
                        <a href="update.php?inkOrdId=<?= $order['inkOrdId'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je deze inkooporder wilt verwijderen?');">
                            <input type="hidden" name="inkOrdId" value="<?= $order['inkOrdId'] ?>">
                            <button type="submit" class="bas-tabel-btn">Verwijder</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody> </tbody>
    </table>


<?php require_once '../Includes/footer.php'; ?></main></main>

</body>
</html>