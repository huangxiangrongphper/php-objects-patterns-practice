<?php

/**
 *  在同一个文件中声明多个命名空间。
 *  以下是通过namespace关键字和大括号声明命名空间的另一种语法。
 *
 *  如果必须在同一个文件中定义多个命令空间，那么我们推荐以上这种声明语法。
 *  但通常而言，在每个文件中定义一个命名空间是一种最佳实践。
 *
 *  不能在同一个文件中同时使用大括号和行命名空间语法，只能选择其一并贯彻整个文件。
 *
 */

namespace com\getinstance\util {

    class Debug
    {
        public static function helloWorld()
        {
            print "hello from Debug\n";
        }
    }
}

namespace other {

    \com\getinstance\util\Debug::helloWorld();
}

