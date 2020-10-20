<?php
declare(strict_types=1);

namespace popp\ch04\batch15;

use popp\ch04\batch18\PersonTwo;

class Runner
{
    public static function run()
    {
        // runner code here

        $p = new Person();
        if (isset($p->name)) {
            print $p->name;
        } else {
            print "nope\n";
        }
        // output:
        // Bob
    }

    public static function run1()
    {
        // runner code here

        $p = new Person();
        $p->name = "bob";
        $p->age  = 44;
        print_r($p);
    }

    public static function run2()
    {
        // runner code here
        // 现在Person类神奇的拥有两个新方法了。
        // 尽管自动委托可以减少我们的工作量，但代码会变得不够清晰。
        // 如果过于依赖委托，程序将变得具有动态接口，无法被反射（运行时的类检查），
        // 而且客户端程序员也无法一下子理清头绪。
        // 这是因为委托类与目标之间的交互逻辑可能会被隐藏在__call()等方法中，
        // 而不像继承关系或方法中的类型提示那样明显。
        $person= new PersonTwo(new PersonWriter());
        $person->writeName();
        $person->writeAge();
    }

    public static function run4()
    {
        /*
        $address = new Address("441b Bakers Street");
        print_r($address);
        print "street address: {$address->streetaddress}\n";
        $address = new Address("15", "Albert Mews");
        print "street address: {$address->streetaddress}\n";
        $address->streetaddress = "34, West 24th Avenue";
        //print "street address: {$address->streetaddress}\n";
        //$address->streetaddress = "failme";
        */

        $address = new Address("441b Bakers Street");
        print "street address: {$address->streetaddress}\n";
        $address = new Address("15", "Albert Mews");
        print "street address: {$address->streetaddress}\n";
        $address->streetaddress = "34, West 24th Avenue";
        print "street address: {$address->streetaddress}\n";

    }
}
