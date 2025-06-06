<?php
// auteur: Dylan van schouwen
// functie: delete class artikel 

// Autoloader classes via composer
require '../../vendor/autoload.php';
require_once '../classes/artikel.php';

use Bas\classes\artikel;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['artId'])) {
	$artikelObj = new artikel();
	$deleted = $artikelObj->deleteArtikel((int)$_POST['artId']);
	if ($deleted) {
		header("Location: read.php?success=1");
		exit;
	} else {
		header("Location: read.php?error=1");
		exit;
	}
}
