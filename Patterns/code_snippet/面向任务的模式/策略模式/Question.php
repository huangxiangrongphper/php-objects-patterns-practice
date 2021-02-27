<?php
declare(strict_types = 1);

namespace popp\ch11\batch02;

/**
 * 通过策略模式，我们学习了另一种通过组合增加灵活性并减少重复创建子类的方式。
 *
 *
 * 每当发现继承树出现重复的算法（无论是以子类形式还是重复的条件语句形式）时，都可以
 * 考虑将这些行为抽象为它们自己的类型。
 *
 * 组合优于继承，定义和封装标记算法可以减少子类的数量并提高代码的灵活性。
 *
 * 我们可以随时添加新的标记策略类，而无须对Question类进行任何修改。
 *
 * Class Question
 *
 * @package popp\ch11\batch02
 */
abstract class Question
{
    protected $prompt;
    protected $marker;

    public function __construct(string $prompt, Marker $marker)
    {
        $this->prompt = $prompt;
        $this->marker = $marker;
    }

    // 所有Question类都知道它们有一个可用的Marker实例，
    // 并且这个实例一定支持Marker接口中定义的mark()方法，
    // 而mark()中的处理细节则完全是其他类的问题。
    public function mark(string $response): bool
    {
        return $this->marker->mark($response);
    }
}
