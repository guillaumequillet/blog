<?php
declare(strict_types=1);
require_once('Model.php');

class CommentModel extends Model 
{
	// Front-End methods
	public function addComment(string $author, string $content, int $episode_id): bool {
		$req = $this->getPDO()->prepare('INSERT INTO comments(author, content, episode_id, status) VALUES(:author, :content, :episode_id, :status)');
		$req->execute(array(
			'author'  	 => $author,
			'content' 	 => $content,
			'episode_id' => $episode_id,
			'status' 	 => 'UNCHECKED'
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function getEpisodeComments(int $episode_id): array {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE episode_id=' . $episode_id . ' ORDER BY publication_date DESC');
		return $res->fetchAll();
	}

	// for status "UNCHECKED" only
	public function reportComment(int $id): bool {
		$this->getPDO()->query('UPDATE comments SET status="REPORTED" WHERE id=' . $id);
	}


	// Back-End methods
	public function getAllComments(): array {
		$res = $this->getPDO()->query('SELECT * FROM comments');
		return $res->fetchAll();		
	}

	public function getReportedComments(): array {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE status="REPORTED"');
		return $res->fetchAll();
	}

	// for whatever status between "REPORTED" and "UNCHECKED"
	public function deleteComment(int $id): bool {
		$this->getPDO()->query('DELETE FROM comments WHERE id=' . $id);
	}

	// for status "REPORTED"
	public function approveComment(int $id): bool {
		$this->getPDO()->query('UPDATE comments SET status="APPROVED" WHERE id=' . $id);
	}
}