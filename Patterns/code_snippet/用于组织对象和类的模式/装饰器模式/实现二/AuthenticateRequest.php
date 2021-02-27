<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 * 具体的装饰器类
 * Class AuthenticateRequest
 *
 * @package popp\ch10\batch07
 */
class AuthenticateRequest extends DecorateProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": authenticating request\n";
        $this->processrequest->process($req);
    }
}
