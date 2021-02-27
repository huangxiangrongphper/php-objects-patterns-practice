<?php
declare(strict_types = 1);

namespace popp\ch11\batch08;

class Runner
{
    public static function run()
    {
        // Army是一个组合对象
        $main_army = new Army();
        $main_army->addUnit(new Archer());
        $main_army->addUnit(new LaserCanonUnit());
        $main_army->addUnit(new Cavalry());

        $textdump = new TextDumpArmyVisitor();
        $main_army->accept($textdump);
        print $textdump->getText();

    }

    public static function run2()
    {

        $main_army = new Army();
        $main_army->addUnit(new Archer());
        $main_army->addUnit(new LaserCanonUnit());
        $main_army->addUnit(new Cavalry());

        $taxcollector = new TaxCollectionVisitor();
        // Army对象并不知道它自己的访问者所执行的操作，
        // 它们只是简单地使用访问者的接口，
        // 并以它们自身为参数，
        // 根据访问者的类型调用对应的方法。
        $main_army->accept($taxcollector);
        print $taxcollector->getReport();
        print "TOTAL: ";
        print $taxcollector->getTax() . "\n";

    }
}
