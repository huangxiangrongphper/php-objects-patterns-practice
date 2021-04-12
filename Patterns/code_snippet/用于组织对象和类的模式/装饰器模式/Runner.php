<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

class Runner
{

    // 得到一个被污染的单元格
    public static function run()
    {
        $tile = new PollutedPlains();
        print $tile->getWealthFactor();
    }

    public static function run2()
    {

        $tile = new Plains();
        print $tile->getWealthFactor(); // 2

    }

    public static function run3()
    {

        $tile = new DiamondDecorator(new Plains());
        print $tile->getWealthFactor(); // 4

    }

    public static function run4()
    {

        $tile = new PollutionDecorator(new DiamondDecorator(new Plains()));
        print $tile->getWealthFactor(); // 0

    }
}
