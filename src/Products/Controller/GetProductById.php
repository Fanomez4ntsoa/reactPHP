<?php
namespace App\Products\Controller;

use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;


class GetProductById
{
  public function __invoke(ServerRequestInterface $request, string $id)
  {
    return new Response(
      200,
      ['Content-type' => "application/json "],
      json_encode(['message' => "GET request to /products/{$id}"])
    );
  }
}