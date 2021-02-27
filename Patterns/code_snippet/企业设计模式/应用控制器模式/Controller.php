<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * 如果使用一个对象帮助前端控制器模式选择视图（也可能是命令），
 * 那么可以更好地控制视图导航。
 * 当表示控制散步在整个系统时，
 * 则难以做到这一点。
 *
 * 应用控制器（Application Controller）：创建一个类来管理视图逻辑和命令选择。
 *
 * 我们应当尽可能解耦命令与视图层。
 *
 * 应用控制器负责将请求映射到命令以及将命令映射到视图。
 * 这种解耦意味着我们更容易在不改变代码库的情况下切换视图。
 * 我们可以砸不对系统内部做任何修改的情况下改变应用的流程。
 * 命令解析还有助于更轻松地在其他系统中复用Command类。
 *
 * 应用控制器类可以将Command类解放出来，使其专注于自己的工作，
 * 即处理输入、调用应用逻辑及处理结果。
 *
 * 应用控制器是一个（或一组）类，前端控制器可以基于用户请求使用它们获取命令，
 * 并在命令执行后找到适当的视图展示给用户。
 *
 * 本模式的目标也是尽可能地简化客户端代码，
 * 即简化前端控制器类。
 *
 * 本例中所展示的只是诸多实现方式的一种。
 * 在阅读本节的过程中需要记住，
 * 模式的本质在于参与者（应用控制器、命令和视图）的交互方式，
 * 而不是实现的细节。
 *
 * Class Controller
 *
 * @package popp\ch12\batch06
 */
class Controller
{
    private $reg;

    // Controller
    private function __construct()
    {
        $this->reg = Registry::instance();
    }

    private function handleRequest()
    {
        // 用注册表对象来获取Request对象。
        $request = $this->reg->getRequest();
        // 类名从CommandResolver变为了AppController
        // 可以将AppController对象存储在注册表中，
        // 哪怕其他组件并不使用它。
        // 不直接实例化对象的类通常更灵活，也更易于测试。
        $controller = new AppController();
        // 应用控制器用Request对象来查找并实例化适当的Command类。
        // 一旦开始执行，Command就具有一种状态。
        // 我们可以比较命令和状态的这种组合与某种数据结构，
        // 以决定接下来应该执行哪一条命令。
        // 如果没有需要继续执行的命令，那么就决定使用哪个视图。

        // 前端控制器类用应用控制器先获取Command对象，
        // 然后获取视图
        $cmd = $controller->getCommand($request);
        $cmd->execute($request);
        $view = $controller->getView($request);
        $view->render($request);
    }

    public static function run()
    {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    private function init()
    {
        $this->reg->getApplicationHelper()->init();
    }
}
