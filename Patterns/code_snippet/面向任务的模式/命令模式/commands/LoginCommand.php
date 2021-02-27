<?php
declare(strict_types = 1);

namespace popp\ch11\batch09\commands;

use popp\ch11\batch09\CommandContext;
use popp\ch11\batch09\Command;
use popp\ch11\batch09\Registry;

/**
 *
 * 具体的命令类
 *
 * 检查输入、处理错误、缓存数据
 * 并调用其他对象类执行操作。
 *
 * Class LoginCommand
 *
 * @package popp\ch11\batch09\commands
 */
class LoginCommand extends Command
{

    // CommandContext对象既可以将请求数据传递给命令对象，
    // 也可以将响应返回给视图层。
    // 以这种方式使用对象是有好处的，因为不用破坏接口就可以将不同的参数传递给命令对象。
    public function execute(CommandContext $context): bool
    {
        $manager = Registry::getAccessManager();
        $user = $context->get('username');
        $pass = $context->get('pass');
        $user_obj = $manager->login($user, $pass);

        if (is_null($user_obj)) {
            $context->setError($manager->getError());
            return false;
        }

        $context->addParam("user", $user_obj);

        return true;
    }
}
