<?php
// auteur: Dylan van schouwen
// functie: Overzicht verkooporders

session_start();
require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';

use Bas\classes\verkooporders;

$verkoopordersObj = new verkooporders();
$orders = $verkoopordersObj->getOrdersWithKlantInfo();

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="artikel-tabel-zoek-container">
        <h2 class="bas-tabel-title">Overzicht verkooporders</h2>
        <div class="bas-tabel-topbar">
            <a href="insert.php" class="bas-tabel-btn">Verkooporder toevoegen</a>
        </div>

        <form method="get" class="bas-tabel-zoek-form">
            <input type="number" name="zoekVerkOrdId" class="bas-tabel-input" placeholder="Zoek op OrderID" min="1" value="<?= isset($_GET['zoekVerkOrdId']) ? htmlspecialchars($_GET['zoekVerkOrdId']) : '' ?>">
            <button type="submit" class="bas-tabel-btn">Zoek</button>
            <a href="read.php" class="bas-tabel-btn" style="background:#fff;color:#b00;border:2px solid #b00;">Reset</a>
        </form>

        <?php
        if (isset($_GET['zoekVerkOrdId']) && is_numeric($_GET['zoekVerkOrdId'])) {
            $zoekId = (int)$_GET['zoekVerkOrdId'];
            $orders = array_filter($orders, fn($o) => $o['verkOrdId'] == $zoekId);
        }
        ?>

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
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>