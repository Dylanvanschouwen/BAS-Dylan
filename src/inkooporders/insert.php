<?php
// auteur: Dylan van schouwen
// functie: insert inkooporder

require '../../vendor/autoload.php';
require_once '../classes/inkooporder.php';
use Bas\classes\inkooporder;

$melding = '';
if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
    $data = [
        'levId'            => $_POST['levId'],
        'artId'            => $_POST['artId'],
        'inkOrdDatum'      => $_POST['inkOrdDatum'],
        'inkOrdBestAantal' => $_POST['inkOrdBestAantal'],
        'inkOrdStatus'     => $_POST['inkOrdStatus']
    ];
    $inkooporderObj = new inkooporder();
    if ($inkooporderObj->insertInkooporder($data)) {
        header("Location: read.php?success=1");
        exit;
    } else {
        $melding = "Toevoegen mislukt!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>CRUD inkooporders</h1>
    <h2>Toevoegen</h2>
    <?php if ($melding): ?>
        <div style="color:red;"><?= htmlspecialchars($melding) ?></div>
    <?php endif; ?>
    <form method="post">
        <label for="levId">Leverancier ID:</label>
        <input type="number" id="levId" name="levId" required/>
        <br>
        <label for="artId">Artikel ID:</label>
        <input type="number" id="artId" name="artId" required/>
        <br>
        <label for="inkOrdDatum">Datum:</label>
        <input type="date" id="inkOrdDatum" name="inkOrdDatum" required/>
        <br>
        <label for="inkOrdBestAantal">Besteld aantal:</label>
        <input type="number" id="inkOrdBestAantal" name="inkOrdBestAantal" required/>
        <br>
        <label for="inkOrdStatus">Status:</label>
        <input type="number" id="inkOrdStatus" name="inkOrdStatus" required/>
        <br><br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>
    <a href='read.php'>Terug</a>

</body>
</html>



