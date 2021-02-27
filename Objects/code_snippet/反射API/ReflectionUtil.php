<?php
declare(strict_types=1);

namespace popp\ch05\batch07;

/**
 * 检查用户自定义类的源码。ReflectionClass对象可以告诉我们定义类的文件名，及其内部的第一行和最后一行。
 *
 * Class ReflectionUtil
 *
 * @package popp\ch05\batch07
 */
class ReflectionUtil
{
    // 返回类的源码的参数
    public static function getClassSource(\ReflectionClass $class): string
    {
        // 返回类文件的绝对路径
        $path  = $class->getFileName();
        // file  把整个文件读入一个数组中，其中包含文件中的所有行。
        $lines = @file($path);
        $from  = $class->getStartLine();
        $to    = $class->getEndLine();
        $len   = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }


    // class ReflectionUtil
    // 得到方法的源代码
    public static function getMethodSource(\ReflectionMethod $method): string
    {
        $path  = $method->getFileName();
        $lines = @file($path);
        $from  = $method->getStartLine();
        $to    = $method->getEndLine();
        $len   = $to - $from + 1;
        return implode(array_slice($lines, $from - 1, $len));
    }

}

