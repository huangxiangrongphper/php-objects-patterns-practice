<?php
declare(strict_types=1);
namespace popp\ch08\batch01;

use popp\ch08\batch02\CostStrategy;

/**
 *   使用策略模式来解决以上问题
 *
 *   策略模式用于将一组算法移到一个独立的类型中。
 *
 *
 * @package popp\ch08\batch01
 */
abstract class Lesson
{
    private $duration;
    private   $costStrategy;

    public function __construct(int $duration, CostStrategy $strategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }


    public function cost(): int
    {
        // 这种显示调用另一个对象的方法来执行请求的方式称为委托。
        // costStrategy对象就是Lesson的委托
        // Lesson 类不再负责计算费用，它将这个任务交给了costStrategy的实现类。
        return $this->costStrategy->cost($this);
    }

    public function chargeType(): string
    {
        return $this->costStrategy->chargeType();
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    // more lesson methods...
}
