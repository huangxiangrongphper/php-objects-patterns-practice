<?php
declare(strict_types = 1);

namespace popp\ch13\batch01;

/**
 * 返回大量对象的数组将是昂贵的性能开销。
 * 如果简单地返回一个数组，
 * 并让调用方代码实例化对象。
 * 这是可行的，
 * 但违反了设计Mapper类的初衷。
 *
 * 使用内置的Iterator接口可以解决这个问题。
 *
 * Iterator接口要求实现类来定义查询数据集的方法。
 * 这样我们就可以像使用foreach循环遍历数组那样遍历我们的类。
 *
 * 客户端不知道迭代器内部如何获取数据、对数据排序以及过滤数据。
 *
 *
 * Class Collection
 *
 * @package popp\ch13\batch01
 */
abstract class Collection implements \Iterator
{
    protected $mapper;
    protected $total = 0;
    protected $raw = [];

    private $pointer = 0;
    private $objects = [];

    // 如果希望程序更加健壮，
    // 还可以在构造方法中进行额外的检查。
    // 在 SpaceMapper findByVenue 方法中 可以看到这个构造方法的用法
    public function __construct(array $raw = [], Mapper $mapper = null)
    {
        $this->raw = $raw;
        $this->total = count($raw);

        if (count($raw) && is_null($mapper)) {
            throw new AppException("need Mapper to generate objects");
        }

        $this->mapper = $mapper;
    }

    public function add(DomainObject $object)
    {
        $class = $this->targetClass();

        if (! ($object instanceof $class)) {
            throw new AppException("This is a {$class} collection");
        }

        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    abstract public function targetClass(): string;

    protected function notifyAccess()
    {
        // deliberately left blank!
    }

    private function getRow($num)
    {
        $this->notifyAccess();

        if ($num >= $this->total || $num < 0) {
            return null;
        }

        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }

        // 数组索引是相应的行号
        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);

            return $this->objects[$num];
        }
    }

    // 让指针指向集合中的第一个元素
    public function rewind()
    {
        $this->pointer = 0;
    }

    // 返回指针指向的当前位置的元素
    public function current()
    {
        return $this->getRow($this->pointer);
    }

    // 返回当前元素的键（即指针值）
    public function key()
    {
        return $this->pointer;
    }

    // 返回指针指向的当前位置的元素并让指针指向下一个元素
    public function next()
    {
        $row = $this->getRow($this->pointer);

        if (! is_null($row)) {
            $this->pointer++;
        }
    }

    // 确认指针指向的当前位置存在元素
    public function valid()
    {
        return (! is_null($this->current()));
    }
}
