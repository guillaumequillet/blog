<?php declare(strict_types=1); ?>

<a href="index.php?controller=admin&action=episodes" class="button">Retour à la liste des épisodes</a>

<h2>Gestion de l'épisode</h2>

<?php 
    $episodeId = isset($data['episode']) ? $data['episode']['id'] : '';
    $episodeTitle = isset($data['episode']) ? $data['episode']['title'] : '';
    $episodeContent = isset($data['episode']) ? $data['episode']['content'] : '';
    $published = isset($data['episode']) ? $data['episode']['published'] : '';
?>

 <form method="POST" action="index.php?controller=admin&action=updateEpisode" id="episodeForm">
    <input type="hidden" id="episodeId" name="episodeId" value="<?= $episodeId ?>">
    <label for="episodeTitle">Titre de l'épisode</label>
    <input type="text" id="episodeTitle" name="episodeTitle" value="<?= $episodeTitle ?>">
    <label for="episodeContent">Contenu de l'épisode</label>
    <textarea id="episodeContent" name="episodeContent"><?= $episodeContent ?></textarea>
    <label for="published">Episode publié ?</label>
    <input type="checkbox" id="published" name="published" <?php echo $published ? 'checked' : '' ?>>
    <input type="submit" value="Enregistrer">
    <input type="hidden" name="token" id="token" value="<?= $data['token'] ?>">
 </form>
