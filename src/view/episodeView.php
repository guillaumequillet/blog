<?php
declare(strict_types=1);

$pageTitle = "Episode" . $data['episode']['id'];
$pageContent = $data['episode']['content'];

// Episode List section
ob_start();
?>
<ul>
<?php foreach($data['episodeList'] as $episode): ?>
	<li><a href=index.php?controller=episode&action=show&param=<?= $episode['id'] ?>><?= $episode['title'] ?></a></li>
<?php endforeach; ?>
</ul>
<?php
$episodeListMenu = ob_get_clean();

// Comments section
ob_start();
?>
<?php if (!empty($data['comments'])): ?>
	<?php foreach($data['comments'] as $comment): ?>
		<p>Auteur : <?= $comment['author'] ?> Message : <?= $comment['content'] ?></p>
	<?php endforeach; ?>
<?php endif; 
$commentContent = ob_get_clean();