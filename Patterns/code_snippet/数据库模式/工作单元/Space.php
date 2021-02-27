<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

class Space extends DomainObject
{
    private $name;
    private $venue = null;

    public function __construct(int $id, string $name, Venue $venue = null)
    {
        $this->name = $name;
        parent::__construct($id);
        $this->venue = $venue;
    }

    // Space

    // 确保在所有可能会修改对象状态的方法中将对象标记为"脏对象"是很重要的。
    public function setVenue(Venue $venue)
    {
        $this->venue = $venue;
        $this->markDirty();
    }

    // 确保在所有可能会修改对象状态的方法中将对象标记为"脏对象"是很重要的。
    public function setName(string $name)
    {
        $this->name = $name;
        $this->markDirty();
    }

    public function setEvents(EventCollection $collection)
    {
        $this->events = $collection;
    }

    public function getEvents()
    {
        return $this->events;
    }

    // Space
    // 延迟加载指的是在客户端确实需要对象的某个属性时才获取该属性。
    // 实现延迟加载的最简单方法就是在属性所属的对象中明确地推迟获取属性的处理。
    public function getEvents2()
    {
        if (is_null($this->events)) {
            $this->events = $this->getFinder()->findByScaceId($this->getId());
        }

        return $this->events;
    }

    public function getVenue(): Venue
    {
        return $this->venue;
    }

    // 获取一个查询器，即一个Mapper对象
    public function getFinder(): Mapper
    {
        $reg = Registry::instance();

        return $reg->getSpaceMapper();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
