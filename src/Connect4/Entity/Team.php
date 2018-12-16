<?php
declare(strict_types=1);

namespace App\Connect4\Entity;


class Team
{
    private const RED = 'red';
    private const YELLOW = 'yellow';

    protected $color;
    protected $participants;

    public $player = 0; // ce sera le premier joueur de l'équipe qui commencera a jouer

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @param mixed $participants
     */
    public function setParticipants($participants): void
    {
        $this->participants = $participants;
    }


    /**
     * @param array $participants
     * @return Team
     */
    public static function createRedTeam(array $participants): Team
    {
        return new self(self::RED, $participants);
    }

    /**
     * @param array $participants
     * @return Team
     */
    public static function createYellowTeam(array $participants): Team
    {
        return new self(self::YELLOW, $participants);
    }

    /**
     * Team constructor.
     * @param string $color
     * @param array $participants
     */
    public function __construct(string $color, array $participants)
    {
        $this->color = $color;
        $this->participants = $participants;
    }


    public function __toString()
    {
        return (string)$this->color;
    }



}