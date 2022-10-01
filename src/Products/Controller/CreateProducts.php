<?php
namespace App\Products\Controller;

use Exception;
use App\Core\JsonResponse;
use App\Products\Product;
use App\Products\Storage;
use Psr\Http\Message\ServerRequestInterface;

class CreateProducts
{

  /**
   * @param Storage $storage
   */
  public function __construct(Storage $storage)
  {
    $this->storage = $storage;
  }

  /**
   * @param ServerRequestInterface $request
   * @return void
   */
  public function __invoke(ServerRequestInterface $request)
  {
    $nom = $request->getParsedBody()['nom'];
    $price = $request->getParsedBody()['price'];

    return $this->storage->create($nom, $price)
        ->then(
        function (Product $product) {
          return JsonResponse::done($product->toArray());
        },
        function (Exception $exception) {
          return JsonResponse::internalServerError($exception->getMessage());
        }
      );
  }
}