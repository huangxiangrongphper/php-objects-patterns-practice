<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

class DiamondDecorator extends TileDecorator
{
    // DiamondDecorator有一个指向Plains对象的引用。
    // 它会先调用Plains对象的getWealthFactor()，然后加上自己的收益2。
    public function getWealthFactor(): int
    {
        return $this->tile->getWealthFactor() + 2;
    }
}
