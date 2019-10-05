<?php

require __DIR__ . '/../vendor/autoload.php';

use DI\Container;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

date_default_timezone_set('America/Montevideo');

// Load dot env library
$envPath = __DIR__ . '/../';
if (is_file($envPath.'.env')) {
    $dotenv = Dotenv::create($envPath);
    $dotenv->load();
}

// Instantiate PHP-DI Container
$container = new Container();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();