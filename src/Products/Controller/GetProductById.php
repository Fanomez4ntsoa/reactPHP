<?php
namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

class GetProductById 
{
  /**
   * @param ServerRequestInterface $request
   * @param string $id
   * @return void
   */
  public function __invoke(ServerRequestInterface $request, string $id)
  {
    return JsonResponse::done(['message' => "GET request to /products/{$id}"]);
  }
}