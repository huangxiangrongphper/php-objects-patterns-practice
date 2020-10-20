<?php
declare(strict_types=1);

namespace popp\ch04\batch22;

class Person
{
    public function getName(): string
    {
        return "Bob";
    }

    public function getAge(): int
    {
        return 44;
    }

    // 通过实现_toString()方法，可以控制打印对象时如何显式对象信息。
    // __toString 方法应该返回一个字符串值
    // 将对象传递给print方法或echo方法时，该对象的__toString()方法会被自动调用，
    // 其返回值会被打印出来。
    // __toString()方法对于记录日志、报告错误，以及主要用于传递消息的类特别有用。
    // 例如：Exception类会在__toString()方法中生成异常的摘要信息。
    public function __toString(): string
    {
        $desc  = $this->getName() . " (age ";
        $desc .= $this->getAge() . ")";
        return $desc;
    }
}
//done
