<?php
// auteur: Dylan van schouwen
// functie: Overzicht inkooporders

session_start();
require '../../vendor/autoload.php';
require_once '../classes/inkooporder.php';

use Bas\classes\inkooporder;

$inkooporderObj = new inkooporder();

$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekLevId = isset($_GET['zoekLevId']) ? trim($_GET['zoekLevId']) : '';
$inkooporders = [];

if ($zoekId !== '') {
    $row = $inkooporderObj->zoekOpId((int)$zoekId);
    if ($row) $inkooporders[] = $row;
} elseif ($zoekLevId !== '') {
    $inkooporders = $inkooporderObj->zoekOpLeverancier($zoekLevId);
} else {
    $inkooporders = $inkooporderObj->getInkooporders();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekId" class="crud-searchbar-input" placeholder="Zoek op order-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="number" name="zoekLevId" class="crud-searchbar-input" placeholder="Zoek op leverancier-ID" value="<?= htmlspecialchars($zoekLevId) ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="read.php" class="crud-searchbar-btn">Reset</a>
        </form>
        <a href="insert.php" class="crud-add-btn">Inkooporder toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>ID</th>
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
        <?php if (empty($inkooporders)): ?>
            <tr>
                <td colspan="8">Geen inkooporders gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($inkooporders as $order): ?>
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
                            <button type="submit" name="verwijderen" class="bas-tabel-btn">Verwijder</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require_once '../Includes/footer.php'; ?>
</body>
</html>