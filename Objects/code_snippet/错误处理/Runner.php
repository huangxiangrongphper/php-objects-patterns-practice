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

    public static function run2()
    {
        Runner::init2();
    }

    public static function init2()
    {
        try {
            $conf = new Conf(__DIR__ . "/conf.broken.xml");
            print "user: " . $conf->get('user') . "\n";
            print "host: " . $conf->get('host') . "\n";
            $conf->set("pass", "newpass");
            $conf->write();

        // 由于第一个匹配到的catch子句会被执行，将最通用类型的catch
        // 子句放在最后，将最特化类型的子句放在最前面
        // 如果将用于捕获Exception的catch子句放在了捕捉XmlException和ConfException的子句前面，
        // 那么这两个子句永远不会被调用。这是因为这两个类都属于Exception类型，
        // 它们会匹配第一个catch子句。
        } catch (FileException $e) {
            // permissions issue or non-existent file
            // 显示的再次抛出异常
            // 如果客户端代码没有捕获到异常会怎么样呢？
            // 异常会被隐式地再次抛出，调用客户端代码的代码会有优先
            // 捕捉异常的权利。这个处理会一直继续下去，直至异常被捕捉到或不再被抛出时，
            // 程序就会发生致命错误。
            throw $e;
        } catch (XmlException $e) {
            // broken xml
        } catch (ConfException $e) {
            // wrong kind of XML file
        } catch (\Exception $e) {
            // backstop: should not be called
        }
    }

    public static function run3()
    {
        Runner::init3();
    }

    // 使用finally完成清理工作
    public static function init3()
    {
        $fh = fopen(__DIR__ . "/log.txt", "w");
        try {
            fputs($fh, "start\n");
            $conf = new Conf(dirname(__FILE__) . "/conf.not-there.xml");
            print "user: " . $conf->get('user') . "\n";
            print "host: " . $conf->get('host') . "\n";
            $conf->set("pass", "newpass");
            $conf->write();
        } catch (FileException $e) {
            // permissions issue or non-existent file
            fputs($fh, "file exception\n");
            //throw $e;
        } catch (XmlException $e) {
            fputs($fh, "xml exception\n");
            // broken xml
        } catch (ConfException $e) {
            fputs($fh, "conf exception\n");
            // wrong kind of XML file
        } catch (\Exception $e) {
            fputs($fh, "general exception\n");
            // backstop: should not be called
            // PHP5.5引入了一个新的子句finally
            // finally子句总是会执行，无论try语句中是否重新抛出了异常
            // 无论是catch子句是重新抛出异常还是返回一个值，finally子句都会执行。
            // 但如果在try或catch代码块中调用了die()或exit()，那么程序就会终止，
            // finally子句也就不会执行了。
        } finally {
            fputs($fh, "end\n");
            fclose($fh);
        }
    }
}
