<?php
declare(strict_types = 1);

namespace popp\ch09\batch06;

/**
 * 工厂方法模式能够解决代码关注抽象类型时如何创建对象实例的问题。
 * 答案就是用实现类负责实例化对象。
 * Class ApptEncoder
 *
 * @package popp\ch09\batch06
 */
abstract class ApptEncoder
{
    abstract public function encode(): string;
}
