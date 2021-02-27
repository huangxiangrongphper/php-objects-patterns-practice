<?php
declare(strict_types = 1);

namespace popp\ch09\batch08;

class Runner
{
    public static function run()
    {
        $mgr = new BloggsCommsManager();
        print $mgr->getHeaderText();
        print $mgr->getApptEncoder()->encode();
        print $mgr->getFooterText();
    }
}
