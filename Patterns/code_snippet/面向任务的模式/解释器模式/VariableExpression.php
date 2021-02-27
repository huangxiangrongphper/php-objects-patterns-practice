<?php
declare(strict_types = 1);

namespace popp\ch11\batch01;

class VariableExpression extends Expression
{
    private $name;
    private $val;

    // 接收一个名字和一个值作为构造方法的参数
    public function __construct($name, $val = null)
    {
        $this->name = $name;
        $this->val = $val;
    }

    public function interpret(InterpreterContext $context)
    {
        // 如果$val属性有值，那么它会将值设置到InterpreterContext对象中,
        // 并接着将$val设置为null,以防止另一个有相同名字的VariableExpression实例改变InterpreterContext对象中的
        // 值后再次调用interpret()方法。
        if (! is_null($this->val)) {
            $context->replace($this, $this->val);
            $this->val = null;
        }
    }

    // 客户端代码可以改变$val的值
    public function setValue($value)
    {
        $this->val = $value;
    }

    // 重写了getKey()方法，
    // 这样变量的值会与变量名关联在一起，
    // 而不是静态的ID关联
    public function getKey()
    {
        return $this->name;
    }
}
