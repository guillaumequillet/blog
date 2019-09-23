<?php
require_once('Model.php');

class CommentModel extends Model 
{
	// Front-End methods
	public function addComment($author, $content, $episode_id) {
		$req = $this->getPDO()->prepare('INSERT INTO comments(author, content, episode_id, status) VALUES(:author, :content, :episode_id, :status)');
		$req->execute(array(
			'author'  	 => $author,
			'content' 	 => $content,
			'episode_id' => $episode_id,
			'status' 	 => 'UNCHECKED'
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	public function getEpisodeComments($episode_id) {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE episode_id=' . $episode_id);
		return $res;
	}

	// for status "UNCHECKED" only
	public function reportComment($id) {
		$this->getPDO()->query('UPDATE comments SET status="REPORTED" WHERE id=' . $id);
	}


	// Back-End methods
	public function getAllComments() {
		$res = $this->getPDO()->query('SELECT * FROM comments');
		return $res;		
	}

	public function getReportedComments() {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE status="REPORTED"');
		return $res;
	}

	// for whatever status between "REPORTED" and "UNCHECKED"
	public function deleteComment($id) {
		$this->getPDO()->query('DELETE FROM comments WHERE id=' . $id);
	}

	// for status "REPORTED"
	public function approveComment($id) {
		$this->getPDO()->query('UPDATE comments SET status="APPROVED" WHERE id=' . $id);
	}
}