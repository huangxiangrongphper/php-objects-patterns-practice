<?php
declare(strict_types = 1);

namespace popp\ch10\batch03;

/**
 * Archer类则是叶子对象，用于支持一支队伍所需要的操作，但无法保存Unit对象。
 * Class Archer
 *
 * @package popp\ch10\batch03
 */
class Archer extends Unit
{
    // 所有的叶子对象都不能添加和移除Unit对象，
    // 所以提供一种默认实现来替代抽象的addUnit和removeUnit有助于改善设计。
    public function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this) . " is a leaf");
    }

    // 为什么要将冗余的addUnit()和removeUnit()方法放在明明不需要它们的叶子对象中呢？
    // 答案就是Unit类型的透明性。
    public function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this) . " is a leaf");
    }

    public function bombardStrength(): int
    {
        return 4;
    }
}
