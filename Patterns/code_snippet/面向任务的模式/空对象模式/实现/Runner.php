<?php
declare(strict_types = 1);

namespace popp\ch11\batch12;

class Runner
{

    public static function run()
    {
        $unit = new NullUnit();

        // 现在，客户端代码在NullUnit上调用任何方法都不会出错了
        // 既可以安全地调用NullUnit对象的所有方法，也可以检查任意Unit对象是否为空对象。
        if (! $unit->isNull()) {
            // do something
        } else {
            print "null - no action\n";
        }

    }
}
