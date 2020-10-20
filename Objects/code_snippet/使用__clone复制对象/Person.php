<?php
declare(strict_types=1);

namespace popp\ch04\batch20;

/**
 * 在PHP中，对象的赋值和传递都是通过引用进行的，PHP以上的版本。
 *
 * clone使用值复制的方式生成一个新的对象实例。
 *
 * Class Person
 *
 * @package popp\ch04\batch20
 */
class Person
{
    private $name;
    private $age;
    private $id;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    // 浅复制的副本，将复制出的对象$id属性都设置为0
    // __clone()在对象副本之上运行，而不是原始对象之上。
    // 这里将复制出的对象的$id属性都设置为0
    public function __clone()
    {
        $this->id = 0;
    }
}

