<?php
declare(strict_types=1);

namespace popp\ch06\batch03;

// 定义类型接口的抽象基类。

/**
 *         面向对象编程与面向过程编程的几点区别
 * 职责：
 *    面向过程的代码忙于处理细节，而面向对象的代码则通过接口来工作，无须关心实现细节。
 * 内聚：
 *   面向过程的代码分离了相关的处理过程，处理某一问题的代码散布在多个函数中，如果代码间的关联性很强，那么维护就会变得非常困难，
 *   因为修改一处代码时需要找出其他所有受影响的地方并一同修改。所以，面向过程的代码往往低内聚。
 *   面向对象中的类将相关的处理过程集中到了一个上下文中。处理某一问题的各方法在一个上下文中，它们之间可以共享数据，且当其中一个方法
 *   发生改变时，也很容易将它们反映到另一个方法中。因此，可以说类往往都是高内聚。
 * 耦合：
 *   面向过程这种按照顺序执行处理的特性很容易滋生紧耦合。往往某些相关的函数中的一个函数中的逻辑发生变化，那么这种变化必须反映到另外的函数中。
 *   面向对象中，子类间以及调用方代码间都被解耦了。如果要新增一种相似的处理，简单地创建一个新的子类即可。
 * 正交：
 *   正交指的是将职责相关的组件紧紧结合在一起，但与外部系统环境隔离开。
 *   面向对象的代码中类的相互组合和关联往往具有清晰的输入和输出，且完全独立于外部上下文。更易于修改，因为要修改的代码一定位于正在发生变化的
 *   组件的内部。正交的代码也更加健壮。bug的影响局限于作用域内部。面向过程的代码之间往往互相高度依赖，一处有bug就很容易在外部代码中引发连锁反应。
 *
 *  如果用单词来形容职责，那么单词的数量不能超过25个，并且不能用到"且"与"或"等词。
 *  如果描述职责的句子太长或有复杂的从句，那么应当考虑定义新类来完成其中的部分职责。
 *
 * 在局部方法中进行数据持久化处理也可以免去创建与被保存类相关的持久化类的麻烦，从而避免所谓的耦合。
 *
 * 定义类的边界出乎意料地困难，特别是要构建的系统会不断升级时。
 * Class ParamHandler
 *
 * @package popp\ch06\batch03
 */
abstract class ParamHandler
{
    protected $source;
    protected $params = [];

    public function __construct(string $source)
    {
        $this->source = $source;
    }

    public function addParam(string $key, string $val)
    {
        $this->params[$key] = $val;
    }

    public function getAllParams(): array
    {
        return $this->params;
    }

    protected function openSource(string $flag)
    {
        $fh = @fopen($this->source, $flag);
        if (empty($fh)) {
            throw new Exception("could not open: $this->source!");
        }
        return $fh;
    }

    // 将用于生成子对象的静态方法放在父类中非常有用
    // ParamHandler 类型现在只能与中心条件语句中规定的具体类协作。
    // 修改文件本身并不困难，麻烦的是每次重新安装这个包时都需要再修改一次。
    public static function getInstance(string $filename): ParamHandler
    {
        if (preg_match("/\.xml$/i", $filename)) {
            return new XmlParamHandler($filename);
        }
        return new TextParamHandler($filename);
    }

    abstract public function write(): bool;
    abstract public function read(): bool;
}
