<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

class PollutedPlains extends Plains
{
    public function getWealthFactor(): int
    {
        return parent::getWealthFactor() - 4;
    }
}

