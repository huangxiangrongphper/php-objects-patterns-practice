<?php
declare(strict_types=1);

namespace popp\ch04\batch06;

use popp\ch04\batch06_1\PriceUtilities;
use popp\ch04\batch06_3\TaxTools;

class UtilityService extends Service
{
    public $taxrate = 17;
    //    use PriceUtilities, TaxTools;
    // will cause deliberate error
    // use PriceUtilities, TaxTools;

    // insteadof (代替) 通过此关键字，来解决trait中的方法冲突
//    use PriceUtilities, TaxTools {
//        TaxTools::calculateTax insteadof PriceUtilities;
//    }

//    use PriceUtilities, TaxTools {
//        TaxTools::calculateTax insteadof PriceUtilities;
//        PriceUtilities::calculateTax as basicTax;
//    }

//    use PriceUtilities;
//    use PriceUtilities;
//
//    // 实现trait中的抽象方法
//    public function getTaxRate(): float
//    {
//        return 17;
//    }

 // 用as运算符和private关键字修改了calculateTax的访问权限
    use PriceUtilities {
        PriceUtilities::calculateTax as private;
    }

    private $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getTaxRate(): float
    {
        return 17;
    }

    public function getFinalPrice(): float
    {
        return ($this->price + $this->calculateTax($this->price));
    }
}
