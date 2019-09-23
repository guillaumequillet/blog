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

	// back-end methods
	public function addEpisode($title, $content, $published) {
		$req = $this->getPDO()->prepare('INSERT INTO episodes(title, content, published) VALUES(:title, :content, :published)');
		$req->execute(array(
			'title'     => $title,
			'content'   => $content,
			'published' => $published
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function editEpisode($episode_id, $title, $content, $published) {
		$req = $this->getPDO()->prepare('UPDATE episodes SET title=:title, content=:content, published=:published WHERE id=' . $episode_id);
		$req->execute(array(
			'title'     => $title,
			'content'   => $content,
			'published' => $published
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function deleteEpisode($episode_id) {
		$this->getPDO()->query('DELETE FROM episodes WHERE id=' . $episode_id);
	}
}
