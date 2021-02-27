<?php
declare(strict_types = 1);

namespace popp\ch13\batch05;

use popp\ch13\batch04\Venue;
use popp\ch13\batch04\DomainObject;

/**
 *
 * 领域对象工厂能够解除数据库中的原始数据与对象字段数据之间的耦合。
 *
 * 因为领域对象工厂与数据库是解耦的，所以我们可以用它们更高效地进行测试。
 *
 *
 * Class VenueObjectFactory
 *
 * @package popp\ch13\batch05
 */
class VenueObjectFactory extends DomainObjectFactory
{
    public function createObject(array $row): DomainObject
    {
        $old = $this->getFromMap(Venue::class, $row['id']);

        if ($old) {
            return $old;
        }

        $obj = new Venue((int)$row['id'], $row['name']);

        $this->addToMap($obj);
        //$space_mapper = new SpaceMapper();
        //$space_collection = $space_mapper->findByVenue( $row['id'] );
        //$obj->setSpaces( $space_collection );

        return $obj;
    }
}
