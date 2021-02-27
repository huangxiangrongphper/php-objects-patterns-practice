<?php
declare(strict_types = 1);

namespace popp\ch09\batch11;

/**
 * 在使用抽象方法模式和工厂方法模式时，必须决定使用哪个具体的创建者（可能是通过检查配置的值决定的）
 * 既然必须这么做，那为什么不简单地创建一个保存具体产品的工厂类，然后在初始化工厂类时设置具体产品呢？
 * 这样，除了可以减少类的数量外，还有其他好处。
 *
 * 以下是在工厂中使用原型模式的简单示例代码。
 *
 * Class TerrainFactory
 *
 * @package popp\ch09\batch11
 */
class TerrainFactory
{
    private $sea;
    private $forest;
    private $plains;

    public function __construct(Sea $sea, Plains $plains, Forest $forest)
    {
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }

    public function getSea(): Sea
    {
        return clone $this->sea;
    }

    public function getPlains(): Plains
    {
        return clone $this->plains;
    }

    public function getForest(): Forest
    {
        return clone $this->forest;
    }
}
