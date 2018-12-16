<?php

declare(strict_types=1);

namespace App\Connect4\Service;

use App\Connect4\Entity\Board;
use App\Connect4\Entity\Participant;
use App\Connect4\Entity\Player;
use App\Connect4\Entity\Team;
use App\Game as GameInterface;
use RuntimeException;
use Support\Renderer\Output;
use Support\Service\RandomValue;

final class Game implements GameInterface
{
    private $output;
    private $randomValueGenerator;
    private $participants;

    private $redTeam;
    private $yellowTeam;
    private $board;

    public function __construct(Output $output, RandomValue $randomValueGenerator, Participant ...$participants)
    {
        $this->validateEnoughParticipants($participants);

        $this->output = $output;
        $this->randomValueGenerator = $randomValueGenerator;
        $this->participants = $participants;
        $this->board = new Board();
    }

    private function validateEvenPlayerNumber(array &$participants): void
    {
        if (count($participants) % 2 === 1) {
            $participants = array_slice($participants, 0, count($participants) - 1);
        }
    }

    private function validateEnoughParticipants(array $participants): void
    {
        if (count($participants) < 2) {
            throw new class extends RuntimeException
            {
                public function __construct()
                {
                    parent::__construct('Il faut plus de joueurs pour ce jeu. Deux joueurs minimum.');
                }
            };
        }
    }

    public static function playersFactory(int $numberOfPlayers): array
    {
        $players = [];

        for ($playerNumber = 0; $playerNumber < $numberOfPlayers; ++$playerNumber) {
            $players[] = new Player($playerNumber + 1);
        }

        return $players;
    }

    private function createTeam(&$participants, &$redTeam, &$yellowTeam)
    {
        shuffle($participants); // on mélange le tableau

        $redTeam = Team::createRedTeam(array_slice($participants, 0, count($participants) / 2));
        $yellowTeam = Team::createYellowTeam(array_slice($participants, count($participants) / 2,
            count($participants) / 2));
    }

    public function run(): Output
    {
        $this->output->writeLine(sprintf(
                'Initialisation du jeu avec %d participants.',
                count($this->participants))
        );

        $this->output->writeLine('Exclusion d\'un participant si nombre impair.');
        $this->validateEvenPlayerNumber($this->participants);

        $this->output->writeLine('Choix aléatoire des équipes (rouge et jaune).');
        $this->createTeam($this->participants, $this->redTeam, $this->yellowTeam);

        $this->output->writeLine('Initialisation de la grille en 7 colonnes et 6 lignes.');

        $this->play($this->board, $this->redTeam, $this->yellowTeam);
        $this->output->writeLine((string)PHP_EOL .  $this->board);

        return $this->output;
    }

    private function play(Board &$board, Team ...$teams)
    {
        $this->output->writeLine('Choix aléatoire de l\'identifiant du premier participant.');
        shuffle($teams); // on mélange pour qu'une équipe au hasard commence

        $teamNumber = 0;

        while (!(empty($board->possibleColumn())) && $board->getWinner() === null) {

            $column = $board->possibleColumn()[array_rand($board->possibleColumn(), 1)];
            $team = $teams[$teamNumber];

            $board->play($column, $this->output, $team);
            $teamNumber = ($teamNumber === count($teams) - 1) ? 0 : $teamNumber + 1;
            if($team->player < count($team->getParticipants()) -1){
                $team->player++;
            } else {
                $team->player = 0;
            }
        }

        if ($board->getWinner()) {
            $this->output->writeLine("Partie terminée, {$board->getWinner()} gagne.");
        } else {
            $this->output->writeLine("Match null");
        }
    }


}