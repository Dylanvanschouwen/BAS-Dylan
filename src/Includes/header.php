<!--
    auteur: Dylan van Schouwen
    Function: header for the homepage 
-->
<?php 
$isRoot = (dirname($_SERVER['PHP_SELF']) === '/2024-2025/BAS/src' || dirname($_SERVER['PHP_SELF']) === '\\2024-2025\\BAS\\src');
$stylePath = $isRoot ? 'style.css' : '../style.css';
$logoPath = $isRoot ? 'IMG/BAS-logo.png' : '../IMG/BAS-logo.png';
$homePath = $isRoot ? 'index.php' : '../index.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boodschappenservice Bas Brengt Boodschappen</title>
    <link rel="stylesheet" href="<?php echo $stylePath; ?>">
</head>
<body>
<div id="homepage-wrapper">
    <header id="homepage-header">
        <div id="homepage-logo">
            <a href="<?php echo $homePath; ?>">
                <img id="homepage-logo-box" src="<?php echo $logoPath; ?>" alt="Bas Logo">
            </a>
        </div>
        <div id="homepage-header-text">
            <h1>Boodschappenservice
                <br>Bas Brengt
                <br>Boodschappen
            </h1>
        </div>
        <nav id="nav">
            <ul id="nav-list">
                <li><a href="../gebruikers/read.php">Gebruikers</a></li>
                <li><a href="../klant/read.php">Klant</a></li>
                <li><a href="../artikel/read.php">Artikel</a></li>
                <li><a href="../leverancier/read.php">Leverancier</a></li>
                <li><a href="../verkooporders/read.php">Verkooporders</a></li>	
            </ul>
        </nav>
    </header>