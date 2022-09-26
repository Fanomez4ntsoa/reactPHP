<?php
require('vendor/autoload.php');

use App\Core\Router;
use React\Http\Server;
use React\MySQL\Factory;
use App\Core\ErrorHandler;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use App\Orders\Controller\CreateOrder;
use App\Orders\Controller\GetAllOrders;
use App\Orders\Controller\GetOrderById;
use App\Orders\Controller\DeleteOrderById;
use App\Products\Controller\UpdateProduct;
use App\Products\Controller\CreateProducts;
use App\Products\Controller\GetAllProducts;
use App\Products\Controller\GetProductById;
use FastRoute\DataGenerator\GroupCountBased;
use App\Products\Controller\DeleteProductById;

$loop = \React\EventLoop\Factory::create();

// Routes for products
$routes = new RouteCollector(new Std(), new GroupCountBased());
$routes->get('/products', new GetAllProducts());
$routes->post('/products', new CreateProducts());
$routes->get('/products/{id:\d+}', new GetProductById());
$routes->put('/products/{id:\d+}', new UpdateProduct());
$routes->delete('/products/{id:\d+}', new DeleteProductById());

// Routes for Orders
$routes->get('/orders', new GetAllOrders());
$routes->post('/orders', new CreateOrder());
$routes->get('/orders/{id:\d+}', new GetOrderById());
$routes->delete('/orders/{id:\d+}', new DeleteOrderById());

$server = new Server(new ErrorHandler([]), new Router($routes));

$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);


$server->on('error', function(Throwable $error){
  echo "Error : " . $error->getMessage() . PHP_EOL;
});

echo 'Listening on ' . str_replace('tpc','http', $socket->getAddress()) . PHP_EOL;
$loop->run();