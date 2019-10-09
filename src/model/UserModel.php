<?php
declare(strict_types=1);

/*
	default username : admin
	default password : password
*/

namespace App\Model;

class UserModel extends Model
{
	public function validateLogin(string $username, string $password): bool {
		$req = $this->getPDO()->prepare('SELECT COUNT(*) FROM users WHERE name=:username AND password=:password');
		$req->execute(['username' => $username, 'password' => md5($password)]);
		return (bool) $req->fetch()[0];
	}
}
