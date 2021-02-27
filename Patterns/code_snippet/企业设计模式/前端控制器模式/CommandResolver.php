<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 * 控制器需要决定如何解释HTTP请求，
 * 以便调用正确的业务逻辑代码来处理该请求。
 * 我们本可以很轻松地在Controller类中编写这个逻辑，
 * 但是我更喜欢使用一个专门的类来实现这个功能。
 * 这样一来，如果有需要的话，
 * 我们可以通过重构来使用多态属性。
 *
 * 前端控制器通常通过运行一个Command对象来调用应用逻辑（命令模式），
 * 而Command对象是根据请求URL（通过URL路径或者如今不太流行的GET参数）选择的。
 *
 * 无论采取哪种方式，我们最终都会得到一个标志位或模式字符串，
 * 然后据此选择命令对象。
 * 根据URL选择命令对象的方法有很多种。
 * 例如，我们可以比较标志位与配置文件或数据结构（逻辑策略），
 * 或将其直接与文件系统上的类文件比较（物理策略）。
 *
 *
 * 以下采取逻辑策略，将URL片段隐射到Command类。
 *
 * 在创建命令类时，应该尽量避免使用应用逻辑。
 * 一旦命令类开始以来应用逻辑，
 * 它们就会变成一种高度耦合的事物脚本，
 * 而且重复代码也会很快蔓延。
 *
 * 命令是一种中继站：它们应该解释请求，
 * 调用领域类来处理一些对象，
 * 然后将数据提交给表示层。
 * 一旦它们开始做比这更复杂的事情，
 * 就意味着需要重构了。
 * 好消息是重构相对比较容易。
 * 因为我们很容易发现一个命令做了过多事情，
 * 而且解决方案通常也非常明确：将多余的功能移到辅助类或领域类中。
 *
 *
 * Class CommandResolver
 *
 * @package popp\ch12\batch05
 */
class CommandResolver
{
    private static $refcmd = null;
    private static $defaultcmd = DefaultCommand::class;

    public function __construct()
    {
        // could make this configurable
        self::$refcmd = new \ReflectionClass(Command::class);
    }

    // Request对象首先传递给CommandResolver对象，
    // 接着又传递给了Command对象。
    public function getCommand(Request $request): Command
    {
        $reg = Registry::instance();
        $commands = $reg->getCommands();
        $path = $request->getPath();

        $class = $commands->get($path);

        if (is_null($class)) {
            $request->addFeedback("path '$path' not matched");
            return new self::$defaultcmd();
        }

        if (! class_exists($class)) {
            $request->addFeedback("class '$class' not found");
            return new self::$defaultcmd();
        }

        $refclass = new \ReflectionClass($class);

        if (! $refclass->isSubClassOf(self::$refcmd)) {
            $request->addFeedback("command '$refclass' is not a Command");
            return new self::$defaultcmd();
        }

        // 如果找到类名，该类存在且继承自Command基类，
        // 那么就实例化一个该类的对象并将其返回。

        // 在Symfony中允许在路径中使用正则表达式
        return $refclass->newInstance();
    }
}

