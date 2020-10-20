<?php
declare(strict_types=1);

namespace popp\ch04\batch07;

class Runner
{
    public static function run()
    {
        print_r(User::create());
        print_r(SpreadSheet::create());
    }
}
