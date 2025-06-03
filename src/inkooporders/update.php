<?php
    // auteur: Dylan van schouwen
    // functie: update class inkooporders

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\inkooporders;
    
    $inkooporders = new inkooporders;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        // Code voor een update
        
    }

    if (isset($_GET['inkoopordersId'])){
        $row = $inkooporders->getinkooporders($_GET['inkoopordersId']);


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
<h2>Wijzigen</h2>	
<form method="post">
<input type="hidden" name="inkoopordersId" 
    value="<?php if(isset($row)) { echo $row['inkoopordersId']; } ?>">
<input type="text" name="inkoopordersnaam" required 
    value="<?php if(isset($row)) {echo $row['inkoopordersNaam']; }?>"> *</br>
<input type="text" name="inkoopordersemail" required 
    value="<?php if(isset($row)) {echo $row["inkoopordersEmail"]; }?>"> *</br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Geen inkoopordersId opgegeven<br>";
    }
?>