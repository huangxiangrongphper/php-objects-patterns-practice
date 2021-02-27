<?php
declare(strict_types = 1);

namespace popp\ch09\batch03;

class WellConnected extends EmployeeNew
{
    public function fire()
    {
        print "{$this->name}: I'll call my dad\n";
    }
}
