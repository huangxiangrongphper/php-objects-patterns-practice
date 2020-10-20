<?php

namespace popp\ch04\batch23;

/**
 * Class Mailer
 *
 * @package \popp\ch04\batch23
 */
class Totalizer
{
    // 可以让一个方法返回匿名函数
    public static function warnAmount()
    {
        return function (Product $product) {
            if ($product->price > 5) {
                print "  reached high price: ({$product->price})\n";
            }
        };
    }
}
