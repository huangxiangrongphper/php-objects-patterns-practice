<?php

namespace popp\ch10\batch03;

class Runner
{
    public static function run()
    {

        $tank =  new Tank();
        $tank2 = new Tank();
        $soldier = new Soldier();

        $army = new Army();
        $army->addUnit($soldier);
        $army->addUnit($tank);
        $army->addUnit($tank2);

        print_r($army);

        $army->removeUnit($tank2);

        print_r($army);
    }

    // 组合模式的优点
    // 灵活性：因为组合模式中的所有类属于同一个父类型，所以在设计中加入新的组合对象或叶子对象对外部没有任何影响。
    // 简单性：使用组合结构的客户端调用一个简单的接口即可，因为它无须知道所使用的对象到底是组合对象还是叶子对象（除非要添加新组件）。
    // 调用Army::bombardStrength()会引发一些幕后的委托调用，但对客户端而言，无论是过程还是效果，都和调用Archer::bombardStrength()方法完全相同。
    // 隐式影响范围：组合模式中的对象以树形结构组织在一起。每个组合对象都持有指向子对象的引用。因此，对对象树上的某一个部分进行操作可能会产生很大影响。
    // 例如，我们可能需要从一个Army父对象中移除一个Army子对象并将其加入其他Army父对象。这个简单的动作看似只会对Army子对象产生影响，但实际上
    // 会影响Army子对象中所引用的Unit对象及其子对象的状态。
    // 显示影响范围：树形结构遍历起来非常简单。我们可以遍历树形结构来得到对象信息或对对象执行操作。

    // 通常只有站在客户端代码的角度时才能看到模式带来的好处，因此接下来我将创建一些Army对象。
    public static function run2()
    {
        // create an army
        $main_army = new Army();

        // add some units
        $main_army->addUnit(new Archer());
        $main_army->addUnit(new LaserCannonUnit());

        // create a new army
        $sub_army = new Army();

        // add some units
        $sub_army->addUnit(new Archer());
        $sub_army->addUnit(new Archer());
        $sub_army->addUnit(new Archer());

        // add the second army to the first
        $main_army->addUnit($sub_army);

        // all the calculations handled behind the scenes
        // 在幕后计算所有队伍的攻击力并得到总的攻击力，
        // 可以看到，组合结构隐藏了所有的复杂性。
        print "attacking with strength: {$main_army->bombardStrength()}\n";
    }
}
