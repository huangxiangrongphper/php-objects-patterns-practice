<?php
declare(strict_types=1);

namespace popp\ch04\batch06_1;

// php 5.4 引入trait的概念
trait PriceUtilities
{
//    private $taxrate = 17;
    // trait中使用静态属性
//    private static $taxrate = 17;

//    public function calculateTax(float $price): float
//    {
//        return (($this->taxrate / 100) * $price);
//    }

    // trait中使用静态方法
//    public static function calculateTax(float $price): float
//    {
//        return ((self::$taxrate / 100) * $price);
//    }


  // 访问宿主类中的属性和方法 要求使用它的类提供相应的属性（有时不是一种好的设计）
  //  因为有可能要在多个类中使用
//    public function calculateTax(float $price): float
//    {
//        // is this good design?
//        return (($this->taxrate / 100) * $price);
//    }

   // 在trait中定义抽象方法
//    public function calculateTax(float $price): float
//    {
//        // better design.. we know getTaxRate() is implemented
//        return (($this->getTaxRate() / 100) * $price);
//    }
//
//    abstract public function getTaxRate(): float;

    public function calculateTax(float $price): float
    {
        return (($this->getTaxRate() / 100) * $price);
    }
    abstract public function getTaxRate(): float;

    // other utilities
}
