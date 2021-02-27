<?php
declare(strict_types = 1);

namespace popp\ch13\batch04;

/**
 * 应该何时保存对象？
 *
 * 一直在执行完某个命令后从表示层发出保存命令。
 * 实际上，这种设计策略的性能开销非常昂贵。
 *
 *
 * 工作单元模式可以帮助我们只保存那些需要保存的对象。
 *
 * 这个问题在某些方面与标识映射模式中的问题相似，
 * 都涉及不必要的对象加载。
 * 在标识映射模式中，
 * 这个问题出现在处理的开始处，
 * 但在本模式中，这个问题出现在处理的结束处。
 * 就像这两个问题是相对的，
 * 它们的解决方案也是相对的。
 *
 * 为了判断哪些数据库操作是必须的，
 * 我们需要跟踪与对象相关的各种事件。
 * 也许编写跟踪处理最好的地方就是这些被跟踪对象本身。
 *
 * 工作单元模式非常实用，
 * 但需要注意几个问题。
 * 我们需要确保所有修改操作一定会将被修改的对象标记为"脏对象"。
 * 无法做到可能会导致难以察觉的错误。
 *
 * 你可能还想知道有没有其他检查对象是否被修改的方式。
 * "反射"听起来像是一个很好的选择，
 * 但是我们必须注意到这种检查对性能的影响，
 * 因为工作单元模式旨在提高效率，
 * 而非降低效率。
 *
 *
 * Class ObjectWatcher
 *
 * @package popp\ch13\batch04
 */
class ObjectWatcher
{

    // ObjectWatcher

    private $all = [];
    // 从数据库取出对象并对其进行修改后，
    // 这个对象就称为"脏对象"。
    private $dirty = [];
    // 新创建的对象会添加到$new数组中
    private $new = [];
    private $delete = []; // unused in this example
    private static $instance = null;


    private function __construct()
    {
    }

    public static function reset()
    {
        self::$instance = null;
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new ObjectWatcher();
        }

        return self::$instance;
    }

    public function globalKey(DomainObject $obj): string
    {
        $key = get_class($obj) . "." . $obj->getId();

        return $key;
    }

    public static function add(DomainObject $obj)
    {
        $inst = self::instance();
        $inst->all[$inst->globalKey($obj)] = $obj;

        return $obj;
    }

    public static function exists($classname, $id)
    {
        $inst = self::instance();
        $key = "{$classname}.{$id}";

        if (isset($inst->all[$key])) {
            return $inst->all[$key];
        }

        return null;
    }

    public static function addDelete(DomainObject $obj)
    {
        $inst = self::instance();
        $inst->delete[self::globalKey($obj)] = $obj;
    }

    public static function addDirty(DomainObject $obj)
    {
        $inst = self::instance();

        if (! in_array($obj, $inst->new, true)) {
            $inst->dirty[$inst->globalKey($obj)] = $obj;
        }
    }

    public static function addNew(DomainObject $obj)
    {
        $inst = self::instance();
        // we don't yet have an id
        $inst->new[] = $obj;
    }

    // 将脏对象标记为干净对象，
    // 那么它就不会更新到数据库中。
    public static function addClean(DomainObject $obj)
    {
        $inst = self::instance();
        unset($inst->delete[$inst->globalKey($obj)]);
        unset($inst->dirty[$inst->globalKey($obj)]);

        $inst->new = array_filter(
            $inst->new,
            function ($a) use ($obj) {
                return !($a === $obj);
            }
        );
    }

    // 处理存储在这些数组中的所有对象
    // 以更新或插入对象。
    public function performOperations()
    {
        foreach ($this->dirty as $key => $obj) {
            $obj->getFinder()->update($obj);
        }

        foreach ($this->new as $key => $obj) {
            $obj->getFinder()->insert($obj);
            print "inserting " . $obj->getName() . "\n";
        }

        $this->dirty = [];
        $this->new = [];
    }
}
