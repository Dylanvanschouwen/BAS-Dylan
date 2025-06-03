<?php
    // auteur: Dylan van schouwen
    // functie: update class verkooporders

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\verkooporders;
    
    $verkooporders = new verkooporders;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        // Code voor een update
        
    }

    if (isset($_GET['verkoopordersId'])){
        $row = $verkooporders->getverkooporders($_GET['verkoopordersId']);


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
<h1>CRUD verkooporders</h1>
<h2>Wijzigen</h2>	
<form method="post">
<input type="hidden" name="verkoopordersId" 
    value="<?php if(isset($row)) { echo $row['verkoopordersId']; } ?>">
<input type="text" name="verkoopordersnaam" required 
    value="<?php if(isset($row)) {echo $row['verkoopordersNaam']; }?>"> *</br>
<input type="text" name="verkoopordersemail" required 
    value="<?php if(isset($row)) {echo $row["verkoopordersEmail"]; }?>"> *</br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Geen verkoopordersId opgegeven<br>";
    }
?>