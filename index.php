#!/usr/bin/php
<?php
$time_start = microtime(true);

use App\Application;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    throw new LogicException('The autoload file does not exist, please use composer install');
}
require __DIR__.'/vendor/autoload.php';


echo (new Application($argv, require __DIR__.'/config/di.global.php'))->run();

$time_end = microtime(true);
$execution_time = ($time_end - $time_start);

echo PHP_EOL;
echo PHP_EOL;
echo 'Total Execution Time: '.$execution_time.'sec';
echo PHP_EOL;

