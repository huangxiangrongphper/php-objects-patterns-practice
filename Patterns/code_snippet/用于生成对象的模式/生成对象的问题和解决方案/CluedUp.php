<?php
declare(strict_types = 1);

namespace popp\ch09\batch02;

class CluedUp extends Employee
{
    public function fire()
    {
        print "{$this->name}: I'll call my lawyer\n";
    }
}
