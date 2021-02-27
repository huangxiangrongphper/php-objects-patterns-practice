<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * 因为大部分的实际工作都是辅助类完成的，
 * 所以应用控制器自身相对较小。
 *
 * 初始化应用控制器模式的具有完整特性的实例，
 * 可能是一件很痛苦的事情，
 * 我们需要大量的工作来获取和使用那些描述命令与请求，命令与命令，
 * 以及命令与视图间关系的元数据。
 *
 * 即使请求字符串、命令名字以及视图间的关系都是固定的，
 * 我们仍然可以构建应用控制器来封装这种关系。
 * 当需要重构代码以适应更高的复杂性时，
 * 这将为我们带来非常高的灵活性。
 *
 * Class AppController
 *
 * @package popp\ch12\batch06
 */
class AppController
{
    private static $defaultcmd = DefaultCommand::class;
    private static $defaultview = "fallback";

    public function getCommand(Request $request): Command
    {
        try {
            $descriptor = $this->getDescriptor($request);
            $cmd = $descriptor->getCommand();
        } catch (AppException $e) {
            $request->addFeedback($e->getMessage());
            return new self::$defaultcmd();
        }

        return $cmd;
    }

    public function getView(Request $request): ViewComponent
    {
        try {
            $descriptor = $this->getDescriptor($request);
            $view = $descriptor->getView($request);
        } catch (AppException $e) {
            return new TemplateViewComponent(self::$defaultview);
        }

        return $view;
    }

    // 来获取当前请求所对应的ComponentDescriptor
    private function getDescriptor(Request $request): ComponentDescriptor
    {
        $reg = Registry::instance();
        // 获得Conf对象
        $commands = $reg->getCommands();
        $path = $request->getPath();
        $descriptor = $commands->get($path);

        if (is_null($descriptor)) {
            throw new AppException("no descriptor for {$path}", 404);
        }

        return $descriptor;
    }
}
