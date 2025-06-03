<?php
    // auteur: Dylan van schouwen
    // functie: update class gebruikers

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\gebruikers;
    
    $gebruikers = new gebruikers;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        // Code voor een update
        
    }

    if (isset($_GET['gebruikersId'])){
        $row = $gebruikers->getgebruikers($_GET['gebruikersId']);


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
<h1>CRUD gebruikers</h1>
<h2>Wijzigen</h2>	
<form method="post">
<input type="hidden" name="gebruikersId" 
    value="<?php if(isset($row)) { echo $row['gebruikersId']; } ?>">
<input type="text" name="gebruikersnaam" required 
    value="<?php if(isset($row)) {echo $row['gebruikersNaam']; }?>"> *</br>
<input type="text" name="gebruikersemail" required 
    value="<?php if(isset($row)) {echo $row["gebruikersEmail"]; }?>"> *</br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Geen gebruikersId opgegeven<br>";
    }
?>