<?php
declare(strict_types = 1);

namespace popp\ch11\batch09;

/**
 * 生成命令对象的客户端
 *
 * 在一个Web项目中，选择实例化哪个命令对象的最简单方法
 * 由请求自身的参数来决定。
 * Class CommandFactory
 *
 * @package popp\ch11\batch09
 */
class CommandFactory
{
    private static $dir = 'commands';


    // CommandFactory类会在commands路劲下查找特定的类文件。
    public static function getCommand(string $action = 'Default'): Command
    {
        if (preg_match('/\W/', $action)) {
            throw new Exception("illegal characters in action");
        }

        // 用CommandFactory类自己的命令空间、字符串'\Commands\'以及CommandContext对象的$action参数
        // 组成了一个完全限定的类名，
        // CommandContext对象的$action参数是通过请求传递到系统中的。
        // 得益于Composer的自动加载，我们无须显示地包含某个类。
        $class = __NAMESPACE__ . "\\commands\\" . UCFirst(strtolower($action)) . "Command";

        if (! class_exists($class)) {
            throw new CommandNotFoundException("no '$class' class located");
        }

        $cmd = new $class();

        return $cmd;
    }
}
