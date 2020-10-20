<?php
declare(strict_types=1);

namespace popp\ch04\batch23;

class ProcessSale
{
    private $callbacks;

    public function registerCallback(callable $callback)
    {
        // 确保传入的值可以被call_user_func()、array_walk等函数调用。
        if (! is_callable($callback)) {
            throw new Exception("callback not callable");
        }
        $this->callbacks[] = $callback;
    }

    public function sale(Product $product)
    {
        print "{$product->name}: processing \n";
        foreach ($this->callbacks as $callback) {
            // 运行各种回调
            // 回调允许程序在运行期间将与组件核心任务没有直接关系的功能"插入"组件。
            // 通过让组件拥有回调能力，可以赋予其他程序员在我们不知道的上下文中扩展代码的能力。
            call_user_func($callback, $product);
        }
    }
}

