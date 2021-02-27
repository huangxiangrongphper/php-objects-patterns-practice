<?php
declare(strict_types = 1);

namespace popp\ch12\batch11;

/**
 * 领域模型（Domain Model）模式：与事务脚本相对，
 * 该模式可以为业务参与者与业务过程构建面向对象的模型。
 *
 * 领域模型是朴素的逻辑引擎。
 * 它是对项目中各种角色的抽象，
 * 使我们不会受到数据库和网页显示等问题的影响，
 * 从而可以专注于业务问题。
 *
 * 领域模型是系统中真实参与者的表现形式。
 * 与其他地方相比，领域模型中的对象更像是真实事物的写照。
 * 在其他地方，
 * 对象更像是责任的体现，
 * 而在领域模型中，
 * 它们通常描述的是一组具有代理的属性，
 * 是真正进行处理的东西。
 *
 * 我们可以用领域模型来提取和体现系统的参与者和过程。
 * 随着领域逻辑变得越来越复杂，
 * 领域模型的优势也越来越明显。
 * 我们能够轻松地处理复杂的逻辑，
 * 对应用领域进行建模时需要编写的条件语句也更少。
 *
 * 领域模型的复杂性主要来自如何使模型更加纯粹，
 * 即将其与应用中的其他层分开。
 * 更麻烦的是将领域模型从数据层中分离出来。
 *
 * 领域模型中的类通常与关系数据中的表直接对应，
 * 这会使开发变得更加轻松。
 *
 * 领域模型常常会映射到数据库的结构上，
 * 但这并不意味着领域模型中的类就应该知道数据库的相关信息。
 * 将模型与数据库分离可以使整个领域层更易于测试，
 * 同时数据库模式的变化，
 * 甚至存储机制的变化给领域层造成影响的可能性也会更小。
 * 这样做还使得各个类可以专注于自己的核心任务。
 *
 * 使用领域模型的好处是，
 * 我们可以在设计模型时专注于系统要解决的问题，
 * 然后在其他层中处理持久性和表现等问题
 *
 *
 * Class DomainObject
 *
 * @package popp\ch12\batch11
 */
abstract class DomainObject
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function getCollection(string $type): Collection
    {
        // dummy implementation
        return Collection::getCollection($type);
    }

    public function markDirty()
    {
        // next chapter!
    }
}
