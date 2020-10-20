<?php
declare(strict_types=1);

namespace popp\ch04\batch24;

class Person
{
    // 使用了PersonWriter 对象
    // 将当前类的实例传递给PersonWriter实例的write()方法
    // 这样就实现了Person类与writer解耦
    public function output(PersonWriter $writer)
    {
        $writer->write($this);
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
//done
