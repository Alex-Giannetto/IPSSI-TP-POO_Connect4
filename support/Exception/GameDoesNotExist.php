<?php

declare(strict_types=1);

namespace Support\Exception;

use RuntimeException;

final class GameDoesNotExist extends RuntimeException
{
    public function __construct(string $gameName, array $games)
    {
        parent::__construct(sprintf(
            "Le jeu demandé (%s) n'existe pas. Jeux disponibles : %s",
            $gameName,
            implode(', ', array_keys($games))
        ));
    }
}