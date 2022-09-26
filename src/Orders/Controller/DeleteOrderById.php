<?php 
namespace App\Orders\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class DeleteOrderById
{
  public function __invoke(ServerRequestInterface $request, string $id)
  {
    return JsonResponse::done(['message' => "\DELETE request to /orders/{$id}"]);
  }
}
