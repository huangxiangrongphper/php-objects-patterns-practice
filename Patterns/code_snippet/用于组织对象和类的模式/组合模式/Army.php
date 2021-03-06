<?php
declare(strict_types = 1);

namespace popp\ch10\batch01;

class Army
{
    private $units = [];

    public function addUnit(Unit $unit)
    {
        array_push($this->units, $unit);
    }

    public function bombardStrength(): int
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}
