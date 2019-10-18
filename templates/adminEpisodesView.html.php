<?php declare(strict_types=1); ?>

<h2>Gestion des épisodes</h2>

<a href="index.php?controller=admin&action=editEpisode" class="button">Ajouter un épisode</a>

<table>
    <tr>
        <td>ID</td>
        <td>Titre</td>
        <td>Publié</td>
        <td>Date de publication</td>
        <td>Action</td>
    </tr>

    <?php foreach($data['episodeData'] as $episode): ?>
    <tr>
        <td><?= $episode['id'] ?></td>
        <td><?= $episode['title'] ?></td>
        <td><?= $episode['published'] ? "Oui" : "Non" ?></td>
        <td><?= $episode['publication_date'] ?></td>
        <td>
            <a href="index.php?controller=admin&action=editEpisode&param=<?= $episode['id'] ?>" class="button">Editer</a>
            <a href="index.php?controller=admin&action=previewEpisode&param=<?= $episode['id'] ?>" class="button">Aperçu</a>
            <a href="index.php?controller=admin&action=deleteEpisode&param=<?= $episode['id'] ?>" onclick="return confirm('Etes-vous sûr(e) de vouloir supprimer cet épisode ?');" class="button">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>