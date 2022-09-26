<?php
namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class CreateProducts
{
  public function __invoke(ServerRequestInterface $request)
  {
    return JsonResponse::done(['message' => 'POST request to /products']);
  }
}