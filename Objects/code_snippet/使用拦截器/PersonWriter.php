<?php
declare(strict_types=1);

namespace popp\ch04\batch18;

class PersonWriter
{

    public function writeName(PersonTwo $p)
    {
        print $p->getName() . "\n";
    }

    public function writeAge(PersonTwo $p)
    {
        print $p->getAge() . "\n";
    }
}
