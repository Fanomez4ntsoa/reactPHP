<?php
namespace App\Orders\Controller;

use App\Core\JsonResponse;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;

class GetAllOrders
{
  public function __invoke(ServerRequestInterface $request)
  {
    return JsonResponse::done(['message' => 'GET request to /orders']);
  }
}