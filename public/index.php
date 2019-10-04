<?php

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
 
use DI\Container;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Solcre\ptptalks\Entity\Talk;
use Solcre\ptptalks\Helper\TalkLoader;


date_default_timezone_set('America/Montevideo');

// Load dot env library
$dotenv = Dotenv::create(__DIR__ . '/../');
$dotenv->load();

// Instantiate PHP-DI Container
$container = new Container();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/talks', function ($request, $response, $args) {
    $talksArr = [];
    
    $talks = TalkLoader::load(__DIR__ . '/../data/');
    foreach ($talks as $talk) {
        $talksArr[] = $talk->toArray();
    }

    $response->write(json_encode($talksArr));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();