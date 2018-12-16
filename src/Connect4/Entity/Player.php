<?php

declare(strict_types=1);

namespace App\Connect4\Entity;

final class Player implements Participant
{
    private $id;
    private $team;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string)$this->id();
    }

    /**
     * @return mixed
     */
    public function getTeam() : Team
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam(Team $team): void
    {
        $this->team = $team;
    }


}