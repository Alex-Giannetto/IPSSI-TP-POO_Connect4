<?php

declare(strict_types=1);

namespace Support\Service;

final class PseudoRandomValue implements RandomValue
{
    public function generateRandomInt(int $min, int $max): int
    {
        return rand($min, $max);
    }
}