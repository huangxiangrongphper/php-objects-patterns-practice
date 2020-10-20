<?php
declare(strict_types=1);

namespace popp\ch04\batch05;

// 实现这个接口的类要么实现这个接口定义的所有方法，否则这个类就只能被申明为抽象类
interface Chargeable
{
    public function getPrice(): float;
}
