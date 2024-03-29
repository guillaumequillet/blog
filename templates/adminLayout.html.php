<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <link href="https://fonts.googleapis.com/css?family=Calligraffitti&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title><?= $pageTitle ?></title>

    <script src='https://cdn.tiny.cloud/1/hvo1ed06n0kpv30hc1bl0sm7zcxah2135wz5icrg2adetb59/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({ selector: '#episodeContent' });
    </script>
</head>
<body id="bodyAdmin">
    <header>
        <h1>Administration</h1>
        <p>
            <a href="index.php?controller=auth&action=logout">Se déconnecter</a>
        </p>
        <nav id="mainMenu">
            <ul>
                <li><a href="index.php?controller=admin&action=episodes">Episodes</a></li>
                <li><a href="index.php?controller=admin&action=comments&param=1">Commentaires signalés</a></li>
                <li><a href="index.php?controller=admin&action=comments&param=0">Tous les commentaires</a></li>
                <li><a href="index.php?controller=admin&action=user">Identifiants Connexion</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <?= $pageContent ?>
    </main>

    <footer>
        <p>&copy; 2019 Jean Forteroche <strong>"Billet simple pour l'Alaska"</strong>. Tous droits réservés. Reproduction totale ou partielle interdite sans autorisation.</p>
    </footer>

    <script src="js/admin-script.js"></script>
</body>
</html>
