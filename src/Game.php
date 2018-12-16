<?php

declare(strict_types=1);

namespace App;

interface Game extends \Support\Service\Game
{
    public static function playersFactory(int $numberOfPlayers): array;
}