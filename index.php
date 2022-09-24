/* 
  Mise en place d'un serveur en fonctionnement
  qui traitera les demandes entrantes.
  Serveur HTTP vide.
*/

<?php
require('vendor/autoload.php');

use React\MySQL\Factory;
use React\Http\Message\Response;
use React\Http\Server;

$loop = \React\EventLoop\Factory::create();

$hello = function() {
  return new Response(200,['content-type' => 'application/json'], json_encode(['message' => 'Hello World']));
};

$server = new Server($hello);
$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);

echo 'Listening on' . str_replace('tpc','http', $socket->getAddress()) . PHP_EOL;
$loop->run();