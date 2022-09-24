<?php
require('vendor/autoload.php');

use React\Http\Server;
use React\MySQL\Factory;
use FastRoute\RouteCollector;
use App\Products\Controller\CreateProducts;
use App\Products\Controller\GetAllProducts;
use FastRoute\DataGenerator\GroupPosBased;
use FastRoute\RouteParser\Std;

$loop = \React\EventLoop\Factory::create();

$routes = new RouteCollector(new Std(), new GroupPosBased());
$routes->get('/products', new GetAllProducts());
$routes->post('/products', new CreateProducts());

$server = new Server(new App\Router($routes));

$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);

echo 'Listening on ' . str_replace('tpc','http', $socket->getAddress()) . PHP_EOL;
$loop->run();