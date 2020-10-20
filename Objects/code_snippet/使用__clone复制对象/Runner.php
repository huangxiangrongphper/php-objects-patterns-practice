<?php
declare(strict_types=1);

namespace popp\ch04\batch20;

class Runner
{
    public static function run()
    {
        // runner code here

        $person = new Person("bob", 44);
        $person->setId(343);
        $person2 = clone $person;

        print_r($person);
        print_r($person2);
    }

    public static function run2()
    {
        // runner code here

        $person = new Person("bob", 44);
        $person->setId(343);
        $person2 = clone $person;
        print_r($person);
        print_r($person2);
    }

    public static function run3()
    {
        $person = new Person("bob", 44, new Account(200));
        $person->setId(343);
        $person2 = clone $person;

        // give $person some money
        $person->account->balance += 10;
        // $person2 sees the credit too
        // 将持有一个与$person指向同一个Account对象的引用。
        // 通过在$person对象的Account中增加余额，并在$person中得到确认，便可以证明这一点。
        print $person2->account->balance;

        // output:
        // 210
    }
}
//done
