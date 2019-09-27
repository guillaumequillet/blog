<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title><?= $pageTitle ?></title>
</head>
<body>
    <header>
        <p>Ici se trouvera un logo incroyable</p>
        <p>Nous vous souhaitons la bienvenue sur le livre numérique de Jean Forteroche !</p>
        <nav>
            <ul>
                <li><a href="index.php?controller=episode&action=home">Accueil</a></li>
                <li><a href="index.php?controller=episode&action=show&param=1">Episodes</a></li>
                <li>Administration</li>
            </ul>
        </nav>
    </header>
    <main>
        <?= $pageContent ?>
    </main>

    <footer>
        <p>&copy; 2019 Jean Forteroche "Billet simple pour l'Alaska"</p>
    </footer>
</body>
</html>