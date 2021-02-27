<?php
declare(strict_types = 1);

namespace popp\ch11\batch01;

abstract class OperatorExpression extends Expression
{
    protected $l_op;
    protected $r_op;

    public function __construct(Expression $l_op, Expression $r_op)
    {
        $this->l_op = $l_op;
        $this->r_op = $r_op;
    }

    public function interpret(InterpreterContext $context)
    {
        // 首先会调用两个运算子属性的interpret()方法（这里运用了组合模式）
        $this->l_op->interpret($context);
        $this->r_op->interpret($context);

        // 查找每个运算子属性的结果
        $result_l = $context->lookup($this->l_op);
        $result_r = $context->lookup($this->r_op);
        $this->doInterpret($context, $result_l, $result_r);
    }

    // 模板方法，父类定义并调用抽象方法，
    // 然后交由子类决定提供一个怎样的实现。
    abstract protected function doInterpret(
        InterpreterContext $context,
        $result_l,
        $result_r
    );
}
