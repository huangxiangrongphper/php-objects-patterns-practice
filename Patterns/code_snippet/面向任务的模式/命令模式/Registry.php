<?php
declare(strict_types = 1);

namespace popp\ch11\batch09;

/**
 * 一个用于生成共通对象的静态方法的简单类
 *
 * Class Registry
 *
 * @package popp\ch11\batch09
 */
class Registry
{
    public static function getMessageSystem(): MessageSystem
    {
        return new MessageSystem();
    }

    public static function getAccessManager(): AccessManager
    {
        return new AccessManager();
    }
}
