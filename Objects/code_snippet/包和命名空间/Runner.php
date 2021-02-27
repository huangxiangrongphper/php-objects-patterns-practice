<?php
declare(strict_types=1);


namespace popp\ch05\batch04;


use popp\ch05\batch04\util\InSame;
use popp\ch05\batch04\client\FromClient;
use popp\ch05\batch04\util as util;
use popp\ch05\batch04\util\Debug;
use popp\ch05\batch04\util\Lister;

// need to include this non-namespace
require_once(__DIR__."/Lister.php");

// cause name clash
//use popp\ch05\batch04\Debug;

// cure name clash with alias
// 显示地为命名空间中的类起一个别名，防止类名冲突错误
use popp\ch05\batch04\Debug as coreDebug;

class Runner
{
    public static function runbefore()
    {
        \popp\ch05\batch04\Debug::helloworld();
    }


    public static function run()
    {
        InSame::run();
    }

    public static function run2()
    {
        FromClient::run();
    }

    public static function run3()
    {
        util\Debug::helloWorld();
    }

    public static function run4()
    {

        Debug::helloWorld();
    }

    public static function run5()
    {
        coreDebug::helloWorld();
    }

    public static function run6()
    {
        coreDebug::helloWorld();
    }

    public static function run7()
    {
        // 局部访问
        Lister::helloWorld();  // access local
        // 全局访问 带反斜杠的限定名访问全局空间中的Lister类
        \Lister::helloWorld(); // access global
    }

    public static function run8()
    {
        require_once(__DIR__."/Autoload.php");
    }

    public static function run9()
    {
        require_once(__DIR__."/Autoload2.php");
    }

    public static function run10()
    {
        require_once(__DIR__."/Autoload3.php");
    }

    public static function run11()
    {
        require_once(__DIR__."/Autoload4.php");
    }

    public static function run12()
    {
        // 无论使用哪个版本的PHP，我们都应当用文件系统来组织类，以提供一种类似包的结构。
        // include()和require语句的唯一不同之处在于处理错误的方法。
        // 使用require()包含文件时，如果发生错误，那么整个处理就会停止。
        // 使用include()包含文件时，如果遇到了相同的错误，则只会给出警告并停止执行被包含的文件，
        // 然后继续执行其他代码。
        // 在引用库文件时，require()和require_once()更加安全，
        // 但在进行模板加载等操作时，include()和include_once()更加试用。
        // require()和require_once()是语句，而非函数。这表明使用它们时可以省略括号。
        // Nautilus 是Linux系统中的文件管理器
        // require_once()这个函数只在目标文件没有被包含的情况下才能包含它。
        // 这种只包含一次的方式在访问库代码时特别有用，因为它能够预防重复定义类和函数的问题。
        // 如果想要尽量减少系统的运行时间，哪怕是一毫秒，那么可以考虑使用require()。这是一种经常遇到的情况，
        // 我们需要权衡效率与便利性。

        //PEAR是PHP Extension and Application Repository（PHP扩展和应用程序库）。
        //它是PHP官方维护的软件包集合，也是增强PHP功能的工具。
        //PEAR核心包默认随着PHP绑定发布，其他的非核心包则可以用命令行工具来安装。
        //可以在https://pear.php.net上找到各种PEAR包。

        // 通过结合使用包含路径、命名空间、自动加载以及文件系统，可以灵活地组织类。
    }

    public static function run13()
    {
        // 通过在include_path中添加包所在的文件夹，直接在require()语句中引用包和文件即可。
        // require_once("business/User.php");

        // 对于PHP的服务器模块，重启服务器才能使修改生效。

        // 向当前的包含路径中添加文件夹。
        // set_include_path(get_include_path() . PATH_SEPARATOR . "/home/john/phplib/");
        // PATH_SEPARATOR 常量在Unix系统上会解析为冒号，在Windows平台上则会解析为分号。
        // 因此，从可移植的角度来看，这段代码是最佳实践。
    }
}
