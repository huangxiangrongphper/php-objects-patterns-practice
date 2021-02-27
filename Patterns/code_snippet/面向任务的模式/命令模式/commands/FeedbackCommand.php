<?php
declare(strict_types = 1);

namespace popp\ch11\batch09\commands;

use popp\ch11\batch09\CommandContext;
use popp\ch11\batch09\Command;
use popp\ch11\batch09\Registry;

/**
 * 本节实现的结构实际上是前端控制器（Front Controller）模式的一个简化版本。
 *
 * 这个类负责响应action字符串参数为"feedback"的请求，
 * 而且我们无须对控制器对象或CommandFactory类做任何修改。
 * Class FeedbackCommand
 *
 * @package popp\ch11\batch09\commands
 */
class FeedbackCommand extends Command
{
    public function execute(CommandContext $context): bool
    {
        $msgSystem = Registry::getMessageSystem();
        $email = $context->get('email');
        $msg   = $context->get('msg');
        $topic = $context->get('topic');
        $result = $msgSystem->send($email, $msg, $topic);

        if (! $result) {
            $context->setError($msgSystem->getError());
            return false;
        }

        return true;
    }
}
