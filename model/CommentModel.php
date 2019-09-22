<?php
require_once('Model.php');

class CommentModel extends Model 
{
	public function getComments($episode_id) {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE episode_id=' . $episode_id);
		return $res;
	}

	public function addComment($author, $content, $episode_id) {
		$req = $this->getPDO()->prepare('INSERT INTO comments(author, content, episode_id, status) VALUES(:author, :content, :episode_id, :status)');
		$req->execute(array(
			'author'  	 => $author,
			'content' 	 => $content,
			'episode_id' => $episode_id,
			'status' 	 => 'UNCHECKED'
		)) or die(print_r($this->getPDO()->errorInfo()));
	}

	// default STATUS : "UNCHECKED"
	public function deleteComment($id) {
		$this->getPDO()->query('DELETE FROM comments WHERE id=' . $id);
	}

	public function reportComment($id) {
		$this->getPDO()->query('UPDATE comments SET status="REPORTED" WHERE id=' . $id);
	}

	public function approveComment($id) {
		$this->getPDO()->query('UPDATE comments SET status="APPROVED" WHERE id=' . $id);
	}
}