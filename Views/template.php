<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>

<body>
<header>
    <nav>
        <div class="nav-brand">
            <h2> Genshin Collection</h2>
        </div>
        <ul class="nav-links">
            <li><a href="index.php"> Accueil</a></li>
            <li><a href="index.php?action=add-perso"> Ajouter un personnage</a></li>
            <li><a href="index.php?action=add-perso-element"> Ajouter un élément</a></li>
            <li><a href="index.php?action=logs"> Logs</a></li>
            <li><a href="index.php?action=login"> Connexion</a></li>
        </ul>
    </nav>
</header>

<main id="contenu">
    <?= $this->section('content') ?>
</main>

<footer>
    <p>&copy; 2026 Genshin Impact Collection - Projet R3-01</p>
</footer>
</body>
</html>