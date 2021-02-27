<?php
declare(strict_types=1);

namespace popp\ch05\batch06;

class Delegator
{
    private $thirdpartyShop;

    public function __construct()
    {
        $this->thirdpartyShop = new OtherShop();
    }

//    public function __call($method, $args)
//    {
//        // 创建委托类的拦截器方法
//        if (method_exists($this->thirdpartyShop, $method)) {
//            return $this->thirdpartyShop->$method();
//        }
//    }

    // 当无法得知每次调用的$args数组有多大时，如果直接将$args传递给委托方法，那么传递的是一个数组参数，
    // 而不是方法所期待的各个单独的参数。call_user_func_array()可以完美的解决这个问题。
    public function __call($method, $args)
    {
        if (method_exists($this->thirdpartyShop, $method)) {
            return call_user_func_array(
                [
                    $this->thirdpartyShop,
                    $method
                ],
                $args
            );
        }
    }

}
