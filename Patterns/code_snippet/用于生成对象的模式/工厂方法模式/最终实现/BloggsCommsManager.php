<?php
declare(strict_types = 1);

namespace popp\ch09\batch08;

/**
 * 创建者类的层次结构与产品类的层次结构相同。
 * 这是工厂模式的常见效果，形成了一种特殊的代码重复。
 * 工厂模式的另一个问题是可能会产生不必要的子类化。
 *
 * 工厂方法模式，它将多态的特性应用于对象生成。
 *
 * Class BloggsCommsManager
 *
 * @package popp\ch09\batch08
 */
class BloggsCommsManager extends CommsManager
{
    public function getHeaderText(): string
    {
        return "BloggsCal header\n";
    }

    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    }

    public function getFooterText(): string
    {
        return "BloggsCal footer\n";
    }
}
