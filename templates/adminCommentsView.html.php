<?php declare(strict_types=1);

$statusLabels = [
    'REPORTED' => 'Signalé',
    'APPROVED' => 'Approuvé',
    'UNCHECKED' => 'Non vérifié'
]
?>

<?php if ($data['param'] === 0): ?>
<h2>Gestion des Commentaires</h2>
<?php endif; ?>

<?php if ($data['param'] === 1): ?>
<h2>Gestion des Commentaires Signalés</h2>
<?php endif; ?>

<?php if (empty($data['comments'])): ?>
<p>Il n'y a pas de commentaire à modérer.</p>
<?php endif; ?>

<?php if (!empty($data['comments'])): ?>
<table id="adminCommentTable">
    <caption>Liste des commentaires</caption>

    <thead>
        <tr>
            <th>ID</th>
            <th>Episode ID</th>
            <th>Auteur</th>
            <th>Contenu</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>ID</th>
            <th>Episode ID</th>
            <th>Auteur</th>
            <th>Contenu</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </tfoot>
    
    <tbody>
        <?php foreach ($data['comments'] as $comment): ?>
        <tr>
            <td><?= $comment['id'] ?></td>
            <td><?= $comment['episode_id'] ?></td>
            <td><?= $comment['author'] ?></td>        
            <td><?= $comment['content'] ?></td>        
            <td><?= $statusLabels[$comment['status']] ?></td>
            <td><?= $comment['publication_date'] ?></td>
            <td>
                <?php switch ($comment['status']) {
                    case 'REPORTED':
                    case 'UNCHECKED':
                        if ($data['param'] === 0) {
                            echo "<a href='index.php?controller=admin&action=deleteComment&param=" . $comment['id'] . "' class=\"button\">Effacer</a>";
                            echo " ";
                            echo "<a href='index.php?controller=admin&action=approveComment&param=" . $comment['id'] . "' class=\"button\">Approuver</a>";               
                        }
                        if ($data['param'] === 1) {
                            echo "<a href='index.php?controller=admin&action=deleteReportedComment&param=" . $comment['id'] . "' class=\"button\">Effacer</a>";
                            echo " ";
                            echo "<a href='index.php?controller=admin&action=approveReportedComment&param=" . $comment['id'] . "' class=\"button\">Approuver</a>";       
                        }
                        break;
                    case 'APPROVED':
                        if ($data['param'] === 0) {
                            echo "<a href='index.php?controller=admin&action=deleteComment&param=" . $comment['id'] . "' class=\"button\">Effacer</a>";          
                        }
                        if ($data['param'] === 1) {
                            echo "<a href='index.php?controller=admin&action=deleteReportedComment&param=" . $comment['id'] . "' class=\"button\">Effacer</a>";          
                        }
                        break;
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
