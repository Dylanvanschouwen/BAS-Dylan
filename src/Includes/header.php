<!--
    auteur: Dylan van Schouwen
    Function: header for the homepage 
-->
<?php 
$isRoot = (dirname($_SERVER['PHP_SELF']) === '/2024-2025/BAS/src' || dirname($_SERVER['PHP_SELF']) === '\\2024-2025\\BAS\\src');
$stylePath = $isRoot ? 'style.css' : '../style.css';
$logoPath = $isRoot ? 'IMG/BAS-logo.png' : '../IMG/BAS-logo.png';
$homePath = $isRoot ? 'index.php' : '../index.php';
$logoutPath = $isRoot ? 'User Interaction/Logout.php' : '../User Interaction/Logout.php';
$loginPath = $isRoot ? 'User Interaction/Login.php' : '../User Interaction/Login.php';
$accountPath = $isRoot ? 'User Interaction/Account.php' : '../User Interaction/Account.php';
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
                <li><a href="<?php echo $homePath; ?>">Home</a></li>
                <li><a href="<?php echo $loginPath; ?>">Login</a></li>
                <li><a href="<?php echo $logoutPath; ?>">Logout</a></li>
                <li><a href="<?php echo $accountPath; ?>">Account</a></li>
            </ul>
        </nav>
    </header>