<?php
declare(strict_types = 1);

namespace popp\ch11\batch05;

/**
 *
 * 具体观察者类的定义
 * Class LoginAnalytics
 *
 * @package popp\ch11\batch05
 */
class LoginAnalytics implements Observer
{
    public function update(Observable $observable)
    {
        // not type safe!
        // 主体类负责定义供观察者查询状态的方法。
        // 但是这个观察者也存在问题。
        // 除非能知道更多信息，否则LoginAnalytics类无法安全地调用Login::getStatus()。
        // 它是在Observable对象上调用getStatus()的，
        // 但我们无法确保这个Observable对象一定就是Login对象。
        $status = $observable->getStatus();
        print __CLASS__ . ":    doing something with status info\n";
    }
}
