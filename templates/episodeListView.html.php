<?php declare(strict_types=1); ?>
<h2>Liste des épisodes</h2>

<?php foreach ($data['episodeExcerptsList'] as $episode): ?>
<div>
	<h3><?= $episode['title'] ?></h3>
	<p>
		<?= html_entity_decode($episode['contentExcerpt']) ?>...<a href="index.php?controller=episode&action=show&param=<?= $episode['id'] ?>">[voir la suite]</a>
	</p>
</div>
<hr>
<?php endforeach; ?>

<div>
	<h4>Pages</h4>
	<p>
		<?php if (isset($data['previousPage'])): ?>
		<a href="index.php?controller=episode&action=showList&param=<?= $data['previousPage'] ?>"> <?= $data['previousPage'] ?></a>
		<?php endif; ?>

		<?php echo $data['currentPage'] . " "; ?>

		<?php if (isset($data['nextPage'])): ?>
		<a href="index.php?controller=episode&action=showList&param=<?= $data['nextPage'] ?>"> <?= $data['nextPage'] ?></a>
		<?php endif; ?>
	</p>
</div>