<?php
namespace App\Products;


class Product
{
  public $id;
  public $nom;
  public $price;

  /**
   * Initialization of the product data
   * 
   * @param integer $id
   * @param string $nom
   * @param float $price
   */
  public function __construct(int $id, string $nom, float $price)
  {
    $this->id    = $id;
    $this->nom   = $nom;
    $this->price = $price;
  }

  /**
   * @return array
   */
  public function toArray(): array
  {
    return [
      'id'    => $this->id,
      'nom'   => $this->nom,
      'price' => $this->price,
    ];
  }
}