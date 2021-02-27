<?php

namespace popp\ch12\batch07;

/**
 *
 * 如果项目相对简单，
 * 那么开展大型的前期设计可能会威胁到我们的交付期限，
 * 而且不会产生大量的价值。
 * 页面控制器是管理请求和视图的一种良好选择。
 *
 * Class Venue
 *
 * @package popp\ch12\batch07
 */
class Venue
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
