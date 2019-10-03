<?php declare(strict_types=1); ?>
<section id="episodeSection">
	<nav id="episodeList">
		<h3>Liste des Episodes</h3>
	    <ul >
	        <?php foreach($data['episodeList'] as $key => $episode): ?>
	        <?php if ($episode['id'] === $data['episode']['id']) $currentEpisodeKey = $key; ?>
	        <li><a href=index.php?controller=episode&action=show&param=<?= $episode['id'] ?>><?= $episode['title'] ?></a></li>
	        <?php endforeach; ?>
	    </ul>
	</nav>

	<?php
	    $previousEpisodeKey = ($currentEpisodeKey > 0) ? $currentEpisodeKey - 1 : null;
	    $nextEpisodeKey     = ($currentEpisodeKey < sizeof($data['episodeList']) - 1) ? $currentEpisodeKey + 1 : null;
	?>

	<article>
		<select id="episodeListDropDown">
			<?php foreach($data['episodeList'] as $episode): ?>
			<option value="<?= $episode['id'] ?>" <?= $episode['id'] === $data['episode']['id'] ? "selected" : "" ?>><?= $episode['title'] ?></option>
			<?php endforeach; ?>
		</select>

		<h2><?= $data['episode']['title'] ?></h2>
		<p>Publié le <?= $data['episode']['publication_date'] ?></p>
		<?= $data['episode']['content'] ?>
		<nav id="episodeControls">
			<ul>
				<?php if (!is_null($previousEpisodeKey)): ?>
				<li>
					<a href="index.php?controller=episode&action=show&param=<?= $data['episodeList'][$previousEpisodeKey]['id'] ?>">Episode précédent</a>
				</li>
				<?php endif; ?>
				<?php if (!is_null($nextEpisodeKey)): ?>
				<li>
					<a href="index.php?controller=episode&action=show&param=<?= $data['episodeList'][$nextEpisodeKey]['id'] ?>">Episode suivant</a>
				</li>
				<?php endif; ?>
			</ul>
		</nav>
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