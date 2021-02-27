<?php
declare(strict_types = 1);

namespace popp\ch11\batch07;


abstract class CompositeUnit extends Unit
{
    // ...
    private $units = [];

    public function getComposite(): Unit
    {
        return $this;
    }

    public function units(): array
    {
        return $this->units;
    }

    public function removeUnit(Unit $unit)
    {
        $units = [];

        foreach ($this->units as $thisunit) {
            if ($unit !== $thisunit) {
                $units[] = $thisunit;
            }
        }

        $this->units = $units;
    }

    public function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }

        $this->units[] = $unit;
    }

    public function unitCount(): int
    {
        $count = 0;

        foreach ($this->units as $unit) {
            $count += $unit->unitCount();
        }

        return $count;
    }

    // 为什么我要将这些方法放在组合对象的接口中呢？
    // 真正有说服力的答案只有一个：将这些不同的操作放在这里，
    // 是因为这样就很容易访问组合结构中的关联节点。

    // 虽然能够轻松遍历对象树是组合模式的一大优势，
    // 但并非每个需要遍历对象树的操作都要在组合对象接口中占据一席之地。

    // 因此，现在存在两个影响设计的因素：我们希望充分利用能够轻松遍历对象结构的优势，
    // 但不希望接口过度膨胀。
    public function textDump($num = 0): string
    {
        $txtout = parent::textDump($num);

        foreach ($this->units as $unit) {
            $txtout .= $unit->textDump($num + 1);
        }

        return $txtout;
    }
}

