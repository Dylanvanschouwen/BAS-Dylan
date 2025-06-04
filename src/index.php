<!--
    Auteur: Dylan van schouwen
    Function: home page CRUD Boodschappenservice
-->
<?php include_once 'includes/header.php'; ?>
    <main id="homepage-main">
        <h2 id="homepage-welcome-title">Welkom!</h2>
        <p id="homepage-welcome-desc">Kies uw functie, Log in en zie de gegevens die U nodig heeft.</p>
        <div id="homepage-role-grid">
            <button onclick="location.href='User Interaction/Login.php';" class="homepage-role-btn">Verkoper</button>
            <button onclick="location.href='User Interaction/Login.php';" class="homepage-role-btn">Inkoper</button>
            <button onclick="location.href='User Interaction/Login.php';" class="homepage-role-btn">Magazijn medewerker</button>
            <button onclick="location.href='User Interaction/Login.php';" class="homepage-role-btn">Bezorger</button>
            <button onclick="location.href='User Interaction/Login.php';" class="homepage-role-btn">Magazijn meester</button>
            <button onclick="location.href='User Interaction/Login.php';" class="homepage-role-btn">Administrator</button>
        </div>
    </main>
<?php include_once 'includes/footer.php'; ?>