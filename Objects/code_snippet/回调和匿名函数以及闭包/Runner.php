<?php
declare(strict_types=1);

namespace popp\ch04\batch23;

class Runner
{
    public static function run()
    {
        // 使用 create_function()创建了一个回调。
        // 接受两个参数：一个参数列表和一个函数体。
        $logger = create_function(
            '$product',
            'print "    logging ({$product->name})\n";'
        );

        $processor = new ProcessSale();
        $processor->registerCallback($logger);

        $processor->sale(new Product("shoes", 6));
        print "\n";
        $processor->sale(new Product("coffee", 6));
    }

    public static function run2()
    {
        // PHP 5.3以后就有了一种更好的办法：仅在一条语句中声明并赋值一个函数。
        // 内联使用了function关键字，没有给函数起名。
        // 请注意，这是一条内联语句，因此要在内码快的末尾放一个分号。
        $logger2 = function ($product) {
            print "    logging ({$product->name})\n";
        };

        $processor = new ProcessSale();
        $processor->registerCallback($logger2);

        $processor->sale(new Product("shoes", 6));
        print "\n";
        $processor->sale(new Product("coffee", 6));
    }

    public static function run3()
    {

        $processor = new ProcessSale();
        // 回调不一定是匿名的。
        // 可以使用函数名甚至对象引用、方法作为回调。
        // is_callable()的功能非常强大，可以检查这类数组。
        // 在一个数组格式的有效回调中，第一个元素必须是对象，第二个元素必须是方法名。
        $processor->registerCallback([new Mailer(), "doMail"]);

        $processor->sale(new Product("shoes", 6));
        print "\n";
        $processor->sale(new Product("coffee", 6));
    }

    public static function run4()
    {

        $processor = new ProcessSale();

        // 使用warnAmount()作为匿名函数的工厂方法
        $processor->registerCallback(Totalizer::warnAmount());

        $processor->sale(new Product("shoes", 6));
        print "\n";
        $processor->sale(new Product("coffee", 6));
    }

    public static function run5()
    {

        $processor = new ProcessSale();

        // 使用warnAmount()作为匿名函数的工厂方法
        $processor->registerCallback(Totalizer2::warnAmount(8));

        $processor->sale(new Product("shoes", 6));
        print "\n";
        $processor->sale(new Product("coffee", 6));
    }
}
//done
