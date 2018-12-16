<?php

declare(strict_types=1);

use App\Checkers\Factory\Game as CheckersFactory;
use App\Connect4\Factory\Game as Connect4Factory;
use Support\Factory;
use Support\Renderer;
use App\Checkers\Service\Game as Checkers;
use App\Connect4\Service\Game as Connect4;
use Support\Service\PseudoRandomValue;
use Support\Service\RandomValue;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'games' => [
        'checkers' => Checkers::class,
        'connect4' => Connect4::class,
    ],
    'service_manager' => [
        'factories' => [
            Renderer\Output::class => Factory\Renderer\Output::class,
            Connect4::class => Connect4Factory::class,
            Checkers::class => CheckersFactory::class,
            // InvokableFactory can be used when the service does not need any constructor argument
            PseudoRandomValue::class => InvokableFactory::class,
        ],
        'aliases' => [
            RandomValue::class => PseudoRandomValue::class,
        ],
    ]
];