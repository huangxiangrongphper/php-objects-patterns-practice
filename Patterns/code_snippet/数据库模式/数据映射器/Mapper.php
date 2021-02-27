<?php
declare(strict_types = 1);

namespace popp\ch13\batch01;

/**
 * 数据映射器：创建用于实现领域模型对象与关系型数据库之间的映射的特定类。
 *
 * 数据层接口模式：用于定义存储层与系统其他部分间的接口。
 *
 * 数据映射器模式也称为数据访问对象（Data Access Object）。
 *
 * 数据访问对象与数据映射器模式并不完全是同一回事，
 * 因为它会生成数据传输对象。
 * 但因为这样的对象是设计用于传输数据的，
 * 所以可以说数据访问对象模式与数据映射器模式非常类似。
 * 数据映射器负责完成数据在数据库与对象间的转换。
 *
 * 对象的组织关系与关系数据库中表的组织关系不同。
 * 数据库表是由行和列组成的网络。
 * 一张表中的一行可以通过外键与另一张（甚至相同）表中的另一行相关联。
 * 另一方面，
 * 对象往往是更有机地关联在一起。
 * 一个对象可能包含另一个对象，
 * 不同的数据结构能够以不同的方式组织相同的对象，
 * 在运行时组合对象或以新的关系重组对象。
 * 优化后的关系数据库可以管理大量的表格数据，
 * 而类和对象则集中封装了较小的信息块。
 *
 * 类和关系数据库之间的这种不匹配通常称为"对象关系阻抗不匹配"（或简称为"阻抗不匹配"）。
 *
 * 那么如何实现这种转换呢？
 * 其中一种方式是让一个类（或一组类）负责这种转换，
 * 在领域模型中有效地隐藏对数据库的操作，
 * 并管理数据转换中不可避免的冲突。
 *
 * 以下是一个数据映射器类
 *
 * 在领域模型中，
 * 通常习惯为每个领域类都实现一个单独的Mapper。
 *
 * Class Mapper
 *
 * @package popp\ch13\batch01
 */
abstract class Mapper
{
    protected $pdo;

    public function __construct()
    {
        // 注册表只有在这样的类中才能真正体现出其价值
        // 这里是将数据从控制层传递给Mapper对象，有时这并非是合理的
        $reg = Registry::instance();
        $this->pdo = $reg->getPdo();
    }

    public function find(int $id): DomainObject
    {
        // 调用预编译的SQL语句（由子类提供）并获取数据行
        $this->selectstmt()->execute([$id]);
        $row = $this->selectstmt()->fetch();
        $this->selectstmt()->closeCursor();

        if (! is_array($row)) {
            return null;
        }

        if (! isset($row['id'])) {
            return null;
        }

        $object = $this->createObject($row);

        return $object;
    }

    // Mapper

    public function findAll(): Collection
    {
        $this->selectAllStmt()->execute([]);

        return $this->getCollection(
            $this->selectAllStmt()->fetchAll()
        );
    }

    // 所有的映射器都能够返回一个持久化领域对象的集合。
    abstract protected function selectAllStmt(): \PDOStatement;
    abstract protected function getCollection(array $raw): Collection;

    public function createObject(array $raw): DomainObject
    {
        $obj = $this->doCreateObject($raw);

        return $obj;
    }

    // 这里使用了模板方法模式
    // 基类通常在操作之前或之后执行内务处理，
    // 这就是模板方法会用于显示委托（例如，在insert()等具体方法中调用doInsert()等抽象方法）的原因。
    // 子类通过这种方式决定实现基类中的哪些方法。
    public function insert(DomainObject $obj)
    {
        $this->doInsert($obj);
    }

    abstract public function update(DomainObject $object);
    abstract protected function doCreateObject(array $raw): DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStmt(): \PDOStatement;
    abstract protected function targetClass(): string;
}
