<?php
declare(strict_types = 1);

namespace popp\ch09\batch14;

/**
 * 装配器组件
 *
 * Class ObjectAssembler
 *
 * @package popp\ch09\batch14
 */
class ObjectAssembler
{
    private $components = [];

    public function __construct(string $conf)
    {
        $this->configure($conf);
    }

    // 读取配置文件并根据需要实例化对象
    private function configure(string $conf)
    {
        $data = simplexml_load_file($conf);
        foreach ($data->class as $class) {
            $args = [];
            $name = (string)$class['name'];
            foreach ($class->arg as $arg) {
                $argclass = (string)$arg['inst'];
                $args[(int)$arg['num']] = $argclass;
            }
            ksort($args);

            // 将所有实例化处理放在一个匿名函数中
            // 并将匿名函数存储在$components属性中。
            // 健壮的装配器还要能够应对注入组件对象自身需要参数的可能性。、
            // 同时，还要考虑缓存的问题。
            // 例如，应该在每次getComponent()方法被调用时实例化一个对象，还是只实例化一次呢？
            $this->components[$name] = function () use ($name, $args) {
                $expandedargs = [];
                foreach ($args as $arg) {
                    $expandedargs[] = new $arg();
                }
                $rclass = new \ReflectionClass($name);
                return $rclass->newInstanceArgs($expandedargs);
            };
        }
    }

    public function getComponent(string $class)
    {
        if (! isset($this->components[$class])) {
            throw new \Exception("unknown component '$class'");
        }
        $ret = $this->components[$class]();
        return $ret;
    }
}
