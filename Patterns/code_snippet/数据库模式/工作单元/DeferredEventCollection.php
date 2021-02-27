<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

/**
 * 工作单元模式：自动保存对象到数据库，
 * 确保只有修改过的对象才会更新到数据库，
 * 以及只有新建的对象才会插入数据库。
 *
 * Class DeferredEventCollection
 *
 * @package popp\ch13\batch04
 */
class DeferredEventCollection extends EventCollection
{
    private $stmt;
    private $valueArray;
    private $run = false;

    public function __construct(
        Mapper $mapper,
        \PDOStatement $stmt_handle,
        array $valueArray
    ) {
        parent::__construct([], $mapper);
        $this->stmt = $stmt_handle;
        $this->valueArray = $valueArray;
    }

    public function notifyAccess()
    {
        if (! $this->run) {
            $this->stmt->execute($this->valueArray);
            $this->raw = $this->stmt->fetchAll();
            $this->total = count($this->raw);
        }

        $this->run = true;
    }
}

