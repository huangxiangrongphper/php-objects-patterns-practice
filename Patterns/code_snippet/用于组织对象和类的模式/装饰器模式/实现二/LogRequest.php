<?php
declare(strict_types = 1);

namespace popp\ch10\batch07;

/**
 * 具体的装饰器类
 * 记住，组合与继承是同时使用的。
 * 因此，虽然继承自ProcessRequest，但LogRequest表现为ProcessRequest对象的一个包装器
 *
 * 如果基类实现了许多方法，那么装饰器对象不得不将这些方法委托给它们所包装的对象中public的方法。
 * 虽然可以定义一个抽象装饰器类来完成这一点，但这仍然会引入耦合并导致bug产生。
 *
 * 有些程序员创建的装饰器对象不与其所包装的对象共享相同的类型。
 * 不过，只要这些装饰器的接口与其所包装的对象接口相同，那么这种策略也是可行的。
 * 虽然借助PHP内置的拦截器方法进行自动委托（实现_call()方法），在捕捉到尝试调用不存在的方法时，自动调用子对象中的相同方法）很便利，
 * 但这么做会失去类类型检查所带来的健壮性。本示例中，客户端代码要求传入的参数是Tile或ProcessRequest对象，
 * 无论这个对象是否经过大量装饰，都可以确定这个对象提供了哪些接口。
 * Class LogRequest
 *
 * @package popp\ch10\batch07
 */
class LogRequest extends DecorateProcess
{
    public function process(RequestHelper $req)
    {
        print __CLASS__ . ": logging request\n";
        $this->processrequest->process($req);
    }
}
