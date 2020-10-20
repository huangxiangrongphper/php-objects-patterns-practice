<?php
declare(strict_types=1);

namespace popp\ch04\batch19;

class Runner
{
    public static function run()
    {
        // runner code here

        $person = new Person("bob", 44);
        $person->setId(343);
        unset($person);

    }
}
