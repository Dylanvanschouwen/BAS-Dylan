<?php
// auteur: Dylan van Schouwen
//functie: Magazijn-meester pagina

session_start();
if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'magazijnmeester') {
    header("Location: ../Login.php");
    exit;
}
require_once '../Includes/header.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

$artikelObj = new artikel();
$artikelen = $artikelObj->getArtikelen();

// Zoekfunctionaliteit
$zoekId = $_GET['zoekId'] ?? '';
$zoekOmschrijving = $_GET['zoekOmschrijving'] ?? '';

if ($zoekId !== '') {
    $artikelen = array_filter($artikelen, fn($a) => $a['artId'] == $zoekId);
}
if ($zoekOmschrijving !== '') {
    $artikelen = array_filter($artikelen, fn($a) => stripos($a['artOmschrijving'], $zoekOmschrijving) !== false);
}
?>

<main id="magazijn-meester-main">
    <div class="artikel-zoek-container">
        <form method="get" class="artikel-zoek-form">
            <input type="text" name="zoekId" placeholder="Zoek op artikel-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekOmschrijving" placeholder="Zoek op omschrijving" value="<?= htmlspecialchars($zoekOmschrijving) ?>">
            <button type="submit" class="artikel-btn">Zoeken</button>
            <a href="Magazijn-meester.php" class="artikel-btn">Reset</a>
        </form>
        <a href="../artikel/insert.php" class="artikel-toevoegen-btn">Artikel toevoegen</a>
    </div>
    <table class="artikel-tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Omschrijving</th>
                <th>Inkoop</th>
                <th>Verkoop</th>
                <th>Voorraad</th>
                <th>Min</th>
                <th>Max</th>
                <th>Locatie</th>
                <th>Wijzig</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($artikelen as $artikel): ?>
            <tr id="row-<?= $artikel['artId'] ?>">
                <td><?= $artikel['artId'] ?></td>
                <td><?= htmlspecialchars($artikel['artOmschrijving']) ?></td>
                <td><?= $artikel['artInkoop'] ?></td>
                <td><?= $artikel['artVerkoop'] ?></td>
                <td><?= $artikel['artVoorraad'] ?></td>
                <td><?= $artikel['artMinVoorraad'] ?></td>
                <td><?= $artikel['artMaxVoorraad'] ?></td>
                <td><?= $artikel['artLocatie'] ?></td>
                <td>
                    <a href="../artikel/update.php?artId=<?= $artikel['artId'] ?>" class="artikel-btn">Wijzig</a>
                </td>
                <td>
                    <button type="button" class="artikel-btn artikel-verwijder-btn" data-id="<?= $artikel['artId'] ?>">Verwijder</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div id="verwijder-melding" style="display:none;"></div>
</main>

<script>
document.querySelectorAll('.artikel-verwijder-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const artId = this.dataset.id;
        if(confirm('Weet je zeker dat je dit artikel wilt verwijderen?')) {
            fetch('../artikel/delete.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'artId=' + encodeURIComponent(artId)
            })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === 'constraint') {
                    document.getElementById('verwijder-melding').textContent = 'Kan artikel niet verwijderen: het wordt nog gebruikt in een order.';
                    document.getElementById('verwijder-melding').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('verwijder-melding').style.display = 'none';
                    }, 4000);
                } else if (data.trim() === 'success') {
                    document.getElementById('row-' + artId).style.textDecoration = 'line-through';
                    document.getElementById('verwijder-melding').textContent = 'Artikel verwijderd!';
                    document.getElementById('verwijder-melding').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('verwijder-melding').style.display = 'none';
                    }, 2000);
                } else {
                    document.getElementById('verwijder-melding').textContent = 'Verwijderen mislukt.';
                    document.getElementById('verwijder-melding').style.display = 'block';
                    setTimeout(() => {
                        document.getElementById('verwijder-melding').style.display = 'none';
                    }, 2000);
                }
            });
        }
    });
});
</script>

<?php require_once '../Includes/footer.php'; ?>