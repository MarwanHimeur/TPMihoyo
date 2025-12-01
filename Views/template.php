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
    <!-- Menu -->
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="#">Personnages</a></li>
            <li><a href="#">Armes</a></li>
        </ul>
    </nav>
</header>

<!-- #contenu -->
<main id="contenu">
    <?= $this->section('content') ?>
</main>

<footer>
    <p>&copy; 2025 TP Mihoyo - Genshin Impact</p>
</footer>
</body>
</html>