<?php
declare(strict_types=1);

namespace popp\ch04\batch09;

class Runner
{
    public static function run()
    {
        $conf = new Conf(__DIR__."/conf01.xml");
        print "user: ".$conf->get('user')."\n";
        print "host: ".$conf->get('host')."\n";
        $conf->set("pass", "newpass2");
        $conf->write();
    }

    public static function run1()
    {

        try {
            $conf = new ConfException(__DIR__ . "/conf01.xml");
            //$conf = new Conf( __DIR__ . "/conf.unwriteable.xml" );
            //$conf = new Conf( "nonexistent/not_there.xml" );
            print "user: " . $conf->get('user') . "\n";
            print "host: " . $conf->get('host') . "\n";
            $conf->set("pass", "newpass");
            $conf->write();
            // catch子句类似于方法声明。当异常被抛出后，调用作用域内的catch子句会被调用。
            // Exception对象会作为参数变量自动传递给catch字句。
        } catch (\Exception $e) {
            die($e->__toString());
        }

    }
}
