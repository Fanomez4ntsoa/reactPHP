/* 
  * Mise en place d'un serveur en fonctionnement
  qui traitera les demandes entrantes.
  Serveur HTTP vide.
  * configuration des routes avec l'utilisation
  de FastRoute 

*/

<?php
require('vendor/autoload.php');

use Psr\Http\Message\ServerRequestInterface;
use React\MySQL\Factory;
use React\Http\Message\Response;
use React\Http\Server;

$loop = \React\EventLoop\Factory::create();

$dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $routes) {
  $routes->get('/products', function(ServerRequestInterface $request){
    return new Response(
      200,
      ['Content-type' => "application/json "],
      json_encode(['message' => 'GET request to /products'])
    );
  });
  $routes->post('/products', function(ServerRequestInterface $request){
    return new Response(
      200,
      ['Content-type' => "application/json "],
      json_encode(['message' => 'POST request to /products'])
    );
  });  
});

$server = new Server(function(ServerRequestInterface $request) use ($dispatcher) {
  $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());

  switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND;
      return new Response(404, ['Content-type' => 'text/plain'], "Not Found");
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED;
      return new Response(405, ['Content-type' => 'text/plain'], 'Method not allowed');
    case \FastRoute\Dispatcher::FOUND;
      return $routeInfo[1]($request);

    throw new Exception("Something went wrong with routing");
    
  }
});

$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);

echo 'Listening on' . str_replace('tpc','http', $socket->getAddress()) . PHP_EOL;
$loop->run();