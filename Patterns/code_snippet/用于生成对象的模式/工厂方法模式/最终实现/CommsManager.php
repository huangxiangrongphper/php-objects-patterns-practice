<?php
declare(strict_types = 1);

namespace popp\ch09\batch08;

/**
 * 工厂方法分离了创建者类与其负责创建的产品类。
 * 创建者是一个工厂类，它定义了用于生成产品对象的方法。
 * 如果这个方法没有具体实现，那么它会将实例化工作交给子类执行。
 * 通常来说，每个创建者子类负责实例化一个相应的产品子类。
 * Class CommsManager
 *
 * @package popp\ch09\batch08
 */
abstract class CommsManager
{
    abstract public function getHeaderText(): string;
    abstract public function getApptEncoder(): ApptEncoder;
    abstract public function getFooterText(): string;
}
