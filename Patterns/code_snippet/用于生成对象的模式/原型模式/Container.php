<?php

class Container
{
    public $contained;

    public function __construct()
    {
        $this->contained = new Contained();
    }

    // 实现__clone()方法来确保进行深复制。
    public function __clone()
    {
        // 确保克隆出的对象持有self::$contained的一个副本，
        // 而不是一个指向它的引用
        $this->contained = clone $this->contained;
    }
}

