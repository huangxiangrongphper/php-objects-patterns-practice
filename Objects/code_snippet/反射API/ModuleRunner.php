<?php
declare(strict_types=1);

namespace popp\ch05\batch08;

/**
 *                       反射的使用举例
 * 目的是可以在不进行任何硬编码的情况下，类可以将第三方插件加载到应用中。
 *
 * 可以在本类中编写一个方法来遍历Module对象，并调用每个对象的execute()方法，即可实现插件的动态加载。
 *
 * Class ModuleRunner
 *
 * @package popp\ch05\batch08
 */
class ModuleRunner
{
    private $configData = [
        "popp\\ch05\\batch08\\PersonModule" => ['person' => 'bob'],
        "popp\\ch05\\batch08\\FtpModule"    => [
            'host' => 'example.com',
            'user' => 'anon'
        ]
    ];

    private $modules = [];

    // ...

    // class ModuleRunner
    public function init()
    {
        $interface = new \ReflectionClass('popp\\ch05\\batch08\\Module');
        foreach ($this->configData as $modulename => $params) {
            $module_class = new \ReflectionClass($modulename);
            if (! $module_class->isSubclassOf($interface)) {
                throw new Exception("unknown module type: $modulename");
            }
            // 创建实例 并将它们传递给相应类的构造方法
            $module = $module_class->newInstance();
            foreach ($module_class->getMethods() as $method) {
                $this->handleMethod($module, $method, $params);
                // we cover handleMethod() in a future listing!
            }
            array_push($this->modules, $module);
        }
    }


    // class ModuleRunner
    // 检查并调用Module对象的setter方法
    public function handleMethod(Module $module, \ReflectionMethod $method, $params)
    {
        $name = $method->getName();
        // 方法所需的参数的对象数组
        $args = $method->getParameters();

        if (count($args) != 1 || substr($name, 0, 3) != "set" ) {
            return false;
        }

        // 移除方法名前的set得到属性名
        $property = strtolower(substr($name, 3));

        // 如果属性名不存在$params数组中，那么handleMethod()会放弃设置属性并返回false。
        if (! isset($params[$property])) {
            return false;
        }

        // 提供参数的类型信息
        // 如果该方法返回一个空值，则表示该方法接收一个基本类型的参数，否则表示它接收一个对象。
        $arg_class = $args[0]->getClass();

        // invoke 接受一个对象，调用静态方法时invoke的第一个参数为null
        // 以及任意数量的方法参数
        if (empty($arg_class)) {
            // $module对象 $method方法 $params[$property] 对象所需的方法参数
            $method->invoke($module, $params[$property]);
        } else {
            $method->invoke(
                $module,
                // 这里就是实例化 PersonModule 的setPerson 方法 所需的Person类对象的实例
                // $property 在这里就是传递给 Person类的构造方法所需的bob参数值
                $arg_class->newInstance($params[$property])
            );
        }
    }

}
