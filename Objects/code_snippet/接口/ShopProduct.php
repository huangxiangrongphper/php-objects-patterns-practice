<?php
declare(strict_types=1);

namespace popp\ch04\batch05;

// 一个实现类与它所实现的接口具有相同的类型
class ShopProduct implements Chargeable
{
    // ...
    protected $price;
    // ...

    public function getPrice(): float
    {
        return $this->price;
    }
    // ...
}
