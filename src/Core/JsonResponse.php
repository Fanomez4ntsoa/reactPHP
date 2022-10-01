<?php
namespace App\Core;

use RingCentral\Psr7\Response as Psr7Response;

class JsonResponse extends Psr7Response
{
  /**
   * @param integer $statusCode
   * @param [type] $data
   */
  public function __construct(int $statusCode, $data = null)
  {
    $data = $data ? json_encode($data) : null;

    parent::__construct(
      $statusCode,
      ['Content-type' => 'application/json'],
      $data
    );
  }

  /**
   * @param [type] $data
   * @return self
   */
  public static function done($data): self
  {
    return new self(200, $data);
  }

  /**
   * @param string $reason
   * @return self
   */
  public static function internalServerError(string $reason): self
  {
    return new self(500, ['message' => $reason]);
  }
}