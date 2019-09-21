<?php
require_once('model/EpisodeModel.php');

$model = new EpisodeModel();
$data = $model->getEpisodeTitles();
print_r($data);