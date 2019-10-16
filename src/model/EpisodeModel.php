<?php
declare(strict_types=1);

namespace App\Model;

class EpisodeModel extends Model
{
	// front-end methods
	public function findPublishedEpisodeTitles(): ?array {
		$req = $this->getPDO()->query('SELECT id, title FROM episodes WHERE published=1');
		return ($req === false) ? null : $req->fetchAll();
	}

	public function episodeExists(int $id): bool {
		$req = $this->getPDO()->prepare('SELECT COUNT(*) FROM episodes WHERE id=:id AND published=1');
		$res = $req->execute(['id' => $id]);
		return ($res === false) ? false : (bool)$req->fetch();
	}

	public function findEpisodeCount(): int {
		$req = $this->getPDO()->query('SELECT COUNT(*) FROM episodes WHERE published=1');
		return (int)$req->fetch()[0];
	}

	public function findPublishedEpisode(int $id): ?array {
		$req = $this->getPDO()->prepare('SELECT * FROM episodes WHERE id=:id AND published=1');
		$req->execute(['id' => $id]);
		$res = $req->fetch();
		return ($res === false) ? null : $res;
	}

	public function findEpisodeExcerpts(int $page, int $episodesPerPage): ?array {
		$req = $this->getPDO()->prepare('SELECT id, title, content AS contentExcerpt FROM episodes WHERE published=1 LIMIT :qty OFFSET :start');
		$req->bindValue(':qty', $episodesPerPage, \PDO::PARAM_INT);
		$req->bindValue(':start', $episodesPerPage * ($page - 1), \PDO::PARAM_INT);
		$res = $req->execute();
		return ($res === false) ? null : $req->fetchAll();
	}

	// back-end methods
	public function findEpisode(int $id): ?array {
		$req = $this->getPDO()->prepare('SELECT * FROM episodes WHERE id=:id');
		$req->execute(['id' => $id]);
		$res = $req->fetch();
		return ($res === false) ? null : $res;
	}

	public function findEpisodeTitles(): ?array {
		$req = $this->getPDO()->query('SELECT id, title FROM episodes');
		return ($req === false) ? null : $req->fetchAll();
	}

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
