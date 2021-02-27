<?php
declare(strict_types = 1);

namespace popp\ch09\batch01;

use popp\ch09\batch02\NastyBossNew;

class Runner
{
    public static function run()
    {
        $boss = new NastyBoss();
        $boss->addEmployee("harry");
        $boss->addEmployee("bob");
        $boss->addEmployee("mary");
        $boss->projectFails();
    }

    public static function run1()
    {
        // 修改后的NastyBossNew类可以与Employee类型协作，因此可以享受多态带来的好处，
        // 但我们仍然没有确立创建对象的策略。
        $boss = new NastyBossNew();
        $boss->addEmployee(new Minion("harry"));
        $boss->addEmployee(new CluedUp("bob"));
        $boss->addEmployee(new Minion("mary"));
        $boss->projectFails();
        $boss->projectFails();
        $boss->projectFails();
    }

    public static function run2()
    {
        $boss = new NastyBoss();
        $boss->addEmployee(Employee::recruit("harry"));
        $boss->addEmployee(Employee::recruit("bob"));
        $boss->addEmployee(Employee::recruit("mary"));
        $boss->projectFails();
        $boss->projectFails();
        $boss->projectFails();
    }
}
