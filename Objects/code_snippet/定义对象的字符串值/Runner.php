<?php
declare(strict_types=1);

namespace popp\ch04\batch22;

class Runner
{
    public static function run()
    {
        $st = new StringThing();
        //print $st;
    }

    public static function run2()
    {
        $person = new Person();
        print $person;
        // Bob (age 44)
    }
}
//done
