<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

/**
 * 更新和插入操作都是在这些领域对象上进行的，
 * 因此它们发送通知最合适。
 *
 *
 * 以下是一些用于添加DomainObject对象到ObjectWatcher对象的工具方法，
 * 注意构造方法。
 *
 * Class DomainObject
 *
 * @package popp\ch13\batch04
 */
abstract class DomainObject
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        if ($id < 0) {
            $this->markNew();
        }
    }

    abstract public function getFinder(): Mapper;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function markNew()
    {
        ObjectWatcher::addNew($this);
    }

    public function markDeleted()
    {
        ObjectWatcher::addDelete($this);
    }

    public function markDirty()
    {
        ObjectWatcher::addDirty($this);
    }

    public function markClean()
    {
        ObjectWatcher::addClean($this);
    }
}
