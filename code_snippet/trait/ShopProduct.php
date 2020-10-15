<?php
declare(strict_types=1);

namespace popp\ch04\batch06;

use popp\ch04\batch06_1\PriceUtilities;
use popp\ch04\batch06_2\IdentityTrait;
use popp\ch04\batch06_3\IdentityObject;

// 可以将trait与接口组合使用
class ShopProduct implements IdentityObject
{
    use PriceUtilities, IdentityTrait;

    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;

    public function __construct(
        string $title,
        string $firstName,
        string $mainName,
        float $price
    ) {
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

// ...

}

