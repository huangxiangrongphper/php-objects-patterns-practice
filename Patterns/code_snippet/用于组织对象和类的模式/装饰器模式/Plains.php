<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

/**
 *
 * 完全依赖继承定义功能会导致类的数量过多，并造成代码重复。
 * Class Plains
 *
 * @package popp\ch10\batch06
 */
class Plains extends Tile
{
    private $wealthfactor = 2;

    public function getWealthFactor(): int
    {
        return $this->wealthfactor;
    }
}

