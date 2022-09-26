<?php 
namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class DeleteProductById
{
  public function __invoke(ServerRequestInterface $request, string $id)
  {
    return JsonResponse::done(['message' => "\DELETE request to /products/{$id}"]);
  }
}