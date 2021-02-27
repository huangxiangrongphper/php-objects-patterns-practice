<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 *
 * 可以简单地修改基类即可将启动代码和清理代码添加到所有命令中
 * Class Command
 *
 * @package popp\ch12\batch05
 */
abstract class Command
{
    // 声明为final能够防止子类重写构造方法。
    final public function __construct()
    {
    }

    public function execute(Request $request)
    {
        $this->doExecute($request);
    }

    abstract public function doExecute(Request $request);
}
