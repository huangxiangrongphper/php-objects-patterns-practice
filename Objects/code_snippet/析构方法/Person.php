<?php
declare(strict_types=1);

namespace popp\ch04\batch19;

/**
 * PHP 5 还引入了__destruct()方法
 * 这个方法会在对象被垃圾回收前，即从内存中抹去前被调用。
 * 可以利用这个方法执行必要的清理工作。
 *
 * Class Person
 *
 * @package popp\ch04\batch19
 */
class Person
{
    protected $name;
    private   $age;
    private   $id;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age  = $age;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    // 将自己的数据保存到数据库中，那么可以使用__destruct()方法，
    // 确保这个对象被删除前一定能将自己的数据保存到数据库中。
    // 只要内存中删除了Person对象，__destruct就会被调用。
    // 这种情况会在对对象调用unset()函数时，或在进程中没有引用指向对象时发生。
    public function __destruct()
    {
        if (! empty($this->id)) {
            // save Person data
            print "saving person\n";
        }
    }
}
