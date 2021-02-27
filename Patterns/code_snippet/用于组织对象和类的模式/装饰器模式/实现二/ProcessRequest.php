<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 *
 * 抽象基类
 * Class ProcessRequest
 *
 * @package popp\ch10\batch07
 */
abstract class ProcessRequest
{
    abstract public function process(RequestHelper $req);
}
