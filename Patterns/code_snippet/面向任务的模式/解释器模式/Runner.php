<?php

namespace popp\ch11\batch01;

/**
 * 创建解释器模式中的核心类后就很容易扩展解释器了，
 * 但代价是需要创建的类数量会越来越多。
 * 因此，解释器模式最好应用于相对小型的语言。
 *
 * 另外，因为解释器类通常会执行相似的任务，所以最好检查是否创建了重复类。
 *
 * 许多人第一次接触解释器模式时会先兴奋一阵，继而感到失望，
 * 因为他们发现这个模式并没有解决解析问题。这意味着我们无法为用户提供一门友好的语言。
 *
 *
 *
 * Class Runner
 *
 * @package popp\ch11\batch01
 */
class Runner
{
    public static function run()
    {
        // 输出结果是 four
        $context = new InterpreterContext();
        $literal = new LiteralExpression('four');
        $literal->interpret($context);
        print $context->lookup($literal) . "\n";

    }


    public static function run2()
    {
        $context = new InterpreterContext();
        $myvar = new VariableExpression('input', 'four');
        $myvar->interpret($context);
        print $context->lookup($myvar) . "\n";
        // output: four

        $newvar = new VariableExpression('input');
        $newvar->interpret($context);
        print $context->lookup($newvar) . "\n";
        // output: four

        $myvar->setValue("five");
        $myvar->interpret($context);
        print $context->lookup($myvar) . "\n";
        // output: five
        print $context->lookup($newvar) . "\n";
        // output: five
    }

    // 现在我们的程序已经能够执行前面所描述的迷你语言片段了。
    // $input equals "4" or $input equals "four"
    public static function run3()
    {

        // 用Expression类家族创建以上迷你语言的语句。
        $context = new InterpreterContext();
        // 并没有赋值
        $input = new VariableExpression('input');
        $statement = new BooleanOrExpression(
            new EqualsExpression($input, new LiteralExpression('four')),
            new EqualsExpression($input, new LiteralExpression('4'))
        );


        // 为$input变量赋值并运行程序。
        foreach ( ["four", "4", "52"]  as $val) {
            $input->setValue($val);
            print "$val:\n";
            $statement->interpret($context);
            if ($context->lookup($statement)) {
                print "top marks\n\n";
            } else {
                print "dunce hat on\n\n";
            }
        }

        // 以上结果输出：
        // four: top marks
        // 4 : top marks
        // 52 : dunce hat on
    }
}
