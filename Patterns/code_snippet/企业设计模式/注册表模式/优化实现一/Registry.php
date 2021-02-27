<?php
declare(strict_types = 1);

namespace popp\ch12\batch03;

/**
 * 修改Registry类，使其基于键来存储和获取数据
 * 这样做的好处是，我们不需要为每个想要存储和提供的对象分别创建方法。
 * 但缺点是重新引入了全局变量。
 * 使用任意字符串作为存储对象的键，意味着在添加对象时没有任何方法能够阻止系统中的某部分覆盖键值对。
 * 开发过程中可以首选使用这种类似map结构，然后在明确知道要存储和获取的数据后，
 * 转而使用显式命名的类方法。
 *
 * 注册表模式并不是管理系统所需服务的唯一方式。
 * 依赖注入也可以达到类似的效果。
 *
 * 我们也可以将注册表对象用作系统中生成常用对象的工厂。
 *
 * 此时Registry类不再存储接收到的对象，而是自己创建一个实例并缓存该实例的引用。
 * 它也可以在幕后进行一些对象的初始化工作，
 * 如从配置文件中获取数据或组合多个对象。
 *
 *
 * Class Registry
 *
 * @package popp\ch12\batch03
 */
class Registry
{
    private static $instance = null;
    private $values = [];

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    public function set(string $key, $value)
    {
        $this->values[$key] = $value;
    }
}
