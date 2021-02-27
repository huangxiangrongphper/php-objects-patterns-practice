<?php
declare(strict_types = 1);

namespace popp\ch11\batch08;

/**
 * 在访问者模式中学习了如何通过一次调用来操作对象树中的所有组件。
 *
 * Class Unit
 *
 * @package popp\ch11\batch08
 */
abstract class Unit
{
    // ...
    protected $health = 10;
    protected $depth = 0;

    public function getComposite()
    {
        return null;
    }

    abstract public function bombardStrength();

    public function getHealth(): int
    {
        return $this->health;
    }

    public function isNull(): bool
    {
        return false;
    }

    // 这省去了为类层次中的每个叶子节点定义一个accept()的麻烦。
    public function accept(ArmyVisitor $visitor)
    {
        $refthis = new \ReflectionClass(get_class($this));
        $method = "visit" . $refthis->getShortName();
        $visitor->$method($this);
    }

    protected function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }
}
