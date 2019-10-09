<?php declare(strict_types=1); ?>

<?php foreach ($data['episodeExcerptsList'] as $episode): ?>
<div>
	<h3><?= $episode['title'] ?></h3>
	<p>
		<?= $episode['contentExcerpt'] ?>...<a href="index.php?controller=episode&action=show&param=<?= $episode['id'] ?>">[voir la suite]</a>
	</p>
</div>
<?php endforeach; ?>