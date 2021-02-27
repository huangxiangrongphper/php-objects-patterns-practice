<?php
declare(strict_types = 1);

namespace popp\ch09\batch14;

use popp\ch09\batch06\BloggsApptEncoder;

/**
 *  无论在哪里使用new运算符，我们都会在那个作用域内封锁使用多态的可能性。
 *
 *  以下代码无法允许我们在运行时切换使用其他ApptEncoder实现类，而且使得该类变得更加难以测试。
 *
 *  就算使用了原型模式或抽象工厂模式，还是必须在某个地方进行实例化。
 *
 * Class AppointmentMaker
 *
 * @package popp\ch09\batch14
 */
class AppointmentMaker
{
    public function makeAppointment()
    {
        $encoder = new BloggsApptEncoder();
        return $encoder->encode();
    }
}
