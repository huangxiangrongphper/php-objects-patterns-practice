<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 * 具体组件
 * Class MainProcess
 *
 * @package popp\ch10\batch07
 */
class MainProcess extends ProcessRequest
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": doing something useful with request\n";
    }
}
