<?php
declare(strict_types=1);
namespace popp\ch08\batch01;

/**
 *  如何使用对象聚合获得比只使用继承更高的灵活性
 *  答案就在组合中。通过灵活地组合组件，我们能够在运行时定义软件组件。《设计模式》将这提炼为一条设计原则："组合优先于继承"。
 *  设计模式表明，相较于只使用继承树，在运行时组合对象能够实现更高的灵活性。
 * Class Lesson
 *
 * @package popp\ch08\batch01
 */
abstract class Lesson
{
    protected $duration;
    const     FIXED = 1;
    const     TIMED = 2;
    private   $costtype;

    public function __construct(int $duration, int $costtype = 1)
    {
        $this->duration = $duration;
        $this->costtype = $costtype;
    }

    // 在目前这个阶段，考虑在Lesson父类中用条件语句来移除重复代码。
    // 这与通常用多态条件替代条件语句的重构思想背道而驰。
    // 在父类的代码中使用条件语句是一种倒退。
    // 通常来说，我们应当用多态替代条件语句，这里却反其道而行。
    // 我们不得不在chargeType和cost()中编写重复条件语句。
    public function cost(): int
    {
        switch ($this->costtype) {
            case self::TIMED:
                return (5 * $this->duration);
                break;
            case self::FIXED:
                return 30;
                break;
            default:
                $this->costtype = self::FIXED;
                return 30;
        }
    }

    public function chargeType(): string
    {
        switch ($this->costtype) {
            case self::TIMED:
                return "hourly rate";
                break;
            case self::FIXED:
                return "fixed rate";
                break;
            default:
                $this->costtype = self::FIXED;
                return "fixed rate";
        }
    }

    // more lesson methods...
}
