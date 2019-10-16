<?php
declare(strict_types=1);

namespace App\Model;

class UserModel extends Model
{
    public function validateLogin(string $username, string $password): bool {
        $req = $this->getPDO()->prepare('SELECT password FROM users WHERE binary name=:username');
        $res = $req->execute(['username' => $username]);

        if ($res) {
            $hashed_pwd = $req->fetch()[0];
            return is_null($hashed_pwd) ? false : password_verify($password, $hashed_pwd);
        }
        return false;
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
