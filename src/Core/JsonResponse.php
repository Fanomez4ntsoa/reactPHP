<?php
namespace App\Core;

use RingCentral\Psr7\Response as Psr7Response;

class JsonResponse extends Psr7Response
{
  public function __construct(int $statusCode, $data = null)
  {
    $data = $data ? json_encode($data) : null;

    parent::__construct(
      $statusCode,
      ['Content-type' => 'application/json'],
      $data
    );
  }

  public static function done($data): self
  {
    return new self(200, $data);
  }

  public static function internalServerError(string $reason): self
  {
    return new self(500, ['message' => $reason]);
  }
}