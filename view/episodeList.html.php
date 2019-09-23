<nav id="episodeList">
<ul>
<?php foreach($data as $element): ?>
<li><a href="index.php?action=episode&id=<?= $element['id'] ?>"><?= $element['title'] ?></a></li>
<?php endforeach; ?>
</ul>
</nav>