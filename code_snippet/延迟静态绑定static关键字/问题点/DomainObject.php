<?php

abstract class DomainObject
{
    public static function create(): DomainObject
    {
        // self对该类的作用与$this对对象的作用不安全相同。
        // self不是指调用上下文，而是指解析上下文。
        // 也就是说，self指向的是定义了create()方法的DomainObject，而不是发生调用的Document。
//        return new self();

        // 延迟静态绑定
        // static与self类似，区别在于前者引用的是被调用的类，而不是包含类
        return new static();
    }
}
