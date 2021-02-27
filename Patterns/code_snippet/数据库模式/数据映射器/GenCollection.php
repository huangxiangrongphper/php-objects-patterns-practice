<?php
declare(strict_types = 1);

namespace popp\ch13\batch01;

/**
 * 用生成器替代Iterator接口
 *
 * 生成器是设置轻量级迭代器的最简方法。
 *
 * 生成器是一个可以返回多个值的函数，
 * 通常位于循环中。
 * 生成器函数不使用return关键字，
 * 而是使用yield关键字。
 *
 * 在PHP处理器在函数中看到yield时，
 * 它将返回一个Generator类型的Iterator给调用方代码，
 * 而调用方可以像操作任何Iterator一样操作它。
 * 只有生成器的next()方法被调用，要求返回下一个值时，
 * yield值的循环才会继续运行。
 *
 * 流程如下：
 * 客户端代码调用生成器函数（含有yield关键字的函数）。
 * 生成器函数中有一个通过yield关键字返回多个值的循环或重复处理。
 * 看到yield后，PHP处理器就会创建一个Generator对象并将其返回给客户端代码
 * 此时生成器函数中的重复处理会暂时停止。
 * 客户端代码在接收到这个Generator对象后会像处理Iterator一样操作它，
 * 可能会使用foreach语句来遍历它。
 * 对于foreach的每次迭代，Generator对象都会从生成器函数中获取下一个值。
 *
 * Class GenCollection
 *
 * @package popp\ch13\batch01
 */
abstract class GenCollection
{
    protected $mapper;
    protected $total = 0;
    protected $raw = [];

    private $result;
    private $pointer = 0;
    private $objects = [];

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

        if (! ($object instanceof $class )) {
            throw new AppException("This is a {$class} collection");
        }

        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    // 将生成器方法作为工厂
    public function getGenerator()
    {
        for ($x = 0; $x < $this->total; $x++) {
            yield $this->getRow($x);
        }
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

        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
            return $this->objects[$num];
        }
    }
}
