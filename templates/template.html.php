<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<title><?= $pageTitle ?></title>
</head>
<body>
	<header>
		<p>Ici se trouvera un logo incroyable</p>
		<p>Nous vous souhaitons la bienvenue sur le livre numérique de Jean Forteroche !</p>
	</header>
<main>
	<?= $episodeListMenu ?>
	<?= $pageContent ?>
</main>

<section>
	<?= $commentContent ?>
</section>

<footer>
	<p>&copy; 2019 Jean Forteroche "Billet simple pour l'Alaska"</p>
</footer>
</body>
</html>