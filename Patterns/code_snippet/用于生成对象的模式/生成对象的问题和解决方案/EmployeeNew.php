<?php
declare(strict_types = 1);

namespace popp\ch09\batch03;

abstract class EmployeeNew
{
    protected $name;
    private static $types = ['Minion', 'CluedUp', 'WellConnected'];

    // 实例化对象是一件脏活，但必须有人做这件事。
    // 这里使用委托对象实例
    public static function recruit(string $name)
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = __NAMESPACE__ . "\\".self::$types[$num];
        return new $class($name);
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}
