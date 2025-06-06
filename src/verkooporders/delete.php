<?php 
// auteur: Dylan van schouwen
// functie: verkooporder verwijderen

require '../../vendor/autoload.php';
use Bas\classes\verkooporders;

if(isset($_POST["verkoopordersId"])){
    $verkoopordersObj = new verkooporders();
    $verkoopordersObj->deleteVerkooporder((int)$_POST["verkoopordersId"]);
    echo '<script>alert("Verkooporder verwijderd")</script>';
    echo "<script> location.replace('read.php'); </script>";   echo "<script> location.replace('read.php'); </script>";
    exit;
}
?>?>



