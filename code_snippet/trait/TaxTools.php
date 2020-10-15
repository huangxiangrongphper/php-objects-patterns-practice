<?php
declare(strict_types=1);

namespace popp\ch04\batch06_3;

// 多个trait拥有相同的方式时，会导致命名冲突
trait TaxTools
{
    public function calculateTax(float $price): float
    {
        return 222;
    }
}
