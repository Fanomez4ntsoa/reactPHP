<?php
namespace App\Orders\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class GetOrderById
{
  public function __invoke(ServerRequestInterface $request, string $id)
  {
    return JsonResponse::done(['message' => "GET request to /orders/{$id}"]);
  }
}