<?php
declare(strict_types = 1);

namespace popp\ch11\batch12;

use popp\ch11\batch08\Army;
use popp\ch11\batch08\Archer;
use popp\ch11\batch08\Cavalry;
use popp\ch11\batch08\LaserCanonUnit;

class UnitAcquisition
{

    public function getUnits(int $x, int $y): array
    {
        $army = new Army();
        $army->addUnit(new Archer());

        $found = [
            new Cavalry(),
            // 创建一个NullUnit对象，而不是返回null
            new NullUnit(),
            new LaserCanonUnit(),
            $army
        ];

        return $found;
    }

}
