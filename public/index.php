<?php

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
 
use Dotenv\Dotenv;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Slim\Factory\AppFactory;
use Solcre\ptptalks\Helper\TalkLoader;

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

// Add error middleware
$responseFactory = $app->getResponseFactory();
$errorMiddleware = new ErrorMiddleware(
    $app->getCallableResolver(),
    $responseFactory,
    getenv('ENVIRONMENT')=='dev',
    true,
    true
);
$app->add($errorMiddleware);

$app->redirect('/', '/talks', 301);
$app->get('/talks', function ($request, $response, $args) {
    $talksArr = [];
    $talksPath = __DIR__ . getenv('TALKS_RELATIVE_PATH');

    $talks = TalkLoader::load($talksPath);
    foreach ($talks as $talk) {
        $talksArr[] = $talk->toArray();
    }

    $response->write(json_encode($talksArr));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
