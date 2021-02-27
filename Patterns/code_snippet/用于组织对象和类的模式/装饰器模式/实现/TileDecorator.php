<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

/**
 *
 * 相较于只使用继承，装饰器模式会使用组合和委托来解决问题。
 *
 * 实际上Decorator类包含类型相同的另一个实例。Decorator对象实现了与被包含对象相同的方法。
 * 这样当它的某个方法被调用时，它会在执行自己的操作前或执行自己的操作后调用被包含对象的这个方法。
 * 通过这种方式，我们能够在运行时创建一条Decorator对象的流水线。
 * Class TileDecorator
 *
 * @package popp\ch10\batch06
 */
abstract class TileDecorator extends Tile
{
    protected $tile;

    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}

