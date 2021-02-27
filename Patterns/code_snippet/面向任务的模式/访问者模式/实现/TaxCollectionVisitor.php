<?php
declare(strict_types = 1);

namespace popp\ch11\batch08;

/**
 * 访问者模式可以与组合模式完美结合，
 * 但事实上它可以与任何对象集合一起使用。
 *
 *
 * 对外暴露操作可能会破坏封装性。
 * 也就是说，我们可能需要公开被访问对象的内部，
 * 从而使访问者对它们进行操作。
 *
 * 例如，在第一个访问者的示例中，我不得不在Unit接口中提供
 * 一个额外的方法，
 * 为TextDumpArmyVisitor对象提供所需要的信息。
 * Class TaxCollectionVisitor
 *
 * @package popp\ch11\batch08
 */
class TaxCollectionVisitor extends ArmyVisitor
{
    private $due = 0;
    private $report = "";

    public function visit(Unit $node)
    {
        $this->levy($node, 1);
    }

    public function visitArcher(Archer $node)
    {
        $this->levy($node, 2);
    }

    public function visitCavalry(Cavalry $node)
    {
        $this->levy($node, 3);
    }

    public function visitTroopCarrierUnit(TroopCarrierUnit $node)
    {
        $this->levy($node, 5);
    }

    private function levy(Unit $unit, int $amount)
    {
        $this->report .= "Tax levied for " . get_class($unit);
        $this->report .= ": $amount\n";
        $this->due += $amount;
    }

    public function getReport()
    {
        return $this->report;
    }

    public function getTax()
    {
        return $this->due;
    }
}
