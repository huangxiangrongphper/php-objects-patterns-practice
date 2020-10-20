<?php
declare(strict_types=1);

namespace popp\ch04\batch18;

class PersonTwo
{
    private $writer;

    public function __construct(PersonWriter $writer)
    {
        $this->writer = $writer;
    }

    // __call方法可能是所有拦截器方法中最有用的了。当客户端代码调用一个未定义的方法时，
    // __call方法就会被调用。它接收两个参数：一个方法名以及一个保存了客户端调用方法时传递的所有参数的数组。
    // __call方法非常适合于委托。委托是指一个对象将方法调用传递给另外一个对象的机制。
    // 这与继承中的子类将方法调用传递给父类的实现类似。
    // 但使用继承的话，子类和父类的关系就固定了。
    // 委托拥有在运行时切换接受到的对象的能力，因此它比继承更灵活。
    // 将方法调用委托给PersonWriter对象
    //
    public function __call(string $method, array $args)
    {
        if (method_exists($this->writer, $method)) {
            return $this->writer->$method($this);
        }
    }

    public function getName(): string
    {
        return "Bob";
    }
    public function getAge(): int
    {
        return 44;
    }
}
