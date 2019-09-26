<?php
declare(strict_types=1);
require_once('Model.php');

class EpisodeModel extends Model 
{
	// front and back-end methods
	public function getEpisodeTitles(): array {
		$res = $this->getPDO()->query('SELECT id, title FROM episodes');
		return $res->fetchAll();
	}

	public function getEpisode(int $id): ?array {
		$req = $this->getPDO()->query('SELECT * FROM episodes WHERE id=' . $id);
		$res = $req->fetch();
		return (is_bool($res) ? null : $res);
	}

	// back-end methods
	public function addEpisode(string $title, string $content, int $published): bool {
		$req = $this->getPDO()->prepare('INSERT INTO episodes(title, content, published) VALUES(:title, :content, :published)');
		$req->execute(array(
			'title'     => $title,
			'content'   => $content,
			'published' => $published
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function editEpisode(int $episode_id, string $title, string $content, int $published): bool {
		$req = $this->getPDO()->prepare('UPDATE episodes SET title=:title, content=:content, published=:published WHERE id=' . $episode_id);
		$req->execute(array(
			'title'     => $title,
			'content'   => $content,
			'published' => $published
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function deleteEpisode(int $episode_id): bool {
		$this->getPDO()->query('DELETE FROM episodes WHERE id=' . $episode_id);
	}
}
