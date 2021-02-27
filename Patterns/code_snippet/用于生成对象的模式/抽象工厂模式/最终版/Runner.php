<?php
declare(strict_types = 1);

namespace popp\ch09\batch10;

class Runner
{
    // 将工厂方法模式与抽象工厂模式相结合，
    // 从而创建了可以实例化相关对象集的创建者类。
    public static function run()
    {
        $mgr = new BloggsCommsManager();
        print $mgr->getHeaderText();
        print $mgr->make(CommsManager::APPT)->encode();
        print $mgr->getFooterText();
    }
}
