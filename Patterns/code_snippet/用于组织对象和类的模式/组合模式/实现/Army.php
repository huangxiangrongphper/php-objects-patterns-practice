<?php
declare(strict_types = 1);

namespace popp\ch10\batch03;

/**
 * Army 类是组合对象，用于保存Unit对象。
 * Class Army
 *
 * @package popp\ch10\batch03
 */
class Army extends Unit
{
    private $units = [];

    // 可以存储任意类型的Unit对象，
    // 包括Army对象本身
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

    public function bombardStrength(): int
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }

    public function getUnits(): array
    {
        return $this->units;
    }

}

