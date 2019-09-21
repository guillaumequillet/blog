<?php
require_once('Model.php');

class CommentModel extends Model 
{
	public function getComments($episode_id) {
		$res = $this->getPDO()->query('SELECT * FROM comments WHERE episode_id=' . $episode_id);
		return $res->fetchAll();
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