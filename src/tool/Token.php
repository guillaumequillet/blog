<?php
declare(strict_types=1);

namespace App\Tool;

class Token
{
	public function __construct() {
		$this->superglobalManager = new SuperglobalManager();
        return $this;
	}

    public function generateString(): string 
    {
        $this->superglobalManager->setSessionVariable('token', bin2hex(random_bytes(32)));
        return $this->superglobalManager->findSessionVariable('token');
    }

    public function check(): bool
    {
        $postToken = $this->superglobalManager->findPostVariable('token');
        $sessionToken = $this->superglobalManager->findSessionVariable('token');
        return ($postToken === $sessionToken && !is_null($postToken));
    }	
}
