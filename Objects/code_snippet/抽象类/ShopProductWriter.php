<?php
declare(strict_types=1);

namespace popp\ch04\batch03;

use popp\ch04\batch02\ShopProduct;

abstract class ShopProductWriter
{
    protected $products = [];

    public function addProduct(ShopProduct $shopProduct)
    {
        $this->products[] = $shopProduct;
    }

    abstract public function write();
}
