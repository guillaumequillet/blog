<?php
declare(strict_types=1);

namespace App\Model;

class CommentModel extends Model
{
	// Front-End methods
	public function addComment(string $author, string $content, int $episodeId) : void {
		$req = $this->getPDO()->prepare('INSERT INTO comments(author, content, episode_id, status) VALUES(:author, :content, :episodeId, :status)');
		$req->execute([
			'author'  	 => $author,
			'content' 	 => $content,
			'episodeId'  => $episodeId,
			'status' 	 => 'UNCHECKED'
		]);
	}

	public function findEpisodeComments(int $episodeId): ?array {
		$req = $this->getPDO()->prepare('SELECT * FROM comments WHERE episode_id=:episodeId ORDER BY publication_date DESC');
		$res = $req->execute(['episodeId' => $episodeId]);
		return ($res === false) ? null : $req->fetchAll();
	}

	public function findEpisodeIdWithCommentId(int $commentId): ?string {
		$req = $this->getPDO()->prepare('SELECT episode_id FROM comments WHERE id=:commentId');
		$res = $req->execute(['commentId' => $commentId]);
		return ($res === false) ? null : $req->fetch()[0];
	}

	// for status "UNCHECKED" only
	public function reportComment(int $id) : void {
		$req = $this->getPDO()->prepare('UPDATE comments SET status="REPORTED" WHERE id=:id');
		$req->execute(['id' => $id]);
	}


	// Back-End methods
	public function findAllComments(): ?array {
		$req = $this->getPDO()->query('SELECT * FROM comments');
		return ($req === false) ? null : $req->fetchAll();		
	}

	public function findReportedComments(): ?array {
		$req = $this->getPDO()->query('SELECT * FROM comments WHERE status="REPORTED"');
		return ($req === false) ? null : $req->fetchAll();
	}

	// for whatever status between "REPORTED" and "UNCHECKED"
	public function deleteComment(int $id) : void {
		$req = $this->getPDO()->prepare('DELETE FROM comments WHERE id=:id');
		$req->execute(['id' => $id]);
	}

	// for status "REPORTED"
	public function approveComment(int $id) : void {
		$req = $this->getPDO()->prepare('UPDATE comments SET status="APPROVED" WHERE id=:id');
		$req->execute(['id' => $id]);
	}
}