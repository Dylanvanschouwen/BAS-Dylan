<?php
// auteur: Dylan van schouwen
// functie: Bezorger overzicht en status aanpassen

session_start();

require '../../vendor/autoload.php';
require_once '../classes/verkooporders.php';

use Bas\classes\verkooporders;

if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'bezorger') {
    header("Location: ../Login.php");
    exit;
}

$verkOrdObj = new verkooporders();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verkOrdId'], $_POST['verkOrdStatus'])) {
    $verkOrdId = (int)$_POST['verkOrdId'];
    $status = (int)$_POST['verkOrdStatus'];
    $verkOrdObj->updateStatus($verkOrdId, $status);
    header("Location: bezorger.php?success=1");
    exit;
}

$orders = $verkOrdObj->getOrdersWithKlantInfo();

require_once '../Includes/header.php';
?>
<main class="bezorger-main">
    <div class="formulier-container">
        <h2 class="formulier-title bezorger-title">Verkooporders voor bezorging</h2>
        <?php if (isset($_GET['success'])): ?>
            <div id="verwijder-melding">Status succesvol aangepast!</div>
        <?php endif; ?>

        <form method="get" class="bezorger-klant-zoek">
            <label for="zoekKlantId">Zoek klant op ID:</label>
            <input type="number" name="zoekKlantId" id="zoekKlantId" class="formulier-input" min="1" placeholder="Klant-ID" value="<?= isset($_GET['zoekKlantId']) ? htmlspecialchars($_GET['zoekKlantId']) : '' ?>">
            <button type="submit" class="artikel-btn">Zoek</button>
        </form>

        <?php
        if (isset($_GET['zoekKlantId']) && is_numeric($_GET['zoekKlantId'])) {
            require_once '../classes/klant.php';
            $klantObj = new \Bas\classes\Klant();
            $klant = $klantObj->getKlantById((int)$_GET['zoekKlantId']);
            if ($klant) {
                echo "<div class='bezorger-klant-info'>";
                echo "<strong>Klant-ID:</strong> " . htmlspecialchars($klant['klantId']) . "<br>";
                echo "<strong>Naam:</strong> " . htmlspecialchars($klant['klantNaam']) . "<br>";
                echo "<strong>Adres:</strong> " . htmlspecialchars($klant['klantAdres']) . "<br>";
                echo "<strong>Postcode:</strong> " . htmlspecialchars($klant['klantPostcode']) . "<br>";
                echo "<strong>Woonplaats:</strong> " . htmlspecialchars($klant['klantWoonplaats']) . "<br>";
                echo "<strong>Email:</strong> " . htmlspecialchars($klant['klantEmail']) . "<br>";
                echo "</div>";
            } else {
                echo "<div class='bezorger-klant-info'>";
                echo "Geen klant gevonden met ID " . htmlspecialchars($_GET['zoekKlantId']) . ".";
                echo "</div>";
            }
        }
        ?>

        <table class="bezorger-tabel">
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
                        <form method="post" class="bezorger-status-form">
                            <input type="hidden" name="verkOrdId" value="<?= $order['verkOrdId'] ?>">
                            <select name="verkOrdStatus" class="formulier-input">
                                <option value="1" <?= $order['verkOrdStatus']==1?'selected':''; ?>>In behandeling</option>
                                <option value="2" <?= $order['verkOrdStatus']==2?'selected':''; ?>>Onderweg</option>
                                <option value="3" <?= $order['verkOrdStatus']==3?'selected':''; ?>>Afgeleverd</option>
                                <option value="4" <?= $order['verkOrdStatus']==4?'selected':''; ?>>Geannuleerd</option>
                            </select>
                            <button type="submit" class="artikel-btn">Opslaan</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</main>

<?php require_once '../Includes/footer.php'; ?>