<?php

declare(strict_types=1);

namespace Support;

use Psr\Container\ContainerInterface;
use Support\Exception\GameDoesNotExist;
use Support\Service\ConnectFourGame;
use Support\Service\Game;
use Zend\ServiceManager\ServiceManager;

final class Application
{
    private $games = [
        'connect4' => ConnectFourGame::class,
    ];

    /**
     * @var Game
     */
    private $selectedGame;
    private $container;

    public function __construct(array $argv, array $config)
    {
        $this->games = $this->initGames($config);
        $this->container = $this->initContainer($config);

        if (count($argv) < 2) {
            throw new \RuntimeException('Please select a game ('.implode(', ', array_keys($this->games)));
        }

        if (!isset($this->games[$argv[1]])) {
            throw new GameDoesNotExist($argv[1], $this->games);
        }

        $this->selectedGame = $this->container->get($this->games[$argv[1]] ?? array_values($this->games)[0]);
    }

    public function run(): string
    {
        return $this->selectedGame->run()->getAndFlush();
    }

    private function initGames(array $config): array
    {
        if (!isset($config['games']) || !is_array($config['games']) || !count($config['games']) > 0) {
            return [];
        }

        return $config['games'];
    }

    private function initContainer(array $config): ContainerInterface
    {
        $container = new ServiceManager($config['service_manager'] ?? []);
        $container->setService('participants', []);

        return $container;
    }
}