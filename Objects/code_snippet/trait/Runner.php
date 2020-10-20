<?php
declare(strict_types=1);

namespace popp\ch04\batch06;

class Runner
{
    public static function run()
    {
        print_r(Document::create());
    }

    public static function run2()
    {
        $p = new ShopProduct("Fine Soap", "", "Bob's Bathroom", 1.33);
        print $p->calculateTax(100) . "\n";
    }

    public static function run3()
    {
        $u = new UtilityService();
        print $u->calculateTax(100) . "\n";
    }

    public static function run4()
    {
        $p = new ShopProduct();
        print $p->calculateTax(100) . "\n";
        print $p->generateId() . "\n";
    }

    public static function storeIdentityObject(IdentityObject $idobj)
    {
        // do something with the IdentityObject
    }

    public static function run5()
    {
        $p = new ShopProduct();
        self::storeIdentityObject($p);
        print $p->calculateTax(100) . "\n";
        print $p->generateId() . "\n";
    }

    public static function run6()
    {
        // deliberate error averted!
        //$u = new UtilityService();
        //print $u->calculateTax(100) . "\n";
    }

    public static function run7()
    {
        $u = new UtilityService();
        print $u->calculateTax(100) . "\n";
    }

    public static function run8()
    {
        // 使用别名重写trait的方法
        $u = new UtilityService();
        print $u->calculateTax(100) . "\n";
        print $u->basicTax(100) . "\n";
    }

    public static function run9()
    {
        $u = new UtilityService();
        print $u::calculateTax(100) . "\n";
    }

    public static function run10()
    {
        $u = new UtilityService();
        print $u->calculateTax(100) . "\n";
    }

    public static function run11()
    {
        /*
        // yet another deliberate error!
                $u = new UtilityService(100);
                print $u->getFinalPrice() . "\n";
                print $u->calculateTax() . "\n";
        */
    }
}
