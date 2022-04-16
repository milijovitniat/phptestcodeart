<?php

/**
 * Да се дополнат класите така што ќе се случи следново сценарио:
 *
 * 1. John ќе си ја наполни кошничката со продуктите кои се веќе иницијализирани во променливата $products
 * 2. За да купи што е можно повеќе производи John одлучил дека ќе ги сортира производите во кошницата по цена по
 *    опаѓачки редослед и ќе ги купува еден по еден додека има пари.
 * 3. Откако John ќе заврши со купувањето да се испечати кои производи му останале на John во кошницата и да се испечати
 *    уште колку пари му останале.
 *
 * Напомена: Може да се додаваат методи во класите но стартниот код не смее да се менува.
 */

class Product
{
    /**
     * @param  int  $id
     * @param  string  $name
     * @param  float  $price
     */
    public function __construct(
        int $id,
        string $name,
        float $price
    ) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}

class Cart
{
    /**
     * @param  Product[] $products
     */
    public function __construct(
        array $products
    ) 
    {
        $this->products = $products;
    }

    /**
     * Sort the products in the cart in descending order by price
     *
     * @return void
     */
    public function sortByPrice(): void
    {
        uasort($this->products, function($a,$b)
        {
            return $b->price <=> $a->price;
        });
    }
}

class Buyer
{
    /**
     * @param  string  $name
     * @param  Cart  $cart
     * @param  float  $money
     */
    public function __construct(
        string $name,
        Cart $cart,
        float $money
    ) 
    {
        $this->name = $name;
        $this->cart = $cart;
        $this->money = $money;
    }

    private $smetka = 0;
    /**
     * @return void
     */
    public function buyProducts(): void
    {
        $this->cart->sortByPrice();

        foreach($this->cart->products as $x => $y)
        {
            $this->smetka += $y->price;
        }
        
        while($this->smetka > $this->money)
        {
            $this->smetka -= end($this->cart->products)->price;
            array_pop($this->cart->products);
        }
    }

    /**
     * @return void
     */
    public function printRemainingCartProducts(): void
    {
        foreach($this->cart->products as $x => $y)
        {
            echo "id: ".$y->id."</br>";
            echo "name: ".$y->name."</br>";
            echo "price: ".$y->price."</br>";
            echo "</br>";
        }
    }

    /**
     * @return void
     */
    public function printRemainingMoney(): void
    {
        echo "remaining money: " . ($this->money - $this->smetka);
    }
}

$products = [
  new Product(1, "banana", 4.99),
  new Product(2, "apple", 9.55),
  new Product(3, "ice cream", 12),
  new Product(4, "yogurt", 13),
  new Product(5, "yogurt", 14)
];

$buyer = new Buyer("John", new Cart([]), 43.99);

/**
 * Results
*/

$buyer->cart = new Cart($products);
$buyer->buyProducts();
$buyer->printRemainingCartProducts();
$buyer->printRemainingMoney();






