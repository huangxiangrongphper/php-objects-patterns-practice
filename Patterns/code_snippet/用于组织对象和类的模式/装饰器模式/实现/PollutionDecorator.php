<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

/**
 * 继承自TileDecorator，这表示它们都有一个指向Tile对象的引用。
 * 当getWealthFactor()方法被调用时，它们都会在进行自己的处理前先调用所包含的那个Tile对象引用的同名方法。
 *
 * 通过像这样使用组合和委托，我们能够在运行时更加轻松组合对象。因为本模式中的所有对象都继承自Tile类，所以
 * 客户端无须知道它正在使用的是一个组合对象，但它知道所有Tile对象都有getWealthFactor()方法，无论它是一个装饰器对象还是真正的Tile对象。
 *
 * Class PollutionDecorator
 *
 * @package popp\ch10\batch06
 */
class PollutionDecorator extends TileDecorator
{
    public function getWealthFactor(): int
    {
        return $this->tile->getWealthFactor() - 4;
    }
}
