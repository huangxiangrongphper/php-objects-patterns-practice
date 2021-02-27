<?php
declare(strict_types=1);
namespace popp\ch08\batch02;

use popp\ch08\batch02\Lecture;
use popp\ch08\batch02\Seminar;

class Runner
{

    public static function run2()
    {
        $lessons1 = new Seminar(4, new TimedCostStrategy());
        $lessons2 = new Lecture(4, new FixedCostStrategy());
        $mgr = new RegistrationMgr();
        $mgr->register($lessons1);
        $mgr->register($lessons2);
    }
}
