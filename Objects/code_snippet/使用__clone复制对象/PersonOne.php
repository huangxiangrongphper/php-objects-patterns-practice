<?php
declare(strict_types=1);

namespace popp\ch04\batch21;

class PersonOne
{
    // 浅复制可以确保基本类型的属性会从旧对象中被复制到新对象中。
    private $name;
    private $age;
    private $id;

    // 但对象属性是引用复制的，它们可能不会如我们所预想的那样被复制。
    public  $account;

    public function __construct(string $name, int $age, Account $account)
    {
        $this->name = $name;
        $this->age  = $age;
        $this->account = $account;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

//    public function __clone()
//    {
//        $this->id   = 0;
//    }

   // 如果不希望对象中的属性在对象复制后被共享，
   // 那么就应当自己在__clone()方法中显式地进行复制操作
    public function __clone()
    {
        $this->id = 0;
        $this->account = clone $this->account;
    }
}
//done
