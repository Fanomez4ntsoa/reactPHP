<?php
namespace App\Core;

use App\Core\JsonResponse;
use React\Http\Message\Response;
use Psr\Http\Message\ServerRequestInterface;

class ErrorHandler
{
  public function __invoke(ServerRequestInterface $request, callable $next)
  {
    try {
      return $next($request);
    } catch (\Throwable $th) {
      return JsonResponse::internalServerError($th->getMessage());
    }
  }
}