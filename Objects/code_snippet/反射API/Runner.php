<?php
declare(strict_types=1);

namespace popp\ch05\batch07;

use popp\ch04\batch02\BookProduct;
use popp\ch04\batch02\CdProduct;

/**
 * 反射API不仅可以检查类
 *
 *                              反射API中的部分类
 *
 *  类
 * Reflection                      提供一个静态的export()方法，以输出类的摘要信息
 * ReflectionClass                 类信息和工具
 * ReflectionMethod                类方法和工具
 * ReflectionParameter             方法参数信息
 * ReflectionProperty              类属性信息
 * ReflectionFunction              函数信息和工具
 * ReflectionExtension             PHP扩展信息
 * ReflectionException             错误类
 * ReflectionZendExtension         PHP Zend扩展信息
 *
 * 可以通过反射API生成类图或文档，将对象信息保存到数据库中或通过检查对象中的访问方法（getter和setter）提出字段名。
 * 反射API的另一种用途是，构建一个能够根据命名规则调用模块中的方法的框架。
 *
 *
 * Class Runner
 *
 * @package popp\ch05\batch07
 */
class Runner
{
    public static function run()
    {
        $d = new Delegator();
        $d->andAnotherThing("a", "b");
    }
    public static function run2()
    {
        // 反射API包含用于分析属性、方法和类的内置类。
        // ReflectionClass 类为我们提供了检查给定类（包括用户定义的类和PHP的内置类）的所有信息的方法。
        // ReflectionClass的构造方法接收一个类或接口名（或一个对象实例）作为其唯一参数。
        // Reflection 的静态方法export()可以格式化输出Reflection对象（也就是说，实现Reflecttor接口的类的任何实例）所管理的数据。
        $prodclass = new \ReflectionClass('popp\\ch04\\batch02\\CdProduct');
        \Reflection::export($prodclass);
    }

    public static function run3()
    {
        // var_dump()是用于输出数据的通用工具，输出信息前必须先实例化对象。
        // 即便如此，var_dump()提供的信息的详细程度仍然无法与Reflection::export()相媲美。
        // var_dump()及其姊妹函数print_r()是查看脚本中数据的利器。但对于类和函数，反射API提供了更高层次的功能。
        $cd = new CdProduct("cd1", "bob", "bobbleson", 4, 50);
        var_dump($cd);
    }

    public static function run4()
    {
        $prodclass = new \ReflectionClass('popp\\ch04\\batch02\\CdProduct');
        print ClassInfo::getData($prodclass);
    }

    public static function run5()
    {
        print ReflectionUtil::getClassSource(
            new \ReflectionClass('popp\\ch04\\batch02\\CdProduct')
        );

        print ReflectionUtil::getClassSource(
            new \ReflectionClass('\popp\ch05\batch07\Runner')
        );
    }

    public static function run6()
    {
        // 可以通过两种方式得到ReflectionMethod对象。
        // 第一种方式是通过ReflectionClass::getMethods()得到一个ReflectionMethod对象的数组；
        // 第二种方式是调用一个特殊的ReflectionClass::getMethod()方法，它接收一个方法名作为参数并返回相应的ReflectionMethod对象。
        $prodclass = new \ReflectionClass('popp\\ch04\\batch02\\CdProduct');
        // 获取对象中的所有方法  ReflectionMethod对象的数组
        $methods = $prodclass->getMethods();

        foreach ($methods as $method) {
            print ClassInfo::methodData($method);
            print "\n----\n";
        }
    }

    public static function run7()
    {
        $class = new \ReflectionClass('popp\\ch04\\batch02\\CdProduct');
        $method = $class->getMethod('getSummaryLine');
        print ReflectionUtil::getMethodSource($method);
    }

    public static function run8()
    {
        $class = new \ReflectionClass('popp\\ch04\\batch02\\CdProduct');

        $method = $class->getMethod("__construct");
        // 返回包含ReflectionParameter对象的数组。
        // ReflectionParameter不仅可以表明参数名极变量是否引用传递（即方法声明前是否有&符号），
        // 还可以表明参数提示所需求的类型，以及方法是否接收一个null值参数。
        $params = $method->getParameters();

        foreach ($params as $param) {
            print ClassInfo::argData($param) . "\n";
        }
    }

    public static function run9()
    {
        $test = new ModuleRunner();
        $test->init();
    }
}
