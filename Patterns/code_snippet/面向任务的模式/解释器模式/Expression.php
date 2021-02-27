<?php
declare(strict_types = 1);

namespace popp\ch11\batch01;

/**
 * 用解释器模式构建了解析一门迷你语言的引擎。
 *
 * 解释器（Interpreter）模式: 构造可以创建脚本应用的迷你语言解释器。
 *
 * 一门编程语言总是用其他语言编写的（至少期初是这样），例如PHP就是用C语言编写的。
 * 虽然听起来有些奇怪，但出于这个原因，我们也可以用PHP编写自己的编程语言。
 *
 * 当用PHP创建Web（或命令行）接口时，实际上是赋予了用户使用系统功能的权限。
 *
 * 通过为这些用户提供一种领域语言（DSL，Domain Specific Language），我们可以扩展应用的功能。
 *
 * 允许用户通过我们的脚本执行PHP程序相当于为用户提供了访问运行脚本的服务器权限。
 *
 * 迷你语言能够解决这两个问题。我们可以将迷你语言设计得更加灵活，降低破坏系统的可能性，并使功能更加集中。
 *
 * 语言是由表达式（也就是会解析为值的东西）组成的。
 *
 * EBNF名是什么呢？EBNF是一种用于描述语言语法的符号，
 * 它是Extend Backus-Naur Form（扩展巴斯科范式）的缩写。
 * EBNF由一系列语句（也称为部件，production）组成，
 * 每条语句又由一个名称和一个描述组成。
 * 描述中包含对其他组件和终端（既本身不包含对其他部件的引用的元素）的引用。
 * expr        =    operand { orExpr | andExpr }   表达式（expr）包含一个operand和零或多个orExpr或andExpr。
 * operand     =    ('(' expr ')' | ? string literal ? | variable )) {eqExpr}
 * orExpr      =    'or' operand
 * andExpr     =    'and' operand
 * eqExpr      =    'equals' operand
 * variable    =    '$', ? word ?
 *
 * 一旦熟悉了一个部件对另一个部件的引用，EBNF将变得相当通俗易懂。
 *
 * Class Expression
 *
 * @package popp\ch11\batch01
 */
abstract class Expression
{
    private static $keycount = 0;
    private $key;

    abstract public function interpret(InterpreterContext $context);

    // 使用一个静态计数值来生成、存储并返回一个键
    public function getKey()
    {
        if (! isset($this->key)) {
            self::$keycount++;
            $this->key = self::$keycount;
        }

        return $this->key;
    }
}
