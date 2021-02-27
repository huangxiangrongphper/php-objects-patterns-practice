<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * 在面向对象的代码中，
 * 虽然接口总是比实现更重要，
 * 不过这里我们还是提供一种实现吧。
 *
 * Command对象通过设置状态标志位告诉系统其当前的状态。
 *
 *
 * Class Command
 *
 * @package popp\ch12\batch06
 */
abstract class Command
{

    const CMD_DEFAULT = 0;
    const CMD_OK = 1;
    const CMD_ERROR = 2;
    const CMD_INSUFFICIENT_DATA = 3;


    final public function __construct()
    {
    }

    public function execute(Request $request)
    {
        $status = $this->doExecute($request);
        // 将返回值保存在Request对象中。
        // 稍后ComponentDescriptor会用这个值选择并返回合适的视图。
        $request->setCmdStatus($status);
    }

    abstract public function doExecute(Request $request): int;
}
