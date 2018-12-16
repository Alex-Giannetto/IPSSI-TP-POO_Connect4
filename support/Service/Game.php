<?php

declare(strict_types=1);

namespace Support\Service;

use Support\Renderer\Output;

interface Game
{
    public function run(): Output;
}