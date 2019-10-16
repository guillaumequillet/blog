<?php
declare(strict_types=1);

namespace App\Model;

class UserModel extends Model
{
    public function validateLogin(string $username, string $password): bool {
        $req = $this->getPDO()->prepare('SELECT password FROM users WHERE name=:username');
        $req->execute(['username' => $username]);
        return password_verify($password, $req->fetch()[0]);
    }

    public function validUsername(string $username): bool {
        $req = $this->getPDO()->query('SELECT name FROM users LIMIT 1');
        return ($req->fetch()[0] === $username);
    }

    public function setUsername(string $username): void {
        $req = $this->getPDO()->prepare('UPDATE users SET name=:username WHERE id=1');
        $req->execute(['username' => $username]);
    }

    public function validPassword(string $password): bool {
        $req = $this->getPDO()->query('SELECT password FROM users LIMIT 1');
        return (password_verify($password, $req->fetch()[0]));
    }

    public function setPassword(string $password): void {
        $req = $this->getPDO()->prepare('UPDATE users SET password=:password WHERE id=1');
        $req->execute(['password' => password_hash($password, PASSWORD_DEFAULT)]);
    }
}
