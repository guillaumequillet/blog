<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <link href="https://fonts.googleapis.com/css?family=Calligraffitti&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?= $pageTitle ?></title>
</head>
<body>
    <header>
        <h1>Billet Simple pour l'Alaska</h1>
        <h2>Un Roman épisodique par Jean Forteroche</h2>
        <nav id="mainMenu">
            <ul>
                <li><a href="index.php?controller=episode&action=home">Accueil</a></li>
                <li><a href="index.php?controller=episode&action=show&param=1">Episodes</a></li>
                <li><a href="index.php?controller=admin&action=login">Administration</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <ul>
            <li>Paramètres connexion</li>
            <li>Gestion des commentaires</li>
            <li>Gestion des épisodes</li>
        </ul>
        <?= $pageContent ?>
        <p>
            <a href="index.php?controller=admin&action=logout">Se déconnecter</a>
        </p>
    </main>

    <footer>
        <p>&copy; 2019 Jean Forteroche <strong>"Billet simple pour l'Alaska"</strong>. Tous droits réservés. Reproduction totale ou partielle interdite sans autorisation.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>