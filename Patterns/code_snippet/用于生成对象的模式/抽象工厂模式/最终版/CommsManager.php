<?php
declare(strict_types = 1);

namespace popp\ch09\batch10;

/**
 * 首先，我们解除了系统与实现细节间的耦合。我们可以在示例程序中添加或移除任意数量的编码类型，而不会对系统造成任何影响。
 * 我们组合了系统中功能相关的元素。因此，BloggsCommsManager可以确保只使用与BloggsCal格式相关的类。
 * 添加新产品会非常痛苦，这是因为我们不仅需要创建新产品的实现类，还需要修改抽象创建者及其所有的实现类来支持这个新产品。
 *
 *
 *
 * Class CommsManager
 *
 * @package popp\ch09\batch10
 *
 */
abstract class CommsManager
{
    const APPT    = 1;
    const TTD     = 2;
    const CONTACT = 3;
    abstract public function getHeaderText(): string;
    // 编写一个make()方法，使其根据接收到的标志位参数决定返回哪个对象，
    // 而不用在工厂方法中为每个产品都编写一个独立的生成产品的方法。
    abstract public function make(int $flag_int): Encoder;
    abstract public function getFooterText(): string;
}
