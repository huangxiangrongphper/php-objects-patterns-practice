<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 *
 * 前端控制器（Front Controller）：该模式可以在大型系统中帮助我们尽可能灵活地管理不同的视图和命令。
 *
 * 问题：当控制分散在不同视图中时，可能出现的另一个问题是难以管理不同视图间的跳转。
 * 在一个复杂的系统中，根据输入和在逻辑层执行操作的结果，一次提交可能会跳转至不同的结果页面。
 *
 * 前端控制器模式的核心是为所有请求定义一个入口中心。
 * 它会处理请求并选择要执行的操作。
 * 通常我们会用命令模式将这些操作定义在命令对象中。
 *
 *
 * 位于系统的最前端，将实际处理委托给其他类，
 * 而大部分工作是由这些其他类完成的。
 *
 * 前端控制器往往还需要命令与视图间的逻辑映射等额外信息。
 *
 * 前端控制器将系统中的表现逻辑集中在一起。
 * 这意味着我们可以在一个地方（一组类）控制处理请求和选择视图的方式。
 * 降低出现重复代码以及发生bug的可能性。
 *
 *
 *
 * Class Controller
 *
 * @package popp\ch12\batch05
 */
class Controller
{
    private $reg;

    private function __construct()
    {
        // 获取注册表类的实例
        $this->reg = Registry::instance();
    }

    // 因为构造方法是私有的，
    // 所以run()方法是客户端代码调用系统进行处理的唯一选择。
    // 通常会在一个名为index.php的文件中调用run()方法，这只需要几行代码。
    public static function run()
    {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    private function init()
    {
        // 初始化应用要使用的数据
        $this->reg->getApplicationHelper()->init();
    }

    private function handleRequest()
    {
        $request = $this->reg->getRequest();
        $resolver = new CommandResolver();
        $cmd = $resolver->getCommand($request);
        $cmd->execute($request);
    }
}
