<?php
declare(strict_types = 1);

namespace popp\ch10\batch05;

class UnitScript
{
    // 第一个Unit对象表示来到单元格上的新队伍，第二个则是之前占领单元格的队伍。、
    // 设计getComposite()和addUnit()这样的方法时，我们需要根据业务逻辑做出假设。
    public static function joinExisting(Unit $newUnit, Unit $occupyingUnit): CompositeUnit
    {
        $comp = $occupyingUnit->getComposite();
        if (! is_null($comp)) {
            $comp->addUnit($newUnit);
        } else {
            $comp = new Army();
            $comp->addUnit($occupyingUnit);
            $comp->addUnit($newUnit);
        }
        return $comp;
    }
}

