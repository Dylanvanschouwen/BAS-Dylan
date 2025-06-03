<?php
    // auteur: Dylan van schouwen
    // functie: update class leverancier

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\leverancier;
    
    $leverancier = new leverancier;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        // Code voor een update
        
    }

    if (isset($_GET['leverancierId'])){
        $row = $leverancier->getleverancier($_GET['leverancierId']);


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
<h1>CRUD leverancier</h1>
<h2>Wijzigen</h2>	
<form method="post">
<input type="hidden" name="leverancierId" 
    value="<?php if(isset($row)) { echo $row['leverancierId']; } ?>">
<input type="text" name="leveranciernaam" required 
    value="<?php if(isset($row)) {echo $row['leverancierNaam']; }?>"> *</br>
<input type="text" name="leverancieremail" required 
    value="<?php if(isset($row)) {echo $row["leverancierEmail"]; }?>"> *</br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Geen leverancierId opgegeven<br>";
    }
?>