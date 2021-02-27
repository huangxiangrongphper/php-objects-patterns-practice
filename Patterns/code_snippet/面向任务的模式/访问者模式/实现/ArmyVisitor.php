<?php
declare(strict_types = 1);

namespace popp\ch11\batch08;

// 访问者类会为类层次中的每个具体类分别定义一个accept()方法。
abstract class ArmyVisitor
{
    // 如果ArmyVisitor的实现类没有为特定的Unit类实现特殊处理，
    // 那么这个默认的visit()方法将被调用。
    abstract public function visit(Unit $node);

    public function visitArcher(Archer $node)
    {
        $this->visit($node);
    }
    public function visitCavalry(Cavalry $node)
    {
        $this->visit($node);
    }

    public function visitLaserCanonUnit(LaserCanonUnit $node)
    {
        $this->visit($node);
    }

    public function visitTroopCarrierUnit(TroopCarrierUnit $node)
    {
        $this->visit($node);
    }

    public function visitArmy(Army $node)
    {
        $this->visit($node);
    }
}
