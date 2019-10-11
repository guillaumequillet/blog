<?php declare(strict_types=1); ?>

<nav>
	<ul>
		<li><a href="index.php?controller=admin&action=comments&param=1">Modérer les commentaires signalés</a></li>
		<li><a href="index.php?controller=admin&action=comments&param=0">Modérer tous les commentaires</a></li>
	</ul>
</nav>

<?php if ($data['param'] === 0): ?>
<h2>Gestion des commentaires</h2>
<?php endif; ?>

<?php if ($data['param'] === 1): ?>
<h2>Gestion des commentaires signalés</h2>
<?php endif; ?>

<?php foreach ($data['comments'] as $comment): ?>
<div class="comment">
	<p>Auteur : <?= $comment['author'] ?> posté le <?= $comment['publication_date'] ?></p>
	<p><?= $comment['content'] ?></p>
	<p>
		Statut : <?= $comment['status'] ?>
		<?php switch ($comment['status']) {
			case 'REPORTED':
			case 'UNCHECKED':
				echo "<a href='index.php?controller=admin&action=deleteComment&param=" . $comment['id'] . "'>Effacer</a>";
				echo " ";
				echo "<a href='index.php?controller=admin&action=approveComment&param=" . $comment['id'] . "'>Approuver</a>";
				break;
			case 'APPROVED':
				echo "<a href='index.php?controller=admin&action=deleteComment&param=" . $comment['id'] . "'>Effacer</a>";			
				break;
		}
		?>
	</p>
</div>
<?php endforeach; ?>