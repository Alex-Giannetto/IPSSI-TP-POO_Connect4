<?php
declare(strict_types=1);

namespace App\Connect4\Entity;


use Support\Renderer\Output;

final class Board
{
    private $board;
    private $winner = null;

    /**
     * @return null
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * On construit la grille du puissance 4
     */
    public function __construct()
    {
        for ($i = 0; $i < 6; $i++) {
            $this->board[] = [null, null, null, null, null, null, null];
        }
    }

    /**
     * @return mixed
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    public function __toString(): string
    {
        $return = "";
        foreach ($this->board as $indexL => $ligne) {
            foreach ($ligne as $indexC => $colone) {
                $return .= '|';
                $return .= str_pad($colone ?? '', 10, " ", STR_PAD_BOTH);
                $return .= ($indexC == count($ligne) - 1) ? '|' : '';
            }
            $return .= PHP_EOL;
        }
        return $return;
    }

    /**
     * Retourne un tableau avec les index des colonnes qui ne sont pas encore pleine
     * @return array
     */
    public function possibleColumn(): array
    {
        $return = [];

        foreach ($this->board[0] as $index => $column) {
            if ($column === null) {
                $return[] = $index;
            }
        }

        return $return;
    }

    /**
     * Permet de mettre une piece dans la colonne voulu
     * @param int $column
     * @param Output $output
     * @param Team $team
     */
    public function play(int $column, Output &$output, Team $team): void
    {
        $line = 0;
        for ($i = 5; $i >= 0; $i--) {
            if ($this->board[$i][$column] === null) {
                $this->board[$i][$column] = $team->getColor();
                $line = $i;
                break;
            }
        }

        $output->writeLine("Joueur " . $team->getParticipants()[$team->player] ." (" . $team->getColor() . ") joue dans la case {$line}.{$column}");

        $this->checkWinner($column, $line, $team);
    }

    /**
     * Vérifie si 4 piece sont aligné dans la même colonne
     * @param int $column
     * @return bool
     */
    private function columnIsWin(int $column): bool
    {
        $currentColor = '';
        $currentScore = 0;
        for ($i = 5; $i > 0; $i--) {
            if ($this->board[$i][$column] !== null) {
                if ($this->board[$i][$column] === $currentColor) {
                    $currentScore++;
                } else {
                    if ($this->board[$i][$column] !== $currentColor) {
                        $currentColor = $this->board[$i][$column];
                        $currentScore = 1;
                    }
                }
            }
        }
        return ($currentScore >= 4);
    }

    /**
     * Verifie si 4 pieces sont aligné dans une même ligne
     * @param int $line
     * @return bool
     */
    private function rowIsWin(int $line): bool
    {
        $currentColor = "";
        $currentScore = 0;
        foreach ($this->board[$line] as $column) {
            if ($column === $currentColor && $column !== null) {
                $currentScore++;
            } else {
                $currentScore = 1;
                $currentColor = $column;
            }
            if ($currentScore >= 4) {
                break;
            }
        }
        return ($currentScore >= 4);
    }

    /**
     * Appel les fonctions columnIsWin() et rowIsWin() pour passer la couelur de l'équipe gagnante dans
     * la variable local $winner
     * @param int $column
     * @param int $line
     * @param Team $team
     */
    public function checkWinner(int $column, int $line, Team $team): void
    {
        if ($this->columnIsWin($column) || $this->rowIsWin($line)) {
            $this->winner = $team->getColor();
        } else {
            $this->winner = null;
        }
    }
}