<?php
declare(strict_types = 1);

namespace popp\ch11\batch07;

/**
 *
 * 访问者（Visitor）模式： 对对象树的所有节点应用操作。
 * 并非总是知道所有会在对象结构上执行的操作。
 * 如果每增加一个操作，我们都需要在类中增加一个方法来支持该操作，
 * 那么类就会变得臃肿不堪。访问者模式可以解决这个问题。
 *
 *
 *
 * Class Army
 *
 * @package popp\ch11\batch07
 */
class Army extends CompositeUnit
{
    public function bombardStrength(): int
    {
        $strength = 0;

        foreach ($this->units() as $unit) {
            $strength += $unit->bombardStrength();
        }

        return $strength;
    }
}
