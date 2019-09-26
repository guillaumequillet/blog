<?php
declare(strict_types=1);

$pageTitle = "Episode" . $data['episode']['id'];
$pageContent = $data['episode']['content'];

ob_start();
echo "<ul>";
foreach($data['episodeList'] as $episode) {
	echo "<li><a href=index.php?controller=episode&action=show&param=" . $episode['id'] . ">" . $episode['title'] . "</a></li>";
}
echo "</ul>";
$episodeListMenu = ob_get_clean();

$commentContent = "commentaires à venir";