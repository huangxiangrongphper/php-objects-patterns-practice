<?php
declare(strict_types = 1);

namespace popp\ch11\batch01;

class InterpreterContext
{
    // 用于保存数据的关联数组
    private $expressionstore = [];

    // 接收一个表示键的Expression对象和一个任意类型的值。
    public function replace(Expression $exp, $value)
    {
        $this->expressionstore[$exp->getKey()] = $value;
    }

    public function lookup(Expression $exp)
    {
        return $this->expressionstore[$exp->getKey()];
    }
}
