<?php

namespace popp\ch05\batch04\util;

// 这段代码引入了popp\cho5\batch04\util并隐式地赋予其别名util。
// 注意，use关键字后面的命名空间并没有以反斜杠开头，这是因为use关键字会从全局空间开始查找参数。
// 而不是当前命名空间。如果不想引用任何命名空间，那么可以只引用Debug类本身。
//use popp\cho5\batch04\util;
use popp\cho5\batch04\util\Debug;


class InSame
{
    public static function run()
    {
        Debug::helloworld();
    }

    public static function runError()
    {
        // 相对命名空间的查找方式
        // popp\ch05\batch04\util\Debug::helloworld();
//        util\Debug::helloWorld();
        Debug::helloWorld();

        // 在根命名空间下开始查找
        \popp\ch05\batch04\util\Debug::helloworld();
    }
}
