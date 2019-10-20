<?php declare(strict_types=1); ?>

<h2>Administration des Episodes</h2>

<a href="index.php?controller=admin&action=editEpisode" class="button">Ajouter un épisode</a>

<?php if (empty($data['episodeData'])): ?>
<p>Il n'y a pas d'épisode à administrer.</p>
<?php endif; ?>

<?php if (!empty($data['episodeData'])): ?>
<table>
    <caption>Liste des épisodes</caption>
    
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Publié</th>
            <th>Date de publication</th>
            <th>Action</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Publié</th>
            <th>Date de publication</th>
            <th>Action</th>
        </tr>
    </tfoot>

    <tbody>
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
    </tbody>
</table>
<?php endif; ?>
