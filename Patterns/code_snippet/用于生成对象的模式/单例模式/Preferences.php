<?php
declare(strict_types = 1);

namespace popp\ch09\batch04;

/**
 * 具有良好设计的系统一般都通过方法调用传递对象实例。
 * 每个类都会与外部环境保持独立，
 * 通过清晰的沟通方式与系统中的其他部分协作。
 * 有时这会迫使我们使用一些类作为对象间的沟通方式，
 * 结果导致以良好设计的名义引入了依赖关系。
 *
 * 在面向对象的设计中，单例优于全局变量，因为这样可以防止其他代码向单例写入错误类型的数据。
 * Class Preferences
 *
 * @package popp\ch09\batch04
 */
class Preferences
{
    private $props = [];
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Preferences();
        }
        return self::$instance;
    }

    public function setProperty(string $key, string $val)
    {
        $this->props[$key] = $val;
    }

    public function getProperty(string $key): string
    {
        return $this->props[$key];
    }
}
