<?php
declare(strict_types = 1);

namespace popp\ch10\batch05;

/**
 * 需要担心的另外一个问题是组合对象的操作成本。
 * Army::bombardStrength()方法就是一个典型的例子，该方法会逐级调用对象树中下级分支的方法。
 *
 * 虽然组合模式难以将数据保存至关系数据库中，但其数据非常适合持久化为XML。
 * 这是因为XML元素通常都是由树形结构的子元素组成。
 *
 * 集合本质上与组件相似
 * 树形结构易于遍历
 *
 * 随着规则变得越来越复杂（如规定哪个组合对象可以持有哪些组件），代码将变得越来越难管理。
 * Class Runner
 *
 * @package popp\ch10\batch05
 */
class Runner
{
    public static function run()
    {
        $army1 = new Army();
        $army1->addUnit(new Archer());
        $army1->addUnit(new Archer());

        $army2 = new Army();
        $army2->addUnit(new Archer());
        $army2->addUnit(new Archer());
        $army2->addUnit(new LaserCannonUnit());

        $composite = UnitScript::joinExisting($army2, $army1);
        print_r($composite);
    }
}
