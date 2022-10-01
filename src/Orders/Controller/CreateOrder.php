<?php
namespace App\Orders\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class CreateOrder
{
  /**
   * @param ServerRequestInterface $request
   * @return void
   */
  public function __invoke(ServerRequestInterface $request)
  {
    $order = [
      'productId' => $request->getParsedBody()['productId'],
      'quantity'  => $request->getParsedBody()['quantity'],
    ];
    return JsonResponse::done([
      'message' => 'POST request to /orders',
      'order'   => $order,
    ]);
  }
}