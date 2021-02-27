<?php
declare(strict_types = 1);

namespace popp\ch11\batch09;

class Runner
{
    public static function run()
    {

        $controller = new Controller();
        $context = $controller->getContext();

        $context->addParam('action', 'login');
        $context->addParam('username', 'bob');
        $context->addParam('pass', 'tiddles');

        // 注意，控制器不知道命令对象内部会进行哪些处理。
        // 正是这种与命令执行细节的独立性使得我们可以添加新的Command类，
        // 而不会对目前的对象结构造成较大影响。
        $controller->process();

        print $context->getError();

    }

    public static function run2()
    {
        $controller = new Controller();
        $context = $controller->getContext();

        $context->addParam('action', 'feedback');
        $context->addParam('email', 'bob@bob.com');
        $context->addParam('topic', 'my brain');
        $context->addParam('msg', 'all about my brain');
        $controller->process();

        print $context->getError();
    }
}
