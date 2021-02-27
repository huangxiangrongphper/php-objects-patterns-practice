<?php
declare(strict_types = 1);

namespace popp\ch12\batch02;

/**
 *
 * 注册表只是一个类，它提供了用于访问数据（通常是对象，但不限于对象）的静态方法（或单例对象的实例方法）。
 * 这样系统中的每个对象都可以访问这些对象。
 *
 * "注册表"模式也称为"白板"和"黑板"。
 * Class Registry
 *
 * @package popp\ch12\batch02
 */
class Registry
{
    private static $instance = null;
    private $request = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getRequest(): Request
    {
        if (is_null($this->request)) {
            $this->request = new Request();
        }

        return $this->request;
    }
}

