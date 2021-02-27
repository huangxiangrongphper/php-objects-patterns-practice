<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 * 抽象装饰器
 * Class DecorateProcess
 *
 * @package popp\ch10\batch07
 */
abstract class DecorateProcess extends ProcessRequest
{
    // 子类也能访问到这个对象
    protected $processrequest;

    public function __construct(ProcessRequest $pr)
    {
        $this->processrequest = $pr;
    }
}
