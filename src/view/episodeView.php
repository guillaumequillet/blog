<?php declare(strict_types=1); ?>
<section id="episodeSection">
	<nav id="episodeList">
		<h3>Liste des Episodes</h3>
	    <ul >
	        <?php foreach($data['episodeList'] as $episode): ?>
	        <li><a href=index.php?controller=episode&action=show&param=<?= $episode['id'] ?>><?= $episode['title'] ?></a></li>
	        <?php endforeach; ?>
	    </ul>
	</nav>

	<article>
		<?= $data['episode']['content'] ?>
	</article>
</section>

<section id="comments">
	<h2>Ajouter un commentaire </h2>
	<form action="index.php?controller=comment&action=add&param=<?= $data['episode']['id'] ?>" method="post">
		<label for="author">Nom d'utilisateur</label>
		<input name="author" id="author" required>
		<label for="content">Message</label>
		<textarea name="content" id="content" required></textarea>
		<input type="submit" value="Envoyer le commentaire">
	</form>

	<h2>Commentaires</h2>
	<?php if ($data['comments'] != null): ?>
		<?php foreach($data['comments'] as $comment): ?>
			<p>Auteur : <?= $comment['author'] ?> Message : <?= $comment['content'] ?></p>
			<P>
			<?php
				switch ($comment['status']) {
					case 'UNCHECKED':
						echo '<a href=index.php?controller=comment&action=report&param=' . $comment['id'] . '>Signaler le commentaire</a>';
						break;				
					case 'REPORTED':
						echo 'Le message a été signalé à l\'administrateur';
						break;
					default: 
						echo 'Le message a été validé par l\'administrateur';
				}
			?>
			</p>
			<hr>
		<?php endforeach; ?>
	<?php endif; ?>
</section>