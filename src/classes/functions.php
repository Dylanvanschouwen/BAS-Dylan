<?php
// auteur: Dylan van schouwen
// functie: algemene functies 

function getTableHeader(array $row) : string {
    $headers = array_keys($row);
    $headerTxt = "<tr>";
    foreach($headers as $header){
        $headerTxt .= "<th>" . $header . "</th>";   
    }
    $headerTxt .= "</tr>";
    return $headerTxt;
}
?>