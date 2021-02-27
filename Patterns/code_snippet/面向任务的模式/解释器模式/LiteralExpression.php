<?php
declare(strict_types = 1);

namespace popp\ch11\batch01;

class LiteralExpression extends Expression
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    // interpret()方法总是将结果记录到InterpreterContext对象中。
    public function interpret(InterpreterContext $context)
    {
        $context->replace($this, $this->value);
    }
}
