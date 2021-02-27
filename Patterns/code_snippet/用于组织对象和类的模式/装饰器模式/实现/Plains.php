<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

class Plains extends Tile
{
    private $wealthfactor = 2;

    public function getWealthFactor(): int
    {
        return $this->wealthfactor;
    }
}

