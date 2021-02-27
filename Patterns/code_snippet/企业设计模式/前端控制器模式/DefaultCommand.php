<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 *
 * 在前端控制器模式的这种实现方式中，
 * Command自身负责委托给视图层
 * Class DefaultCommand
 *
 * @package popp\ch12\batch05
 */
class DefaultCommand extends Command
{
    public function doExecute(Request $request)
    {
        // Requst类管理着一个$feedback数组。
        // 它是一个简单的管道，
        // 控制器类可以通过它将消息传递给用户。
        // 在Command类中定义命令与视图的映射关系是最简单的分发机制。
        $request->addFeedback("Welcome to WOO");
        include(__DIR__ . "/main.php");
    }
}
