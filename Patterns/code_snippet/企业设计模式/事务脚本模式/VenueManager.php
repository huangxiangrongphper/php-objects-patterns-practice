<?php
declare(strict_types = 1);

namespace popp\ch12\batch10;

/**
 *
 * 我们可以把访问数据库的工作从应用逻辑中分离出来。
 * 放在网关类中，使其代表系统与数据库交互。
 *
 * Class VenueManager
 *
 * @package popp\ch12\batch10
 */
class VenueManager extends Base
{
    private $addvenue = "INSERT INTO venue
                          ( name )
                          VALUES( ? )";

    private $addspace  = "INSERT INTO space
                          ( name, venue )
                          VALUES( ?, ? )";

    private $addevent =  "INSERT INTO event
                          ( name, space, start, duration )
                          VALUES( ?, ?, ?, ? )";

    // ...


    // VenueManager

    public function addVenue(string $name, array $spaces): array
    {
        $pdo = $this->getPdo();
        $ret = [];
        $ret['venue'] = [$name];
        $stmt = $pdo->prepare($this->addvenue);
        // 上面SQL语句的问号是execute()方法的参数值占位符。
        $stmt->execute($ret['venue']);
        $vid = $pdo->lastInsertId();

        $ret['spaces'] = [];

        $stmt = $pdo->prepare($this->addspace);

        foreach ($spaces as $spacename) {
            $values = [$spacename, $vid];
            $stmt->execute($values);
            $sid = $pdo->lastInsertId();
            array_unshift($values, $sid);
            $ret['spaces'][] = $values;
        }

        return $ret;
    }

    // VenueManager

    public function bookEvent(int $spaceid, string $name, int $time, int $duration)
    {
        $pdo = $this->getPdo();
        $stmt = $pdo->prepare($this->addevent);
        $stmt->execute([$name, $spaceid, $time, $duration]);
    }
}
