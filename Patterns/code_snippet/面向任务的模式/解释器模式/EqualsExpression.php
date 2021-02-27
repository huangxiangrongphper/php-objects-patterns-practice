<?php
declare(strict_types = 1);

namespace popp\ch11\batch01;

// 检查两个Expression对象是否相等。
class EqualsExpression extends OperatorExpression
{
    protected function doInterpret(InterpreterContext $context, $result_l, $result_r)
    {
            $context->replace($this, $result_l == $result_r);
    }
}
