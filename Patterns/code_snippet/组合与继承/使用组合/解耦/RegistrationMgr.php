<?php
declare(strict_types=1);
namespace popp\ch08\batch02;

/**
 *
 *  将具体实现隐藏在干净接口后面的这种处理成为封装。
 *
 *  Doctrine 数据库库通过数据库抽象层（DBAL，database abstraction layer）项目来解决这个问题。
 *  它提供的方法只需要修改一处配置即可切换所使用的数据库。
 *  Doctrine是基于数据库抽像层上的ORM,它可以通过PHP对象轻松访问所有的数据库，例如MYSQL，
 *  它支持的PHP最低版本为5.2.3.
 *
 *  使用条件语句偶尔也会被说是实现了一个"模拟继承"
 *  创建一个RegistrationMgr作为Notifier类的示例客户端。
 *
 *  如何着手代码的设计呢？
 * 《设计模式》建议我们"封装会变化的概念"。
 * 《设计模式》建议我们积极地搜寻类中发生变化的元素并评估它们是否适合封装为一个新的类型。
 *  对于每个条件语句，我们都可以从中提取出一个抽象父类以及若干继承于这个父类的子类，然后在这条语句所处的类中使用它们。
 *  这种设计方式具有以下优点：
 *  1. 职责更加集中；
 *  2. 通过组合提高灵活性；
 *  3. 继承层次更加紧凑和集中；
 *  4. 能够减少重复代码。
 *
 * 怎样才能找出变化的概念呢？误用继承就是一个信号。误用继承的表现包括实现不同分支（演讲与研讨会，固定与按时间计费）的继承，或子类化一个
 * 不属于该类核心职责的算法。前面也提到过，适合封装的另一个信号是条件表达式。
 *
 * 极限编程（XP，extreme programming）
 *
 * 在使用PHP开发大型项目时，我们会对应用分层，将业务逻辑从表现层和持久层中分离出来。
 * 我们会结合使用各种核心模式和企业模式。
 *
 *  极限编程的第二条原则："用最简单的方式完成任务"（Do the simplest thing that works）。
 * Class RegistrationMgr
 *
 * @package popp\ch08\batch02
 *
 */
class RegistrationMgr
{
    public function register(Lesson $lesson)
    {
        // do something with this Lesson

        // now tell someone
        $notifier = Notifier::getNotifier();
        $notifier->inform("new lesson: cost ({$lesson->cost()})");
    }
}
