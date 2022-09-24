<?php

namespace App;

use Exception;
use FastRoute\RouteCollector;
use React\Http\Message\Response;
use FastRoute\Dispatcher\GroupCountBased;
use Psr\Http\Message\ServerRequestInterface;

class Router 
{
  private $dispatcher;

  public function __construct(RouteCollector $routes)
  {
    $this->dispatcher = new GroupCountBased($routes->getData());
  }

  public function __invoke(ServerRequestInterface $request)
  {
    $routeInfo = $this->dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());
  
    switch ($routeInfo[0]) {
      case \FastRoute\Dispatcher::NOT_FOUND;
        return new Response(404, ['Content-type' => 'text/plain'], "Not Found");
      case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED;
        return new Response(405, ['Content-type' => 'text/plain'], 'Method not allowed');
      case \FastRoute\Dispatcher::FOUND;
        return $routeInfo[1]($request);
      }
      throw new Exception("Something went wrong with routing");
    }
}

