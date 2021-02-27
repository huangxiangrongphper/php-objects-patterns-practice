<?php
declare(strict_types = 1);

namespace popp\ch15\batch01;

/**
 *  方法与函数调用
 *
 * Class Runner
 *
 * @package popp\ch15\batch01
 */
class Runner
{
    public static function run()
    {
        // 方法调用中的参数列表的规则与方法声明中的参数列表的规则相同。
        // 如果需要使用多行代码进行方法调用，
        // 那么每个参数应该自成一行并缩进，
        // 而且结束圆括号也应该自成一行。
        $earthgame = new EarthGame(
            5,
            "earth",
            true,
            true
        );
        // 方法名称和开始圆括号之间不能有空格。
        // 对于单行调用，
        // 开始圆括号后或结束圆括号前不能有空格。
        // 每个参数之后应该紧跟一个逗号，
        // 下一个参数前应该有一个空格。
        $earthgame::generateTile(5, true);
    }
}
