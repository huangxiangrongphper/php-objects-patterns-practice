<?php
declare(strict_types = 1);

namespace popp\ch11\batch08;

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

    public function getHealth(): int
    {
        $health = 0;

        foreach ($this->units() as $unit) {
            $health += $unit->getHealth();
        }

        return $health;
    }

    public function addUnit(Unit $unit)
    {
        foreach ($this->units as $thisunit) {
            if ($unit === $thisunit) {
                return;
            }
        }

        $unit->setDepth($this->depth+1);
        $this->units[] = $unit;
    }

    // 因为重写了父类的操作
    // 为当前组件调用正确的访问者方法；
    // 如果当前对象是组合对象的话，那么可以通过accept()方法将访问者对象传递给
    // 所有当前对象的叶子对象。
    public function accept(ArmyVisitor $visitor)
    {
        parent::accept($visitor);

        // 因为遍历与访问者对象执行的操作是分离的，
        // 所以我们必须在一定程度上放开控制。
        // 例如，我们无法很容易地创建一个在子节点被遍历前后都进行一些处理的方法。
        // 其中一种解决方法是将遍历职责转移给访问者对象。
        // 但这样做会带来一个新的问题：各个访问者对象间会出现重复的遍历代码。
        // 通常我更倾向于在访问者内部遍历，但外部遍历又具有不可替代的优势。
        // 我们可以在不同的访问者中以不同的方式处理被访问类。
        foreach ($this->units as $thisunit) {
            $thisunit->accept($visitor);
        }
    }
}
