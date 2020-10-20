<?php
declare(strict_types=1);

namespace popp\ch04\batch05;

// 继承一个父类的同时实现多个接口（PHP只支持单一继承）
// 对于实现的每个接口都有相应的类型
class Consultancy extends TimedService implements Bookable, Chargeable
{
    // ...
    public function getPrice(): float
    {
        return 5.5;
    }
}
