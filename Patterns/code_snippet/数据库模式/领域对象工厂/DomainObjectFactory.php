<?php
declare(strict_types = 1);

namespace popp\ch13\batch05;

use popp\ch13\batch04\ObjectWatcher;
use popp\ch13\batch04\DomainObject;

/**
 * 将创建领域对象的职责转移给它们自己的类型则可以带来更高的灵活性。
 *
 * 这样Mapper类和Collection类就可以共享创建领域对象的功能了。
 *
 * 需要将createObject()方法从各个映射器类中提取出来，
 *
 * 并相应地放到一组平行的类中，
 *
 * 就能实现领域对象工厂模式。
 *
 * 领域对象工厂能够解除数据库中的原始数据与对象字段数据之间的耦合。
 * 我们可以在createObject()方法中执行任意的调整，
 * 而且这个过程对于提供原始数据的客户端是透明的。
 *
 * 从映射器类移除后，
 * 其他组件就可以使用创建领域对象的功能了。
 *
 *
 * Class DomainObjectFactory
 *
 * @package popp\ch13\batch05
 */
abstract class DomainObjectFactory
{
    abstract public function createObject(array $row): DomainObject;

    // getFromMap 和 addToMap 可以防止对象重复创建
    // 或者在ObjectWatcher与createObject方法之间建立观察者关系。

    protected function getFromMap($class, $id)
    {
        return ObjectWatcher::exists($class, $id);
    }

    protected function addToMap(DomainObject $obj): DomainObject
    {
        return ObjectWatcher::add($obj);
    }
}
