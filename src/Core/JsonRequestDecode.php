<?php
namespace App\Core;

use Psr\Http\Message\ServerRequestInterface;



class JsonRequestDecode
{
  public function __invoke(ServerRequestInterface $request, callable $next)
  {
    if ($request->getHeaderLine('Content-type') === 'application/json') {
      $request = $request->withParsedBody(
        json_decode($request->getBody()->getContents(), true)
      );
    }
    return $next($request);
  }
}