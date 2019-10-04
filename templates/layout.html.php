<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?= $pageTitle ?></title>
</head>
<body>
    <header>
        <a href="index.php?controller=episode&action=home"><img src="images/header.png" alt="Alaska paysage"></a>
        <nav id="mainMenu">
            <ul>
                <li><a href="index.php?controller=episode&action=home">Accueil</a></li>
                <li><a href="index.php?controller=episode&action=show&param=1">Episodes</a></li>
                <li><a href="#">Administration</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?= $pageContent ?>
    </main>

    <footer>
        <p>&copy; 2019 Jean Forteroche <strong>"Billet simple pour l'Alaska"</strong>. Tous droits réservés. Reproduction totale ou partielle interdite sans autorisation.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>