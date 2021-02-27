<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 * 现在我们可以在运行时组合这些类的对象，从而构建在同一个请求上以不同顺序执行不同过滤操作的过滤器。
 * 以下是从这些具体类实例化的对象组合为一个过滤器的代码。
 *
 * 事实上，本例也是企业模式中的"拦截过滤器"的一个实例。
 * Alur等人在《J2EE核心模式》一书中介绍过拦截过滤器模式。
 *
 * Class Runner
 *
 * @package popp\ch10\batch07
 */
class Runner
{
    public static function run()
    {
        $process = new AuthenticateRequest(new StructureRequest(
            new LogRequest(
                new MainProcess()
            )
        ));
        $process->process(new RequestHelper());
    }
}
