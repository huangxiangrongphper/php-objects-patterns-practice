<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

class DiamondPlains extends Plains
{
    public function getWealthFactor(): int
    {
        return parent::getWealthFactor() + 2;
    }
}
