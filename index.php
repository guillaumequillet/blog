<?php

// this will impose to use specific types and typehints
/*

public function name(int $param1, string $param2): string {} // we specify return type after the ":"

*/

declare(strict_types=1);

// this file is the ROOTER
// it will only create ONE single Controller and call a SINGLE ACTION on it
/*
controller=episode&action=show&param=2
controller=episode&action=add
controller=episode&action=delete&param=3
controller=episode&action=edit&param=4

controller=comment&action=add&param=2
controller=comment&action=delete&param=3
controller=comment&action=report&param=4
*/