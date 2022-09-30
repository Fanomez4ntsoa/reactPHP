<?php
namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class CreateProducts
{
  public function __invoke(ServerRequestInterface $request)
  {
    $product = [
      'name' => $request->getParsedBody()['name'],
      'price' => $request->getParsedBody()['price']
    ];
    return JsonResponse::done([
      'message' => 'POST request to /products',
      'product' => $product,
    ]);
  }
}