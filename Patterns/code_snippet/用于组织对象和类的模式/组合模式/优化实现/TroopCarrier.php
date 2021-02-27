<?php
declare(strict_types = 1);

namespace popp\ch10\batch05;

class TroopCarrier extends CompositeUnit
{
    // 假设现在有一个Cavalry对象，如果游戏规则规定马不能上运兵船，
    // 那么组合模式中没有很好的办法使程序遵守这种规则。
    // 但这正是组合模式的缺陷之一。我们让所有的类都继承自相同的基类以实现简单性，
    // 但这种简单性有时又是以牺牲类型安全为代价的。
    // 随着模型变得越来越复杂，我们需要手动进行的类型检查也会越来越多。
    public function addUnit(Unit $unit)
    {
        // 这里我们不得不使用instanceof运算符来检查传递给addUnit()方法的对象的类型。
        // 如果代码有太多这种特殊情况，那么组合模式会渐渐显得弊大于利。
        // 组合模式最适用于大部分叶子对象都可互换时。
        if ($unit instanceof Cavalry) {
            throw new UnitException("Can't get a horse on the vehicle");
        }

        parent::addUnit($unit);
    }

    public function bombardStrength(): int
    {
        return 0;
    }
}

