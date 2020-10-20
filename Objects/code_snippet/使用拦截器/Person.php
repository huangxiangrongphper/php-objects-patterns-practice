<?php
declare(strict_types=1);

namespace popp\ch04\batch15;


/**
 *  PHP提供的内置拦截器方法可以拦截发送给未定义方法和属性的信息。
 *  这也被称为重载（overloading），但是考虑到Java和C++对重载一词的解释不同，还是叫它拦截器比较好。
 *
 *
 *    方法                                  说明
 * __get($property)                 访问未定义属性时会被调用
 * __set($property, $value)         对未定义属性赋值时会被调用
 * __isset($property)               对未定义属性调用isset时会被调用
 * __unset($property)               对未定义属性调用unset时会被调用
 * __call($method, $arg_array)      调用未定义的非静态方法时会被调用
 * __callStatic($method, $arg_array) 调用未定义的静态方法时会被调用
 *
 *
 *
 *
 * Class Person
 *
 * @package popp\ch04\batch15
 */

class Person
{
    // 访问未定义属性时，__get()方法会被调用
    // 客户端视图访问的不存在的属性会被解析为NULL
    public function __get(string $property)
    {
        $method = "get{$property}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    // __isset()方法会在客户端为未定义属性调用isset()方法时被调用
    public function __isset(string $property)
    {
        $method = "get{$property}";
        return (method_exists($this, $method));
    }

    public function getName(): string
    {
        return "Bob";
    }

    public function getAge(): int
    {
        return 44;
    }
}

