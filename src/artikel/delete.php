<?php
// auteur: Dylan van schouwen
// functie: 

// Autoloader classes via composer
require '../../vendor/autoload.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['artId'])) {
	$artikelObj = new artikel();
	$deleted = $artikelObj->deleteArtikel((int)$_POST['artId']);
	if ($deleted) {
		echo 'success';
	} else {
		echo 'constraint'; // Speciaal voor constraint errors
	}
} else {
	echo 'invalid';
}
