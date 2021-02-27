<?php
declare(strict_types = 1);

namespace popp\ch10\batch05;

// 没有实现bombardStrength()抽象方法
// 将添加和移除对象的方法移到基类外
// 客户端仍然必须在调用addUnit()方法前检查要调用的对象是否为CompositeUnit对象。
abstract class CompositeUnit extends Unit
{
    private $units = [];

    // 只有在CompositeUnit类中时才会返回CompositeUnit对象。
    // 因此，如果调用这个方法返回了一个对象，那就表示我们可以在这个对象上调用addUnit()。
    public function getComposite(): CompositeUnit
    {
        return $this;
    }

    public function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }

        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit)
    {
        $idx = array_search($unit, $this->units, true);
        if (is_int($idx)) {
            array_splice($this->units, $idx, 1, []);
        }
    }

    public function getUnits(): array
    {
        return $this->units;
    }
}

