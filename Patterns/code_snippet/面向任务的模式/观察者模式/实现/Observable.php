<?php
declare(strict_types = 1);

namespace popp\ch11\batch05;

/**
 *
 * 在观察者模式中，知道了如何向不同的组件发送系统事件的通知。
 *
 * 观察者模式的核心是将客户端组件（观察者）从中心类（主体）中分离出来。
 * 主体知道发生某个事件后会通知观察者。同时，我们不希望硬编码主体与观察者类间的关系。
 *
 * 为了达到这个目的，我们可以允许观察者将自己注册到主体上。
 *
 * Interface Observable
 *
 * @package popp\ch11\batch05
 */
interface Observable
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}
