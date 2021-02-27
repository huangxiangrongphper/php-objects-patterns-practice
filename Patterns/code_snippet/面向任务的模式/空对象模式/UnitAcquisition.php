<?php
declare(strict_types = 1);

namespace popp\ch11\batch10;

use popp\ch11\batch08\Army;
use popp\ch11\batch08\Archer;
use popp\ch11\batch08\Cavalry;
use popp\ch11\batch08\LaserCanonUnit;

/**
 * 维护者保存在本地的有关系统中队伍的信息
 *
 * 本类负责将此数据转换为对象数组。
 *
 * Class UnitAcquisition
 *
 * @package popp\ch11\batch10
 */
class UnitAcquisition
{
    public function getUnits(int $x, int $y): array
    {
        // 1. looks up x and y in local data and gets a list of unit ids
        // 2. goes off to a data source and gets full unit data

        // here's some fake data
        $army = new Army();
        $army->addUnit(new Archer());

        // 在$found数组中嵌入了一个空对象。
        // 当我们的网络游戏客户端持有的元数据与服务器上的数据状态不一致时，
        // 这种情况可能发生。
        $found = [
            new Cavalry(),
            null,
            new LaserCanonUnit(),
            $army
        ];

        return $found;
    }
}
