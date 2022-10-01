<?php
namespace App\Products;

use React\MySQL\ConnectionInterface;
use React\MySQL\QueryResult;
use React\Promise\PromiseInterface;

class Storage
{
  private $connection;

  /**
   * @param ConnectionInterface $connection
   */
  public function __construct(ConnectionInterface $connection)
  {
    $this->connection = $connection;  
  }

  /**
   * @param string $nom
   * @param float $price
   * @return PromiseInterface
   */
  public function create(string $nom, float $price): PromiseInterface
  {
    return $this->connection
        ->query(
          "INSERT INTO products (nom, price) VALUES (?, ?)",
          [$nom, $price]
        )
        ->then(function (QueryResult $result) use ($nom, $price){
          return new Product($result->insertId, $nom, $price);
        });
  }
}