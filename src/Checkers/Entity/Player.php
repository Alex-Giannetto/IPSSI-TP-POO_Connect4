<?php

declare(strict_types=1);

namespace App\Checkers\Entity;

final class Player implements Participant
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}