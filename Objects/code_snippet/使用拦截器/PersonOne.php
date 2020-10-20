<?php
declare(strict_types=1);

namespace popp\ch04\batch17;

class PersonOne
{
    private $myname;
    private $myage;

    // 当客户端视图对未定义属性赋值时，__set()方法会调用。它接收两个参数--属性名，
    // 以及客户端视图赋于该属性的值。(setter方法)
    public function __set(string $property, $value)
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }

    // 当对未定义属性调用unset()方法时，__unset会被调用，接收属性名作为参数。
    public function __unset(string $property)
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            $this->$method(null);
        }
    }

    public function setName(string $name)
    {
        $this->myname = $name;
        if (! is_null($name)) {
            $this->myname = strtoupper($this->myname);
        }
    }

    public function setAge(int $age)
    {
        $this->myage = $age;
    }
}

