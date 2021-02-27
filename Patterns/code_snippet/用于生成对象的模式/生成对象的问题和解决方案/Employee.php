<?php
declare(strict_types = 1);

namespace popp\ch09\batch01;

/**
 *           用于生成对象的模式
 *  这些模式关注对象的实例化。考虑到"针对接口编程"的原则，这是一个重要的分类。
 *  如果在设计中使用了抽象父类，那么我们必须考虑从具体子类中实例化出对象的策略，
 *  因为在系统中传递的是这些对象。
 *
 *  思考生成对象的策略
 *
 * Class Employee
 *
 * @package popp\ch09\batch01
 *
 *
 */
abstract class Employee
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function fire();
}
