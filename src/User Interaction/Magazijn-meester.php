<?php
// auteur: Dylan van Schouwen
// functie: Magazijn-meester pagina

session_start();
if (!isset($_SESSION['rol']) || strtolower($_SESSION['rol']) !== 'magazijnmeester') {
    header("Location: ../User Interaction/Login.php");
    exit;
}
require_once '../Includes/header.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

$artikelObj = new artikel();

$zoekId = isset($_GET['zoekId']) ? trim($_GET['zoekId']) : '';
$zoekOmschrijving = isset($_GET['zoekOmschrijving']) ? trim($_GET['zoekOmschrijving']) : '';

if ($zoekId !== '') {
    $artikelen = $artikelObj->zoekOpId((int)$zoekId);
} elseif ($zoekOmschrijving !== '') {
    $artikelen = $artikelObj->zoekOpOmschrijving($zoekOmschrijving);
} else {
    $artikelen = $artikelObj->getArtikelen();
}
?>

<main class="bas-main">
    <div class="crud-searchbar-container">
        <form method="get" class="crud-searchbar-form">
            <input type="number" name="zoekId" class="crud-searchbar-input" placeholder="Zoek op artikel-ID" value="<?= htmlspecialchars($zoekId) ?>">
            <input type="text" name="zoekOmschrijving" class="crud-searchbar-input" placeholder="Zoek op omschrijving" value="<?= htmlspecialchars($zoekOmschrijving) ?>">
            <button type="submit" class="crud-searchbar-btn">Zoek</button>
            <a href="magazijn-meester.php" class="crud-searchbar-btn">Reset</a>
        </form>
        <a href="../artikel/insert.php" class="crud-add-btn">Artikel toevoegen</a>
    </div>
    <table class="bas-tabel">
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
        <?php if (empty($artikelen)): ?>
            <tr>
                <td colspan="10">Geen artikelen gevonden.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($artikelen as $artikel): ?>
                <tr id="row-<?= $artikel['artId'] ?>">
                    <td><?= htmlspecialchars($artikel['artId']) ?></td>
                    <td><?= htmlspecialchars($artikel['artOmschrijving']) ?></td>
                    <td><?= htmlspecialchars($artikel['artInkoop']) ?></td>
                    <td><?= htmlspecialchars($artikel['artVerkoop']) ?></td>
                    <td><?= htmlspecialchars($artikel['artVoorraad']) ?></td>
                    <td><?= htmlspecialchars($artikel['artMinVoorraad']) ?></td>
                    <td><?= htmlspecialchars($artikel['artMaxVoorraad']) ?></td>
                    <td><?= htmlspecialchars($artikel['artLocatie']) ?></td>
                    <td>
                        <a href="../artikel/update.php?artId=<?= $artikel['artId'] ?>" class="bas-tabel-btn">Wijzig</a>
                    </td>
                    <td>
                        <button type="button" class="bas-tabel-btn artikel-verwijder-btn" data-id="<?= $artikel['artId'] ?>">Verwijder</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <div id="verwijder-melding"></div>
</main>

<script>
document.querySelectorAll('.artikel-verwijder-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const artId = this.dataset.id;
        const melding = document.getElementById('verwijder-melding');
        if(confirm('Weet je zeker dat je dit artikel wilt verwijderen?')) {
            fetch('../artikel/delete.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'artId=' + encodeURIComponent(artId)
            })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === 'constraint') {
                    melding.textContent = 'Kan artikel niet verwijderen: het wordt nog gebruikt in een order.';
                    melding.classList.add('zichtbaar');
                    setTimeout(() => melding.classList.remove('zichtbaar'), 4000);
                } else if (data.trim() === 'success') {
                    document.getElementById('row-' + artId).style.textDecoration = 'line-through';
                    melding.textContent = 'Artikel verwijderd!';
                    melding.classList.add('zichtbaar');
                    setTimeout(() => melding.classList.remove('zichtbaar'), 2000);
                } else {
                    melding.textContent = 'Verwijderen mislukt.';
                    melding.classList.add('zichtbaar');
                    setTimeout(() => melding.classList.remove('zichtbaar'), 2000);
                }
            });
        }
    });
});
</script>

<?php require_once '../Includes/footer.php'; ?>