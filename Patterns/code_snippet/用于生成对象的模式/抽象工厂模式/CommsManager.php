<?php
declare(strict_types = 1);

namespace popp\ch09\batch09;

/**
 * 工厂模式常常与抽象工厂模式一起使用。
 *
 * 在大型应用中，我们可能需要工厂来生成一组相关的类。抽象工厂模式可以解决这个问题。
 * Class CommsManager
 *
 * @package popp\ch09\batch09
 */
abstract class CommsManager
{
    abstract public function getHeaderText(): string;
    abstract public function getApptEncoder(): ApptEncoder;
    abstract public function getTtdEncoder(): TtdEncoder;
    abstract public function getContactEncoder(): ContactEncoder;
    abstract public function getFooterText(): string;
}
