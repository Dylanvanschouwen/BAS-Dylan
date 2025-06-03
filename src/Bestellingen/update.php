<?php
    // auteur: Dylan van schouwen
    // functie: update class bestellingen

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\bestellingen;
    
    $bestellingen = new bestellingen;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        // Code voor een update
        
    }

    if (isset($_GET['bestellingenId'])){
        $row = $bestellingen->getbestellingen($_GET['bestellingenId']);


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
<h1>CRUD bestellingen</h1>
<h2>Wijzigen</h2>	
<form method="post">
<input type="hidden" name="bestellingenId" 
    value="<?php if(isset($row)) { echo $row['bestellingenId']; } ?>">
<input type="text" name="bestellingennaam" required 
    value="<?php if(isset($row)) {echo $row['bestellingenNaam']; }?>"> *</br>
<input type="text" name="bestellingenemail" required 
    value="<?php if(isset($row)) {echo $row["bestellingenEmail"]; }?>"> *</br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Geen bestellingenId opgegeven<br>";
    }
?>