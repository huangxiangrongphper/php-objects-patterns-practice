<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 *
 * 管理组件数据
 * 负责管理一组关于一个command元素的信息。
 *
 * 这个小型类提供了XML配置文件中的command元素所隐含的所有逻辑。
 * Class ComponentDescriptor
 *
 * @package popp\ch12\batch06
 */
class ComponentDescriptor
{
    private $path;
    private static $refcmd;
    private $cmdstr;

    public function __construct(string $path, string $cmdstr)
    {
        self::$refcmd = new \ReflectionClass(Command::class);
        $this->path = $path;
        // 存储命令的完整类名称。
        $this->cmdstr = $cmdstr;
    }

    // 只有getCommand()方法被调用时才会根据这份命令信息延迟生成一个Command对象
    public function getCommand(): Command
    {
        return $this->resolveCommand($this->cmdstr);
    }

    public function setView(int $status, ViewComponent $view)
    {
        $this->views[$status] = $view;
    }

    // 获取视图
    // 接受一个Request对象作为参数
    // 其中缓存有Command的状态值
    public function getView(Request $request): ViewComponent
    {
        $status = $request->getCmdStatus();
        $status = (is_null($status)) ? 0 : $status;

        if (isset($this->views[$status])) {
            return $this->views[$status];
        }

        if (isset($this->views[0])) {
            return $this->views[0];
        }

        throw new AppException("no view found");
    }

    public function resolveCommand(string $class): Command
    {
        if (is_null($class)) {
            throw new AppException("unknown class '$class'");
        }

        if (! class_exists($class)) {
            throw new AppException("class '$class' not found");
        }

        $refclass = new \ReflectionClass($class);

        if (! $refclass->isSubClassOf(self::$refcmd)) {
            throw new AppException("command '$class' is not a Command");
        }

        return $refclass->newInstance();
    }
}
