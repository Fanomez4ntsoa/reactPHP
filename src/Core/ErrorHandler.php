<?php
namespace App\Core;

use App\Core\JsonResponse;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;

class ErrorHandler
{
  /**
   * @param ServerRequestInterface $request
   * @param callable $next
   * @return void
   */
  public function __invoke(ServerRequestInterface $request, callable $next)
  {
    try {
      return $next($request);
    } catch (\Throwable $th) {
      return JsonResponse::internalServerError($th->getMessage());
    }
  }
}