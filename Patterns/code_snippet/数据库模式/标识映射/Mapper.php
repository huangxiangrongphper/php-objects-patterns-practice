<?php
declare(strict_types = 1);

namespace popp\ch13\batch03;

use popp\ch13\batch01\Collection;
use popp\ch13\batch01\DomainObject;
use popp\ch13\batch01\Registry;

/**
 *
 *  将ObjectWatcher作为标识映射对象。
 *
 *
 * Class Mapper
 *
 * @package popp\ch13\batch03
 */
abstract class Mapper
{
    protected $pdo;

    public function __construct()
    {
        $reg = Registry::instance();
        $this->pdo = $reg->getPdo();
    }


    // Mapper

    public function find(int $id): DomainObject
    {
        $old = $this->getFromMap($id);

        if (! is_null($old)) {
            return $old;
        }

        // work with db

        $this->selectstmt()->execute([$id]);
        $raw = $this->selectstmt()->fetch();
        $this->selectstmt()->closeCursor();

        if (! is_array($raw)) {
            return null;
        }

        if (! isset($raw['id'])) {
            return null;
        }

        $object = $this->createObject($raw);

        return $object;
    }

    // 由各个具体Mapper类实现。
    // 它应该返回Mapper要生成的类的名字。
    abstract protected function targetClass(): string;

    private function getFromMap($id)
    {
        return ObjectWatcher::exists(
            $this->targetClass(),
            $id
        );
    }

    private function addToMap(DomainObject $obj)
    {
        ObjectWatcher::add($obj);
    }

    public function createObject($raw)
    {
        $old = $this->getFromMap($raw['id']);

        if (! is_null($old)) {
            return $old;
        }

        $obj = $this->doCreateObject($raw);
        // 防止以后出现冲突
        $this->addToMap($obj);

        return $obj;
    }

    public function insert(DomainObject $obj)
    {
        $this->doInsert($obj);
        $this->addToMap($obj);
    }

    public function findAll(): Collection
    {
        $this->selectAllStmt()->execute([]);

        return $this->getCollection(
            $this->selectAllStmt()->fetchAll()
        );
    }


    abstract protected function selectAllStmt(): \PDOStatement;
    abstract protected function getCollection(array $raw): Collection;
    abstract protected function update(DomainObject $object);
    abstract protected function doCreateObject(array $raw): DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStmt(): \PDOStatement;
}
