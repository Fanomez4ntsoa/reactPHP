<?php
require('vendor/autoload.php');

use App\Core\Router;
use App\Core\ErrorHandler;
use App\Core\JsonRequestDecode;
use React\Http\Server;
use React\MySQL\Factory;
use React\MySQL\QueryResult;
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
use App\Products\Storage as Products;

$loop = \React\EventLoop\Factory::create();

$env = \Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();

$factory = new Factory($loop);
$uri = getenv('DB_LOGIN') . ':' . getenv('DB_PASS') . '@' . getenv('DB_HOST') . '/' . getenv('DB_NAME');
$connection = $factory->createLazyConnection($uri);
$products = new Products($connection);

$connection->query('SHOW TABLES')
    ->then(function(QueryResult $result) {
      print_r($result->resultRows);
    });

// Routes for products
$routes = new RouteCollector(new Std(), new GroupCountBased());
$routes->get('/products', new GetAllProducts($products));
$routes->post('/products/create', new CreateProducts($products));
$routes->get('/products/{id:\d+}', new GetProductById($products));
$routes->put('/products/{id:\d+}', new UpdateProduct($products));
$routes->delete('/products/{id:\d+}', new DeleteProductById($products));

// Routes for Orders
$routes->get('/orders', new GetAllOrders());
$routes->post('/orders/create', new CreateOrder());
$routes->get('/orders/{id:\d+}', new GetOrderById());
$routes->delete('/orders/{id:\d+}', new DeleteOrderById());

$server = new Server(new ErrorHandler(), new JsonRequestDecode(), new Router($routes));

$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);


$server->on('error', function(Throwable $error){
  echo "Error : " . $error->getMessage() . PHP_EOL;
});

echo 'Listening on ' . str_replace('tpc','http', $socket->getAddress()) . PHP_EOL;
$loop->run();