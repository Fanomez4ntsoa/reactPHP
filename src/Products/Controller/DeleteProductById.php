<?php 
namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class DeleteProductById
{
  /**
   * @param ServerRequestInterface $request
   * @param string $id
   * @return void
   */
  public function __invoke(ServerRequestInterface $request, string $id)
  {
    return JsonResponse::done(['message' => "\DELETE request to /products/{$id}"]);
  }
}