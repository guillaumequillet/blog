<?php
declare(strict_types=1);
require_once('Model.php');

class EpisodeModel extends Model 
{
	// front and back-end methods
	public function findEpisodeTitles(): ?array {
		$req = $this->getPDO()->query('SELECT id, title FROM episodes');
		return ($req === false) ? null : $req->fetchAll();
	}

	public function episodeExists(int $id) : bool {
		$req = $this->getPDO()->prepare('SELECT COUNT(*) FROM episodes WHERE id=:id');
		$res = $req->execute(['id' => $id]);
		return ($res === false) ? false : (bool)$req->fetch();
	}

	public function findEpisode(int $id): ?array {
		$req = $this->getPDO()->prepare('SELECT * FROM episodes WHERE id=:id');
		$res = $req->execute(['id' => $id]);
		return ($res === false) ? null : $req->fetch();
	}

	// back-end methods
	public function addEpisode(string $title, string $content, int $published): void {
		$req = $this->getPDO()->prepare('INSERT INTO episodes(title, content, published) VALUES(:title, :content, :published)');
		$req->execute([
			'title'     => $title,
			'content'   => $content,
			'published' => $published
		]);
	}

	public function editEpisode(int $id, string $title, string $content, int $published): void {
		$req = $this->getPDO()->prepare('UPDATE episodes SET title=:title, content=:content, published=:published WHERE id=:id');
		$req->execute([
			'id'		=> $id,
			'title'     => $title,
			'content'   => $content,
			'published' => $published
		]);
	}

	public function deleteEpisode(int $id): void {
		$req = $this->getPDO()->prepare('DELETE FROM episodes WHERE id=:id');
		$req->execute(['id' => $id]);
	}
}
