<?php
declare(strict_types = 1);

namespace popp\ch09\batch11;

/**
 *      原型模式
 * 抽象工厂模式的另一种变化形式
 *
 * 平行继承层次的出现是工厂方法模式带来的一个问题。
 * 这是一种让程序员感到不悦的耦合形式。
 *
 * 每次加入一个产品家族时，我们都不得不创建相关的一些具体创建者（例如，BloggsCal编码器与BloggsCommsManager相匹配）。
 * 这样一来，快速发展的系统会包含越来越多的产品，而维护这种关系会让人感到厌烦。
 *
 * 避免出现这种关系的一种方法是，使用PHP的clone关键字来复制既存的具体产品。这样一来，具体产品类自身会变为生成它们自己的基础。
 * 这就是原型模式。该模式允许我们用组合替代继承，提高代码在运行时的灵活性，并减少需要创建的类的数量。
 *
 * Class Sea
 *
 * @package popp\ch09\batch11
 */
class Sea
{
    private $navigability = 0;

    public function __construct(int $navigability)
    {
        $this->navigability = $navigability;
    }
}
