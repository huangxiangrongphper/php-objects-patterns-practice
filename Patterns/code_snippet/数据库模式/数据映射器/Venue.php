<?php
declare(strict_types = 1);

namespace popp\ch13\batch01;

/**
 * 领域层
 *
 * 扩展Venue类来管理Space对象的持久化。
 * Venue类提供了将各个Space对象添加到其SpaceCollection中的方法和替换整个SpaceCollection的方法。
 *
 * Class Venue
 *
 * @package popp\ch13\batch01
 */
class Venue extends DomainObject
{
    private $name;
    private $spaces=null;

    public function __construct($id, $name)
    {
        $this->name = $name;
        parent::__construct($id);
    }

    // Venue

    public function getSpaces(): SpaceCollection
    {
        if (is_null($this->spaces)) {
            $reg = Registry::instance();
            $this->spaces = $reg->getSpaceCollection();
        }

        return $this->spaces;
    }

    // 假设集合中的所有Space对象都属于当前的Venue。
    public function setSpaces(SpaceCollection $spaces)
    {
        $this->spaces = $spaces;
    }

    public function addSpace(Space $space)
    {
        $this->getSpaces()->add($space);
        $space->setVenue($this);
    }

    // Venue

    public function getSpaces2()
    {
        if (is_null($this->spaces)) {
            $reg = Registry::instance();
            $finder = $reg->getSpaceMapper();
            $this->spaces = $finder->findByVenue($this->getId());
        }

        return $this->spaces;
    }

    public function getFinder(): Mapper
    {
        $reg = Registry::instance();
        return $reg->getVenueMapper();
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->markDirty();
    }

    public function getName(): string
    {
        return $this->name;
    }
}
