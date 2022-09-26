<?php
namespace App\Orders\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class CreateOrder
{
  public function __invoke(ServerRequestInterface $request)
  {
    return JsonResponse::done(['message' => 'POST request to /orders']);
  }
}