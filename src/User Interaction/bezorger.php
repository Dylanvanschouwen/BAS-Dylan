<?php
// auteur: Dylan van schouwen
// functie: Bezorger overzicht en status aanpassen

session_start();

require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';

use Bas\classes\verkooporders;

if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'bezorger') {
    header("Location: ../User Interaction/Login.php");
    exit;
}

$verkOrdObj = new verkooporders();

// Zoekfunctionaliteit
$zoekOrderId = isset($_GET['zoekOrderId']) ? trim($_GET['zoekOrderId']) : '';
$zoekKlantId = isset($_GET['zoekKlantId']) ? trim($_GET['zoekKlantId']) : '';
$zoekDatum   = isset($_GET['zoekDatum']) ? trim($_GET['zoekDatum']) : '';

if ($zoekOrderId !== '') {
    $orders = $verkOrdObj->zoekOpOrderId((int)$zoekOrderId);
} elseif ($zoekKlantId !== '') {
    $orders = $verkOrdObj->zoekOpKlantId((int)$zoekKlantId);
} elseif ($zoekDatum !== '') {
    $orders = $verkOrdObj->zoekOpDatum($zoekDatum);
} else {
    $orders = $verkOrdObj->getOrdersWithKlantInfo();
}

// Status aanpassen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verkOrdId'], $_POST['verkOrdStatus'])) {
    $verkOrdId = (int)$_POST['verkOrdId'];
    $status = (int)$_POST['verkOrdStatus'];
    $verkOrdObj->updateStatus($verkOrdId, $status);
    header("Location: bezorger.php?success=1");
    exit;
}

require_once '../Includes/header.php';
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekOrderId" class="crud-searchbar-input" placeholder="Zoek op OrderID" value="<?= htmlspecialchars($zoekOrderId) ?>">
            <input type="number" name="zoekKlantId" class="crud-searchbar-input" placeholder="Zoek op Klantnummer" value="<?= htmlspecialchars($zoekKlantId) ?>">
            <input type="date" name="zoekDatum" class="crud-searchbar-input" placeholder="Zoek op Datum" value="<?= htmlspecialchars($zoekDatum) ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="bezorger.php" class="crud-searchbar-btn">Reset</a>
        </form>
    </div>
    <?php if (isset($_GET['success'])): ?>
        <div class="crud-form-message" id="verwijder-melding">Status succesvol aangepast!</div>
    <?php endif; ?>

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
                <th>Status aanpassen</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($orders)): ?>
            <tr>
                <td colspan="9">Geen verkooporders gevonden.</td>
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
                    <td><?= htmlspecialchars($verkOrdObj->statusText($order['verkOrdStatus'])) ?></td>
                    <td>
                        <form method="post" class="bezorger-status-form" style="display:flex;gap:8px;align-items:center;">
                            <input type="hidden" name="verkOrdId" value="<?= $order['verkOrdId'] ?>">
                            <select name="verkOrdStatus" class="crud-searchbar-input" style="min-width:140px;">
                                <option value="1" <?= $order['verkOrdStatus']==1?'selected':''; ?>>In behandeling</option>
                                <option value="2" <?= $order['verkOrdStatus']==2?'selected':''; ?>>Onderweg</option>
                                <option value="3" <?= $order['verkOrdStatus']==3?'selected':''; ?>>Afgeleverd</option>
                                <option value="4" <?= $order['verkOrdStatus']==4?'selected':''; ?>>Geannuleerd</option>
                            </select>
                            <button type="submit" class="bas-tabel-btn">Opslaan</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require_once '../Includes/footer.php'; ?>