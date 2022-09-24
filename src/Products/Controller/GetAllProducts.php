<?php

namespace App\Products\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

class GetAllProducts
{
  public function __invoke(ServerRequestInterface $request)
  {
    return new Response(
      200,
      ['Content-type' => "application/json "],
      json_encode(['message' => 'GET request to /products'])
    );
  }
}
