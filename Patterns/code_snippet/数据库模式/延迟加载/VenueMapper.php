<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

/*
use popp\ch13\batch01\Venue;
use popp\ch13\batch01\Collection;
use popp\ch13\batch01\VenueCollection;
use popp\ch13\batch03\Mapper;
use popp\ch13\batch01\DomainObject;
use popp\ch13\batch01\SpaceMapper;
*/

class VenueMapper extends Mapper
{
    private $selectStmt;
    private $selectAllStmt;
    private $updateStmt;
    private $insertStmt;

    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = $this->pdo->prepare(
            "SELECT * FROM venue WHERE id=?"
        );

        $this->selectAllStmt = $this->pdo->prepare(
            "SELECT * FROM venue"
        );

        $this->updateStmt = $this->pdo->prepare(
            "UPDATE venue SET name=?, id=? WHERE id=?"
        );
        $this->insertStmt = $this->pdo->prepare(
            "INSERT INTO venue ( name ) VALUES( ? )"
        );
    }

    protected function targetClass(): string
    {
        return Venue::class;
    }

    public function getCollection(array $raw): Collection
    {
        return new VenueCollection($raw, $this);
    }

    // 创建Venue对象时会自动创建出一个Spacecollection对象。
    // 如果我们要列出Venue中的每个Space对象，
    // 那么会自动向数据库发送请求来获取与各个Space关联的所有Event，
    // 并将这些Event存储在一个EventCollection对象中。
    protected function doCreateObject(array $array): DomainObject
    {
        $obj = new Venue((int)$array['id'], $array['name']);
        $spacemapper = new SpaceMapper();
        $spacecollection = $spacemapper->findByVenue($array['id']);
        $obj->setSpaces($spacecollection);

        return $obj;
    }

    protected function doInsert(DomainObject $object)
    {
        $values = [$object->getName()];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $object->setId((int)$id);
    }

    public function update(DomainObject $object)
    {
        $values = [$object->getName(), $object->getId(), $object->getId()];
        $this->updateStmt->execute($values);
    }

    public function selectStmt(): \PDOStatement
    {
        return $this->selectStmt;
    }

    public function selectAllStmt(): \PDOStatement
    {
        return $this->selectAllStmt;
    }
}
