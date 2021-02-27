<?php
declare(strict_types = 1);

namespace popp\ch10\batch08;

require_once("src/ch10/batch08/legacy.php");

class Runner
{
    // 如果在项目中直接调用这些函数，
    // 那么我的系统就会与这些子系统紧耦合在一起。
    // 当子系统发生改变或我们决定用其他子系统替换这个仔细同时，
    // 就会发生问题。
    // 因此，我们需要让其他代码通过一个"入口"进入我们的系统。
    public static function run()
    {
        $lines = getProductFileLines(__DIR__ . '/test2.txt');
        $objects = [];
        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $objects[$id] = getProductObjectFromID($id, $name);
        }

        print_r($objects);
    }

    public static function run2()
    {
        $facade = new ProductFacade(__DIR__ . '/test2.txt');
        $object = $facade->getProduct("234");
    }
}
