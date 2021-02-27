<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

/**
 * 延迟加载是大多数Web程序员会很快掌握的核心模式之一，
 * 因为它是避免海量数据库查询的一种重要机制，
 * 这正是Web程序员都想实现的。
 *
 * Class SpaceMapper
 *
 * @package popp\ch13\batch04
 */
class SpaceMapper extends Mapper
{
    private $selectStmt;
    private $selectAllStmt;
    private $updateStmt;
    private $insertStmt;
    private $findByVenueStmt;

    public function __construct()
    {
        parent::__construct();
        $this->selectStmt = $this->pdo->prepare(
            "SELECT * FROM space WHERE id=?"
        );
        $this->updateStmt = $this->pdo->prepare(
            "UPDATE space SET name=?, id=? WHERE id=?"
        );
        $this->insertStmt = $this->pdo->prepare(
            "INSERT into space ( name, venue ) VALUES( ?, ?)"
        );

        $this->selectAllStmt = $this->pdo->prepare(
            "SELECT * FROM space"
        );

        $this->findByVenueStmt = $this->pdo->prepare(
            "SELECT * FROM space WHERE venue=?"
        );
    }

    protected function getCollection(array $raw): Collection
    {
        return new SpaceCollection($raw, $this);
    }

    // SpaceMapper
    // 获取与空间关联的Venue对象。
    // 这个操作的性能开销并不大，
    // 因为几乎可以肯定Venue对象已经存储在ObjectWatcher对象中，
    // 最后寻找event才是系统出问题的地方。
    protected function doCreateObject(array $raw): DomainObject
    {
        $obj = new Space((int)$raw['id'], $raw['name']);
        $venmapper = new VenueMapper();
        $venue = $venmapper->find((int)$raw['venue']);
        $obj->setVenue($venue);

        $eventmapper = new EventMapper();
        $eventcollection = $eventmapper->findBySpaceId((int)$raw['id']);
        $obj->setEvents($eventcollection);

        return $obj;
    }

    // SpaceMapper

    protected function targetClass(): string
    {
        return Space::class;
    }

    protected function doInsert(DomainObject $object)
    {
        $venue = $object->getVenue();

        if (! $venue) {
            throw new AppException("cannot save without venue");
        }

        $values = [ $object->getname(), $venue->getId() ];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $object->setId((int)$id);
    }

    protected function update(DomainObject $object)
    {
        $values = [$object->getname(), $object->getid(), $object->getId()];
        $this->updateStmt->execute($values);
    }

    protected function selectStmt(): \PDOStatement
    {
        return $this->selectStmt;
    }

    protected function selectAllStmt(): \PDOStatement
    {
        return $this->selectAllStmt;
    }

    public function findByVenue($vid): Collection
    {
        $this->findByVenueStmt->execute([$vid]);

        return new SpaceCollection($this->findByVenueStmt->fetchAll(), $this);
    }
}
