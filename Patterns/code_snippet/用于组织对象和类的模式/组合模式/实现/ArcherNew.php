<?php
declare(strict_types = 1);

namespace popp\ch10\batch04;

class ArcherNew extends UnitNew
{
    // 虽然这样移除了叶子类中的重复代码，但缺点是不再要求组合对象必须在编译时实现addUnit()
    // 和removeUnit()，这可能会带来问题。
    public function bombardStrength(): int
    {
        return 4;
    }
}

