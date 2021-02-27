<?php
declare(strict_types=1);

namespace popp\ch05\batch05;

use popp\ch05\batch05\util as u;
use popp\ch05\batch05\util\db\Querier as q;
use popp\ch04\batch02\BookProduct;

class Runner
{

    public static function runbefore()
    {
        // 使用字符串动态的引用类
        $classname = "Task";
        require_once("tasks/{$classname}.php");
        $classname = "tasks\\$classname";
        $myObj = new $classname();
        $myObj->doSpeak();
    }

    public static function run()
    {
        $base = __DIR__;
        $classname = "Task";
        $path = "{$base}/tasks/{$classname}.php";
        if (! file_exists($path)) {
            throw new \Exception("No such file as {$path}");
        }
        require_once($path);
        $qclassname = "tasks\\$classname";
        // class_exists 返回true或false
        if (! class_exists($qclassname)) {
            throw new \Exception("No such class as $qclassname");
        }
        $myObj = new $qclassname();
        $myObj->doSpeak();

        // get_declared_classes()函数得到脚本进程中定义的所有类的数组。
        // 列出所有用户定义的类和PHP内置类。只会返回调用该函数时已经声明的类。
        // 后面可能还会执行require()或require_once(), 因此脚本中的类的数量还会增加。
    }

    public static function getProduct()
    {
        return new CdProduct(
            "Exile on Coldharbour Lane",
            "The",
            "Alabama 3",
            10.99,
            60.33
        );
    }

    public static function getBookProduct()
    {
        return new BookProduct(
            "Catch 22",
            "Joseph",
            "Heller",
            11.99,
            300
        );
    }

    public static function run2()
    {

        $product = self::getProduct();
        // 接受一个对象作为参数，并返回类名字符串 返回的是具体的类
        if (get_class($product) === 'popp\ch05\batch05\CdProduct') {
            print "\$product is a CdProduct object\n";
        }

        $product = self::getProduct();
        // instanceof 判断对象的通用类型
        // 比如，可能想知道一个对象是否属于ShopProduct，但不关心到底是BookProduct还是CdProduct
        // instanceof 运算符需要两个运算子，关键字的左边是要检查的对象，右边是类名或接口名。
        if ($product instanceof \popp\ch05\batch05\CdProduct) {
            print "\$product is an instance of CdProduct\n";
        }

    }

    public static function run3()
    {
        //PHP5.5 ClassName::class 用来解决类路径以得到完全限定的类名
        // 给定一个类引用后，就可以通过作用域解析运算符和class关键字来获取完全限定的类名。
        // 命名空间别名
        print u\Writer::class."\n";

        // 类别名
        print q::class."\n";

        // 局部上下文中的类引用
        print Local::class."\n";

        // 输出
        // util\Writer
        // util\db\Querier
        // mypackage\Local
    }

    public static function run4()
    {
        // 传递一个对象给get_class_methods()也可以得到相同的结果。
        // 返回的列表包含所有public方法的名字。
        print_r(get_class_methods('\\popp\\ch04\\batch02\\BookProduct'));
    }

    public static function run5()
    {
        $product = self::getProduct();
        $method = "getTitle";   // define a method name
        print $product->$method(); // invoke the method

        // 检查方法是否可用，方法一
        if (in_array($method, get_class_methods($product))) {
            print $product->$method(); // invoke the method
        }

        // 检查方法是否可用，方法二
        // 需要一个数组作为参数
        // 第一个元素是一个对象或类名，第二个元素是要检查的方法的名字
        // 如果方法存在于类中且可以被调用，那么is_callable()函数会返回true
        // is_callable()的第二个参数是一个可选的Boolean值。
        // 如果将其设置为true，那么函数只会检查方法名或函数名的语法是否合法，但不会检查它们实际是否存在。
        if (is_callable(array( $product, $method))) {
            print $product->$method(); // invoke the method
        }

        // 检查方法是否可用，方法三
        // method_exists() 函数接收一个对象（或一个类名）和一个方法名作为参数，如果给定的方法存在于对象的类中，则返回true。
        // 方法存在并不意味着它是可调用的。不仅仅是对public方法，对于private方法和protected方法，method_exists()也会返回true
        if (method_exists($product, $method)) {
            print $product->$method(); // invoke the method
        }

        // 返回类中的public属性
        print_r(get_class_vars('\\popp\\ch05\\batch05\\CdProduct'));

        // 检查继承关系 如果找到父类，返回父类的名称；如果没有找到，那么会返回false
        print get_parent_class('\\popp\\ch04\\batch02\\BookProduct');

        $product = self::getBookProduct(); // acquire an object
        // is_subclass_of 检查一个类是否为另一个类的子类
        // 接收一个子对象（或类名）和父类名作为参数。
        // is_subclass_of 无法表明类是否实现了接口
        // 要想知道这一点，可以使用instanceof 运算符
        if (is_subclass_of($product, '\\popp\\ch04\\batch02\\ShopProduct')) {
            print "BookProduct is a subclass of ShopProduct\n";
        }

        // 使用标准PHP库（SPL，Standard PHP Library）中的class_implements()函数。
        // 这个函数接收一个类名或对象引用作为参数，并返回一个包含接口名的数组。
        if (in_array('someInterface', class_implements($product))) {
            print "BookProduct is an interface of someInterface\n";
        }

        // call_user_func的用法
        // 调用函数：$returnVal = call_user_func("myFunction");
        $product = self::getBookProduct(); // Acquire a BookProduct object
        // 20 是目标方法所需的参数 参数不是引用传递的
        call_user_func([$product, 'setDiscount'], 20);
    }
}
