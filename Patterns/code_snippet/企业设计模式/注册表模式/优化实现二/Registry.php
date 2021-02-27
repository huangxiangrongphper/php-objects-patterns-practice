<?php
declare(strict_types = 1);

namespace popp\ch12\batch04;

/**
 * 变量的生命周期也可以用时间测量。
 *
 * 变量作用域有三种级别：标注级别是HTTP请求从开始到结束、会话变量、应用作用域
 *
 * 虽然请求作用域的注册表有初始化开销，但通常我们可以用缓存策略来减少这种开销。
 *
 * 注册表对象提供的数据具有全局性质。
 * 这意味着所有使用注册表的客户端类都会与注册表提供的数据产生一种依赖关系，
 * 而且这种关系并没有体现在其接口申明中。
 * 如果过度依赖注册表对象来获取系统中的大量数据，
 * 这可能会成为一个严重的问题。
 * 最佳实践是用注册表对象获取一组具有明确定义的数据项。
 *
 * Class Registry
 *
 * @package popp\ch12\batch04
 */
class Registry
{
    private static $instance = null;
    private $request = null;


    // class Registry

    private $treeBuilder = null;
    private $conf = null;

    // ...


    // class Registry
    // Registry对象也可以用于测试
    private static $testmode = false;

    // ...

    private function __construct()
    {
    }


    public static function testMode(bool $mode = true)
    {
        self::$instance = null;
        self::$testmode = $mode;
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            // 提供模拟的Registry对象。
            if (self::$testmode) {
                self::$instance = new MockRegistry();
            } else {
                self::$instance = new self();
            }
        }

        return self::$instance;
    }

    public function getRequest(): Request
    {
        if (is_null($this->request)) {
            $this->request = new Request();
        }

        return $this->request;
    }

    // TreeBuilder 和 Conf都是虚构的类，
    // 用于展示我想要讲解的要点。
    // 如果一个客户端类需要TreeBuilder对象，
    // 那么它可以简单地调用Registry::treeBuilder(),
    // 而不用担心初始化过程的复杂性。
    public function treeBuilder(): TreeBuilder
    {
        if (is_null($this->treeBuilder)) {
            // 这种复杂性可能包括虚拟Conf对象这样的应用级数据，
            // 而且系统中的大多数类都应该与这样的类隔离开来。
            $this->treeBuilder = new TreeBuilder($this->conf()->get('treedir'));
        }

        return $this->treeBuilder;
    }

    public function conf(): Conf
    {
        if (is_null($this->conf)) {
            $this->conf = new Conf();
        }

        return $this->conf;
    }

}
