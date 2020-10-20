<?php
declare(strict_types=1);

namespace popp\ch04\batch07;

abstract class DomainObject
{
    private $group;

    public function __construct()
    {
        // static还可以被用作静态方法调用的标识符，
        // 在非静态上下文中也一样
        $this->group = static::getGroup();
    }

    public static function create(): DomainObject
    {
        return new static();
    }

    public static function getGroup(): string
    {
        return "default";
    }
}
