<?php

namespace popp\ch04\batch23;

/**
 * Class Mailer
 *
 * @package \popp\ch04\batch23
 */
class Totalizer2
{
    // 可以让一个方法返回匿名函数
    // 除了生成匿名函数外，这种结构还可以做很多事情，例如闭包。
    // 这种新式的匿名函数可以引用那些声明在其父作用域中的变量
    // 这就仿佛匿名函数能够记住创建它的上下文一样。
    public static function warnAmount($amt)
    {
       $count = 0;

       // 可以通过use语句让匿名函数追踪来自其父作用域的变量
       // &按引用访问
       // 回调能够跟踪多次函数调用之间的$count值。
       return function ($product) use ($amt, &$count) {
           $count += $product->price;
           print "  count: $count\n";
           if ($count > $amt) {
               print " high price reached: {$count}\n";
           }
       };

    }
}
