<?php

declare(strict_types=1);

namespace Support\Service;

interface RandomValue
{
    public function generateRandomInt(int $min, int $max): int;
}