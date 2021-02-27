<?php
declare(strict_types = 1);

namespace popp\ch13\batch06;

/**
 * 灵活查询：允许客户端在构建查询时不考虑底层的数据库。
 *
 * 在查找领域对象时，前面介绍的映射器的实现方式有点不太灵活。
 *
 * 查找单独的领域对象没有问题，找到所有相关的领域对象同样简单。
 *
 * 但如果要查找符合特定条件的对象，那么就需要编写一个方法来创建查询语句（如EventMapper::findBySpaceId()）。
 *
 * 标识对象封装了数据库查询条件，能够解除系统与数据库语法之间的耦合。
 *
 * 标识对象封装了数据库查询的限定条件，
 * 使得我们可以在运行时组合不同的限定条件。
 *
 * 标识对象也会在一定程度上限制客户端编码人员的选择。
 *
 * 如果我们没有为领域对象中新添加的字段编写相应的方法，
 * 那么客户端代码无法将其用作限制条件。
 * 然而，"标识对象允许客户端组合不同的限制条件"这一点确实是向前迈出了一大步。
 *
 * 标识对象通常由一组供客户端调用来专门构建查询条件的方法所组成。
 * 设置对象的状态后，
 * 可以将其传递给负责构建SQL语句的方法。
 *
 * Class IdentityObject
 *
 * @package popp\ch13\batch06
 */
class IdentityObject
{
    private $name = '';

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
