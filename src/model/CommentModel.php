<?php
declare(strict_types=1);
require_once('Model.php');

class CommentModel extends Model 
{
	// Front-End methods
	public function addComment(string $author, string $content, int $episodeId) : void {
		$req = $this->getPDO()->prepare('INSERT INTO comments(author, content, episode_id, status) VALUES(:author, :content, :episodeId, :status)');
		$req->execute(array(
			'author'  	 => $author,
			'content' 	 => $content,
			'episodeId' => $episodeId,
			'status' 	 => 'UNCHECKED'
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function findComment(int $id): ?array {
		$req = $this->getPDO()->query('SELECT * FROM comments WHERE id='. $id);
		return ($req === false) ? null : $req->fetch();
	}

	public function findEpisodeComments(int $episodeId): ?array {
		$req = $this->getPDO()->query('SELECT * FROM comments WHERE episode_id=' . $episodeId . ' ORDER BY publication_date DESC');
		return ($req === false) ? null : $req->fetchAll();
	}

	// for status "UNCHECKED" only
	public function reportComment(int $id) : void {
		$this->getPDO()->query('UPDATE comments SET status="REPORTED" WHERE id=' . $id);
	}


	// Back-End methods
	public function findAllComments(): ?array {
		$res = $this->getPDO()->query('SELECT * FROM comments');
		return $res->fetchAll();		
	}

	public function findReportedComments(): ?array {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE status="REPORTED"');
		return $res->fetchAll();
	}

	// for whatever status between "REPORTED" and "UNCHECKED"
	public function deleteComment(int $id) : void {
		$this->getPDO()->query('DELETE FROM comments WHERE id=' . $id);
	}

	// for status "REPORTED"
	public function approveComment(int $id) : void {
		$this->getPDO()->query('UPDATE comments SET status="APPROVED" WHERE id=' . $id);
	}
}