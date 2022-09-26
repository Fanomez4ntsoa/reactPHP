<?php

namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class GetAllProducts
{
  public function __invoke(ServerRequestInterface $request)
  {
    return JsonResponse::done(['message' => 'GET request to /products']);
  }
}
