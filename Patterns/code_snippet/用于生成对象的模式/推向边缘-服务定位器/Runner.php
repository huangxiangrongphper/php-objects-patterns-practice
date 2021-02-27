<?php
declare(strict_types = 1);

namespace popp\ch09\batch13;

class Runner
{
    public static function run()
    {
        // 现在我们可以在脚本中得到并使用CommsManager对象了，
        // 而不必关心它到底是CommsManager类的哪个具体实现类，
        // 以及这个具体实现类会生成哪个具体类。
        $commsMgr = AppConfig::getInstance()->getCommsManager();
        print $commsMgr->getApptEncoder()->encode();
    }
}
