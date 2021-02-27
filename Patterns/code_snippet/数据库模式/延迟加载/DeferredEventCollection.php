<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

/**
 * 延迟加载：推迟对象创建，甚至是数据库查询，
 * 直到真的需要这么做。
 *
 * 在客户端访问Iterator时，
 * 还未使用原始数据实例化领域对象。
 * 可以在这里隐藏更多东西。
 *
 * 无论是否在领域类中明确地加入延迟加载的逻辑，养成延迟加载的好习惯一定会令系统受益。
 * 除了类型安全外，使用集合而非数组的另一个好处是可以使用延迟加载。
 *
 * 以下是一个直到接收请求才访问数据库的类。
 * 这意味着客户端对象（如Space）不需要关心实例化后是否持有一个空的Collection，
 * 因为只要有需要，
 * 它就能得到一个完全正常的EventCollection。
 *
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

    // 如果有人试图访问这个集合，
    // 那么DeferredEventCollection类知道是时候结束伪装并获取真实的数据了。
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
