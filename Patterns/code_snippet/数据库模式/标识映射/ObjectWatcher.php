<?php
declare(strict_types = 1);

namespace popp\ch13\batch03;

use popp\ch13\batch01\DomainObject;

/**
 * 标识映射：跟踪系统中的所有对象，
 * 以防止重复实例化和对数据库的不必要方法。
 *
 *  对象监听：跟踪对象、避免代码重复、自动保存和插入数据。
 *
 * 在一个系统中，
 * 重复的对象不只会带来风险，
 * 还可能导致系统性能降低。
 * 在一个进程中，一些常用的对象可能会被调用三四次，
 * 我们没有必要每次都将对象重新保存到数据库。
 *
 * 标识映射只是一个对象，
 * 其任务是跟踪系统中的所有对象，
 * 从而帮助我们确保不会出现明明希望是一个对象的两个引用，
 * 实际上却是两个对象的情况。
 *
 * 事实上，标识映射对象自身并不会主动防止这种情况发生。
 * 它只是负责管理对象信息。
 *
 *
 * 只要在所有的上下文中都使用这个标识映射对象，
 * 而且这些上下文中的对象都是从数据库中生成的或者都会保存到数据库，
 * 那么进程中出现重复对象的可能性几乎为零。
 *
 * 当然，这只在进程中有效。
 * 不同的进程将不可避免地在同一时间访问相同对象的不同版本。
 *
 * 有时我们需要考虑并发访问可能会导致数据损坏。
 * 如果问题很严重，
 * 那么可能需要考虑"锁"策略。
 * 我们还可以考虑将对象存储在共享内存中或使用一个外部对象缓存系统，
 * 如Memcached。
 *
 * Class ObjectWatcher
 *
 * @package popp\ch13\batch03
 */
class ObjectWatcher
{
    private $all = [];
    private static $instance = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new ObjectWatcher();
        }

        return self::$instance;
    }

    // 显然，
    // 使用标识映射对象的技巧在于如何标识对象。
    public function globalKey(DomainObject $obj): string
    {
        $key = get_class($obj) . "." . $obj->getId();

        return $key;
    }

    public static function add(DomainObject $obj)
    {
        $inst = self::instance();
        $inst->all[$inst->globalKey($obj)] = $obj;
    }

    public static function exists($classname, $id)
    {
        $inst = self::instance();
        $key = "{$classname} . {$id}";

        if (isset($inst->all[$key])) {
            return $inst->all[$key];
        }

        return null;
    }
}
