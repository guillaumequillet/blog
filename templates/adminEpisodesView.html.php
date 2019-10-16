<?php declare(strict_types=1); ?>

<h2>Gestion des épisodes</h2>

<a href="index.php?controller=admin&action=editEpisode">Ajouter un épisode</a>
<hr>
<?php foreach($data['episodeData'] as $episode): ?>
<div>
    <h3><?= $episode['title'] ?></h3>
    <p>
        <a href="index.php?controller=admin&action=editEpisode&param=<?= $episode['id'] ?>">Editer</a>
        <a href="index.php?controller=admin&action=previewEpisode&param=<?= $episode['id'] ?>">Aperçu</a>
        <a href="index.php?controller=admin&action=deleteEpisode&param=<?= $episode['id'] ?>" onclick="return confirm('Etes-vous sûr(e) de vouloir supprimer cet épisode ?');">Supprimer</a>
    </p>
</div>
<hr>
<?php endforeach; ?>