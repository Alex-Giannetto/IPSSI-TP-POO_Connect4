<?php

declare(strict_types=1);

namespace App\Checkers\Entity;

final class Piece
{
    private const WHITE = 'blanc';
    private const BLACK = 'noir';
    private $color;

    private function __construct(string $color)
    {
        $this->color = $color;
    }

    public function __toString(): string
    {
        return $this->color;
    }

    public static function createWhite(): Piece
    {
        return new self(self::WHITE);
    }

    public static function createBlack(): Piece
    {
        return new self(self::BLACK);
    }
}