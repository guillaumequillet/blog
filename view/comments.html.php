<h2>Vos commentaires</h2>
<?php while ($comment = $data->fetch()): ?>
	<div class="comment">
		<h6>Posté par <strong><?= $comment['author'] ?></strong> le <?= $comment['publication_date'] ?></h6>
		<p><?= $comment['content'] ?></p>
		<p><?php
		// creates some "report" link if possible
		if ($comment['status'] === 'UNCHECKED') {
			echo 'Signaler le commentaire.';
		} else {
			echo 'Le message a déjà été signalé.';
		}
		?></p>
	</div>
<?php endwhile; ?>