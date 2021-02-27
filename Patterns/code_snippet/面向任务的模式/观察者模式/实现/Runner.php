<?php
declare(strict_types = 1);

namespace popp\ch11\batch05;

class Runner
{
    public static function run()
    {
        $login = new Login();

        // 现在，实例化LoginObserver对象的同时可以完成"创建LoginObserver对象"
        // 以及"将LoginObServer对象添加到Login对象中"这两件事情。
        new SecurityMonitor($login);
        new GeneralLogger($login);

        $pt = new PartnershipTool($login);
        $login->detach($pt);

        for ($x = 0; $x < 10; $x++) {
            $login->handleLogin("bob", "mypass", '158.152.55.35');
            print "\n";
        }
    }

    public static function run2()
    {
        $login = new Login();
        $la = new LoginAnalytics();
        $login->attach($la);

        for ($x = 0; $x < 10; $x++) {
            $login->handleLogin("bob", "mypass", '158.152.55.35');
            print "\n";
        }
    }
}
