<?php
declare(strict_types = 1);

namespace popp\ch10\batch02;

/**
 * 军队应该可以与其他军队合并，同时每个军队都有自己的ID，这样军队以后还能够从整编中解散出来。
 * 我们不能仅支持军队与军队的合并，还要在必要时将原来的军队抽调出来。
 *
 * Class ArmyNew
 *
 * @package popp\ch10\batch02
 */
class ArmyNew
{
    private $units = [];
    private $armies = [];

    public function addUnit(Unit $unit)
    {
        array_push($this->units, $unit);
    }

    public function addArmy(Army $army)
    {
        array_push($this->armies, $army);
    }


    // 拥有遍历所有队伍和所有军队的能力
    // 军队由队伍组成
    public function bombardStrength(): int
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }

        foreach ($this->armies as $army) {
            $ret += $army->bombardStrength();
        }

        return $ret;
    }
}
