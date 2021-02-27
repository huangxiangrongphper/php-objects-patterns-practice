<?php
declare(strict_types = 1);

namespace popp\ch10\batch03;

/**
 * 组合模式定义了一个单根继承层次，使职责截然不同的集合可以并肩工作。
 * 前面的示例中看过这一点了。组合模式中的类必须支持同一组操作作为它们的主要职责。
 * 在本例中，这个操作就是bombardStrength()方法。这些类还必须支持用于添加和移除子类对象的方法。
 *
 * Class Unit
 *
 * @package popp\ch10\batch03
 */
abstract class Unit
{
    abstract public function addUnit(Unit $unit);
    abstract public function removeUnit(Unit $unit);
    abstract public function bombardStrength(): int;
}

