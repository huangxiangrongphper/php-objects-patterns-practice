<?php
declare(strict_types = 1);

namespace popp\ch13\batch01;

/**
 * 映射器类
 * Class VenueMapper
 *
 * @package popp\ch13\batch01
 */
class VenueMapper extends Mapper
{
    private $selectStmt;
    private $selectAllStmt;
    private $updateStmt;
    private $insertStmt;

    // 构造方法会预编译一些SQL语句拱以后使用
    public function __construct()
    {
        parent::__construct();

        // 父类的find方法会调用selectStmt来得到预编译的SELECT语句。
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

    // 会使用关联数组生成一个Venue对象。
    protected function doCreateObject(array $raw): DomainObject
    {
        $obj = new Venue(
            (int)$raw['id'],
            $raw['name']
        );

        return $obj;
    }

    protected function doInsert(DomainObject $object)
    {
        // 应该执行一次instanceof检测，
        // 如果发现接收到的是类型错误的对象，
        // 则抛出异常

        $values = [$object->getName()];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        // 会在接受到对象上设置一个ID
        // 对象是通过引用传递的，
        // 因此客户端代码可以看到这个变化
        $object->setId((int)$id);
    }

    public function update(DomainObject $object)
    {
        $values = [
            $object->getName(),
            $object->getId(),
            $object->getId()
        ];

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
