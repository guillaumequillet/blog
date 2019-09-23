<?php
require_once('Model.php');

class EpisodeModel extends Model 
{

	
	// front and back-end methods
	public function getEpisodeTitles() {
		$res = $this->getPDO()->query('SELECT id, title FROM episodes');
		return $res->fetchAll();
	}

	public function getEpisode($id) {
		$res = $this->getPDO()->query('SELECT * FROM episodes WHERE id=' . $id);
		return $res->fetch();
	}
}
