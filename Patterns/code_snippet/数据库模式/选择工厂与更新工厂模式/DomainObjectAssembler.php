<?php
declare(strict_types = 1);

namespace popp\ch13\batch07;

use popp\ch13\batch04\Registry;
use popp\ch13\batch04\DomainObject;
use popp\ch13\batch05\Collection;

/**
 *
 * 领域对象组装器：创建一个在较高层次管理数据存取的控制器。
 *
 * 现在已经从数据映射器中移除了创建对象、查询语句和集合的职责，
 * 它不再需要管理任何查询条件。
 *
 * 现在它是一种映射器的退化形式。
 *
 * 我们创建的这些领域对象之上还需要一个对象来协调它们之间的活动。
 *
 * 这个对象可以帮助我们缓存并管理数据库连接（虽然与数据库相关的工作可以进一步委托给其他类）。
 *
 * 这些数据层控制器称为领域对象组装器。
 *
 * 这个类使用PersistenceFactory确保得到与当前的领域对象相对应的正确的选择工厂和更新工厂。
 *
 * Class DomainObjectAssembler
 *
 * @package popp\ch13\batch07
 */
class DomainObjectAssembler
{
    protected $pdo = null;

    public function __construct(PersistenceFactory $factory)
    {
        $this->factory = $factory;
        $reg = Registry::instance();
        $this->pdo = $reg->getPdo();
    }

    public function getStatement(string $str): \PDOStatement
    {
        if (! isset($this->statements[$str])) {
            $this->statements[$str] = $this->pdo->prepare($str);
        }

        return $this->statements[$str];
    }

    public function findOne(IdentityObject $idobj): DomainObject
    {
        $collection = $this->find($idobj);

        return $collection->next();
    }

    public function find(IdentityObject $idobj): Collection
    {
        $selfact = $this->factory->getSelectionFactory();
        list ($selection, $values) = $selfact->newSelection($idobj);
        $stmt = $this->getStatement($selection);
        $stmt->execute($values);
        $raw = $stmt->fetchAll();

        return $this->factory->getCollection($raw);
    }

    public function insert(DomainObject $obj)
    {
        $upfact = $this->factory->getUpdateFactory();
        list($update, $values) = $upfact->newUpdate($obj);
        $stmt = $this->getStatement($update);
        $stmt->execute($values);

        if ($obj->getId() < 0) {
            $obj->setId((int)$this->pdo->lastInsertId());
        }

        $obj->markClean();
    }
}
