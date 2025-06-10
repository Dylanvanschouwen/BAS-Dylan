<?php
// auteur: Dylan van Schouwen
// functie: Logout
session_start();
session_unset();
session_destroy();
header("Location: /2024-2025/BAS/src/index.php");
exit;