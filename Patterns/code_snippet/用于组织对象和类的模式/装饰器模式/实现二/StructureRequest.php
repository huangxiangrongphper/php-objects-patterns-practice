<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 * 具体的装饰器类
 * Class StructureRequest
 *
 * @package popp\ch10\batch07
 */
class StructureRequest extends DecorateProcess
{
    // 每个process()方法都会在调用那个被引用的ProcessRequest对象自身的process()方法前打印一条信息。
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": structuring request data\n";
        $this->processrequest->process($req);
    }
}
