<?php

declare(strict_types=1);

namespace App\Checkers\Exception;

use RuntimeException;

final class TooManyPlayers extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Il y a trop de joueurs pour ce jeu. Deux joueurs maximum.');
    }
}