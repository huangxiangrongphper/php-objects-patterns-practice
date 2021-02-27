<?php
declare(strict_types = 1);

namespace popp\ch11\batch10;

class Runner
{
    public static function run()
    {

        $acquirer = new UnitAcquisition();
        $tileforces = new TileForces(4, 2, $acquirer);
        $power = $tileforces->firepower();

        print "power is {$power}\n";

    }
}
