<?php declare(strict_types=1);

$statusLabels = [
    'REPORTED'  => 'Signalé',
    'APPROVED'  => 'Approuvé',
    'UNCHECKED' => 'Non vérifié'
]
?>

<?php if ($data['param'] === 0): ?>
<h2>Gestion des commentaires</h2>
<?php endif; ?>

<?php if ($data['param'] === 1): ?>
<h2>Gestion des commentaires signalés</h2>
<?php endif; ?>

<?php if (empty($data['comments'])): ?>
<p>Il n'y a pas de commentaire à modérer.</p>
<?php endif; ?>

<?php foreach ($data['comments'] as $comment): ?>
<div class="comment">
    <p>Auteur : <?= $comment['author'] ?> posté le <?= $comment['publication_date'] ?></p>
    <p><?= $comment['content'] ?></p>
    <p>
        Statut : <?= $statusLabels[$comment['status']] ?>

        <?php switch ($comment['status']) {
            case 'REPORTED':
            case 'UNCHECKED':
                if ($data['param'] === 0) {
                    echo "<a href='index.php?controller=admin&action=deleteComment&param=" . $comment['id'] . "'>Effacer</a>";
                    echo " ";
                    echo "<a href='index.php?controller=admin&action=approveComment&param=" . $comment['id'] . "'>Approuver</a>";               
                }
                if ($data['param'] === 1) {
                    echo "<a href='index.php?controller=admin&action=deleteReportedComment&param=" . $comment['id'] . "'>Effacer</a>";
                    echo " ";
                    echo "<a href='index.php?controller=admin&action=approveReportedComment&param=" . $comment['id'] . "'>Approuver</a>";       
                }
                break;
            case 'APPROVED':
                if ($data['param'] === 0) {
                    echo "<a href='index.php?controller=admin&action=deleteComment&param=" . $comment['id'] . "'>Effacer</a>";          
                }
                if ($data['param'] === 1) {
                    echo "<a href='index.php?controller=admin&action=deleteReportedComment&param=" . $comment['id'] . "'>Effacer</a>";          
                }
                break;
        }
        ?>
    </p>
</div>
<?php endforeach; ?>