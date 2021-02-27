<?php
declare(strict_types = 1);

namespace popp\ch11\batch12;

use popp\ch11\batch08\Unit;

/**
 * 如何用空对象模式帮助我们省去检查对象是否为空的麻烦。
 *
 * 空对象模式允许我们将"什么都不做"这件事委托给一个已知类型的类。
 *
 * Class NullUnit
 *
 * @package popp\ch11\batch12
 */
class NullUnit extends Unit
{
    public function bombardStrength(): int
    {
        return 0;
    }

    public function getHealth(): int
    {
        return 0;
    }

    public function getDepth(): int
    {
        return 0;
    }

    public function isNull(): bool
    {
        return true;
    }

}

