<?php
declare(strict_types = 1);

namespace popp\ch09\batch07;

class Runner
{
    public static function run()
    {
        $man = new CommsManagerNew(CommsManagerNew::MEGA);
        // get_class — 返回对象的类名
        print (get_class($man->getApptEncoder())) . "\n";
        $man = new CommsManagerNew(CommsManagerNew::BLOGGS);
        print (get_class($man->getApptEncoder())) . "\n";
    }

    public static function run2()
    {
        $man = new CommsManagerNew(CommsManagerNew::MEGA);
        print $man->getHeaderText();
        $man = new CommsManagerNew(CommsManagerNew::BLOGGS);
        print $man->getHeaderText();
    }
}
