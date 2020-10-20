<?php
declare(strict_types=1);

namespace popp\ch04\batch24;

class Runner
{
    public static function run()
    {

        $person = new Person();
        $person->output(
            // 随着PHP7的到来，除了可以声明匿名函数外，还可以声明匿名类。
            // 当需要从很小的类中创建和继承实例，特别是当这个类很简单且特定于局部上下文时，匿名类非常有用。
            // 可以使用new class关键字声明一个匿名类。
            // 在定义类体之前，可以根据需要加上extends或是implements子句
            // 匿名类不支持闭包。
            // 换言之，不能在匿名类内部访问访问那些声明在外部作用域中的变量。
            // 不过，可以将变量传递给匿名类的构造方法。
            new class implements PersonWriter {
                public function write(Person $person)
                {
                    print $person->getName(). " " . $person->getAge() . "\n";
                }
            }
        );
    }

    public static function run2()
    {

        $person = new Person();
        $person->output(
            // 给构造方法传递了一个路径参数，
            // 这个参数会保存在$path属性中
            new class("/tmp/persondump") implements PersonWriter {
                private $path;

                public function __construct(string $path)
                {
                    $this->path = $path;
                }

                public function write(Person $person)
                {
                    file_put_contents($this->path, $person->getName(). " " . $person->getAge() . "\n");
                }
            }
        );
    }
}
// done
