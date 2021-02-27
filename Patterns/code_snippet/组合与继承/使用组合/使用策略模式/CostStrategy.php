<?php
declare(strict_types=1);
namespace popp\ch08\batch01;

/**
 * 能够很方便地通过继承CostStrategy来添加新的计费算法，而无须对Lesson类进行任何修改。
 * Class CostStrategy
 *
 * @package popp\ch08\batch01
 */
abstract class CostStrategy
{
    abstract public function cost(Lesson $lesson): int;
    abstract public function chargeType(Lesson $lesson): string;
}
