<?php
// auteur: Dylan van schouwen
// functie: Overzicht verkooporders

session_start();
require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';

use Bas\classes\verkooporders;

$verkoopordersObj = new verkooporders();

$zoekVerkOrdId = isset($_GET['zoekVerkOrdId']) ? trim($_GET['zoekVerkOrdId']) : '';
$zoekKlantId   = isset($_GET['zoekKlantId']) ? trim($_GET['zoekKlantId']) : '';
$zoekDatum     = isset($_GET['zoekDatum']) ? trim($_GET['zoekDatum']) : '';

if ($zoekVerkOrdId !== '') {
    $orders = $verkoopordersObj->zoekOpOrderId((int)$zoekVerkOrdId);
} elseif ($zoekKlantId !== '') {
    $orders = $verkoopordersObj->zoekOpKlantId((int)$zoekKlantId);
} elseif ($zoekDatum !== '') {
    $orders = $verkoopordersObj->zoekOpDatum($zoekDatum);
} else {
    $orders = $verkoopordersObj->getOrdersWithKlantInfo();
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekVerkOrdId" class="crud-searchbar-input" placeholder="Zoek op OrderID" min="1" value="<?= isset($_GET['zoekVerkOrdId']) ? htmlspecialchars($_GET['zoekVerkOrdId']) : '' ?>">
            <input type="number" name="zoekKlantId" class="crud-searchbar-input" placeholder="Zoek op Klantnummer" min="1" value="<?= isset($_GET['zoekKlantId']) ? htmlspecialchars($_GET['zoekKlantId']) : '' ?>">
            <input type="date" name="zoekDatum" class="crud-searchbar-input" placeholder="Zoek op Datum" value="<?= isset($_GET['zoekDatum']) ? htmlspecialchars($_GET['zoekDatum']) : '' ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="read.php" class="crud-searchbar-btn">Reset</a>
        </form>
        <a href="insert.php" class="crud-add-btn">Verkooporder toevoegen</a>
    </div>
    <table class="bas-tabel">
        <thead>
            <tr>
                <th>OrderID</th>
                <th>Klantnaam</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Woonplaats</th>
                <th>Besteldatum</th>
                <th>Aantal</th>
                <th>Status</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="10">Geen verkooporders gevonden.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['verkOrdId']) ?></td>
                        <td><?= htmlspecialchars($order['klantNaam']) ?></td>
                        <td><?= htmlspecialchars($order['klantAdres']) ?></td>
                        <td><?= htmlspecialchars($order['klantPostcode']) ?></td>
                        <td><?= htmlspecialchars($order['klantWoonplaats']) ?></td>
                        <td><?= htmlspecialchars($order['verkOrdDatum']) ?></td>
                        <td><?= htmlspecialchars($order['verkOrdBestAantal']) ?></td>
                        <td><?= htmlspecialchars($verkoopordersObj->statusText($order['verkOrdStatus'])) ?></td>
                        <td>
                            <a href="update.php?verkoopordersId=<?= $order['verkOrdId'] ?>" class="bas-tabel-btn">Wijzig</a>
                        </td>
                        <td>
                            <form method="post" action="delete.php" onsubmit="return confirm('Weet je zeker dat je deze verkooporder wilt verwijderen?');">
                                <input type="hidden" name="verkoopordersId" value="<?= $order['verkOrdId'] ?>">
                                <button type="submit" class="bas-tabel-btn">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>
