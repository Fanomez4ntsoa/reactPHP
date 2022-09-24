<?php
require('vendor/autoload.php');

use App\Router;
use React\Http\Server;
use React\MySQL\Factory;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use App\Products\Controller\DeleteProduct;
use App\Products\Controller\UpdateProduct;
use FastRoute\DataGenerator\GroupPosBased;
use App\Products\Controller\CreateProducts;
use App\Products\Controller\GetAllProducts;
use App\Products\Controller\GetProductById;

$loop = \React\EventLoop\Factory::create();

$routes = new RouteCollector(new Std(), new GroupPosBased());
$routes->get('/products', new GetAllProducts());
$routes->post('/products', new CreateProducts());
$routes->get('/products/{id:\d+}', new GetProductById());
$routes->put('/products/{id:\d+}', new UpdateProduct());
$routes->delete('/products/{id:\d+}', new DeleteProduct());

$server = new Server(new Router($routes));

$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);

echo 'Listening on ' . str_replace('tpc','http', $socket->getAddress()) . PHP_EOL;
$loop->run();