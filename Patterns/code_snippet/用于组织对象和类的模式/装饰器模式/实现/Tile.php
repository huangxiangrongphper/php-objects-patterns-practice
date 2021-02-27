<?php
declare(strict_types = 1);

namespace popp\ch10\batch06;

/**
 * 装饰器（Decorator）模式：一种通过在运行时组合对象来扩展功能的灵活机制。
 *
 * 装饰器模式则可以通过一种类似组合模式的结构帮助我们修改具体组件的功能。
 *
 * 装饰器模式同样体现了在运行时组合对象的重要性。继承是沿用父类特性的一种简单方法，
 * 但是这种简单性会诱惑我们将变化硬编码到继承层次中，从而导致类结构不够灵活。
 *
 * 继承是沿用父类特性的一种简单方法，但是这种简单性会诱惑我们将变化硬编码到继承层次中，
 * 从而导致类结构不够灵活。
 *
 * Class Tile
 *
 * @package popp\ch10\batch06
 */
abstract class Tile
{
    abstract public function getWealthFactor(): int;
}

