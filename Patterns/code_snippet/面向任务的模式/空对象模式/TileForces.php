<?php
declare(strict_types = 1);

namespace popp\ch11\batch10;

/**
 *
 * 空对象（Null Object）模式：用无操作的对象代替空值。
 *
 * 程序员所面临的问题中，半数似乎都与类型有关。
 * 如果说处理类型错误的变量是一个问题，那么处理不属于任何类型的变量也是一个同样糟糕的问题。
 * 而且这种问题一直都在发生，因为许多函数在无法生成有实际意义的值时都会返回null。
 * 我们可以通过在项目中应用空对象模式来避免给自己或他人带来此问题。
 * 空对象模式是帮助我们尽可能优雅地不执行任务。
 *
 * Class TileForces
 *
 * @package popp\ch11\batch10
 */
class TileForces
{
    private $x;
    private $y;
    private $units = [];

    public function __construct(int $x, int $y, UnitAcquisition $acq)
    {
        $this->x = $x;
        $this->y = $y;
        $this->units = $acq->getUnits($this->x, $this->y);
    }

    // ...

    // TileForces

    // 有了Unit对象的数组后，我们就可以在TileForces中实现一些功能了。
    public function firepower(): int
    {
        $power = 0;

        foreach ($this->units as $unit) {
            // this conditional is added to prevent deliberate
            // mistake shown in book copy
            if (! is_null($unit)) {
               $power += $unit->bombardStrength();
            }
        }

        return $power;
    }

    public function health(): int
    {
        $health = 0;

        foreach ($this->units as $unit) {
            // this conditional is added to prevent deliberate
            // mistake shown in book copy

            // 一旦我们开始在多个地方复制is_null类型检查，
            // 代码中就会产生坏的代码异味。
            // 通常来说，消除客户端重复代码的方法是用多态替代条件语句。
            if (! is_null($unit)) {
            $health += $unit->getHealth();
            }
        }

        return $health;
    }

}

