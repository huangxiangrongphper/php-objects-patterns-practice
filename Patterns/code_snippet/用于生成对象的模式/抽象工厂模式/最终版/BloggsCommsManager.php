<?php
declare(strict_types = 1);

namespace popp\ch09\batch10;

class BloggsCommsManager extends CommsManager
{
    public function getHeaderText(): string
    {
        return "BloggsCal header\n";
    }

    // 用make()方法创建对象时，必须记住让所有的具体创建者都要支持创建所有的产品对象。
    // 同时，这么做还引入了重复的条件语句，因为每个具体创建者都必须对标志位参数进行相同的检查。
    // 客户端代码无法确定具体创建者会生成所有的产品，
    // 因为这些具体创建者可以自行决定make()方法内部的实现。

    // 另一方面，创建者变得更加灵活。
    public function make(int $flag_int): Encoder
    {
        switch ($flag_int) {
            case self::APPT:
                return new BloggsApptEncoder();
            case self::CONTACT:
                return new BloggsContactEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
        }
    }

    public function getFooterText(): string
    {
        return "BloggsCal footer\n";
    }
}
