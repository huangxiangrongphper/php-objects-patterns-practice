<?php
declare(strict_types = 1);

namespace popp\ch13\batch06;

/**
 * 标识对象类只是将数据保存起来，
 * 然后在外部请求时返回这些数据。
 *
 * Class EventIdentityObject
 *
 * @package popp\ch13\batch06
 */
class EventIdentityObject extends IdentityObject
{
    private $start = null;
    private $minstart = null;

    public function setMinimumStart(int $minstart)
    {
        $this->minstart = $minstart;
    }

    public function getMinimumStart()
    {
        return $this->minstart;
    }

    public function setStart(int $start)
    {
        $this->start = $start;
    }

    public function getStart()
    {
        return $this->start;
    }
}
