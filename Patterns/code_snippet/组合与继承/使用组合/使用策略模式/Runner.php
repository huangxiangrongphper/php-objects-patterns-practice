<?php
declare(strict_types=1);
namespace popp\ch08\batch02;

use popp\ch08\batch02\Lecture;
use popp\ch08\batch02\Seminar;

class Runner
{
    public static function run()
    {
        // 通过在运行时传递不同的CostStrategy对象给Lesson对象，我们可以改变Lesson对象的计费策略，
        // 从而提高代码的灵活性。现在我们可以动态地组合和重组对象，以取代代码的静态功能。

        // 可以看到，这种结构的一个优点是各个类的职责更加集中。CostStrategy对象只负责计算费用。
        // Lesson对象则只负责管理课程数据。

        // 相比于只使用继承，组合对象能够使代码更加灵活，因为对象能够以多种方式动态地组合来处理任务。
        // 不过这也会降低代码的可读性。要想使用组合，需要先创建更多的类型，而且这些类型间的关系
        // 并不像继承关系中那样固定，因此理解系统中的类和对象之间的关系会更加困难。
        $lessons[] = new Seminar(4, new TimedCostStrategy());
        $lessons[] = new Lecture(4, new FixedCostStrategy());

        foreach ($lessons as $lesson) {
            print "lesson charge {$lesson->cost()}. ";
            print "Charge type: {$lesson->chargeType()}\n";
        }
    }

}
