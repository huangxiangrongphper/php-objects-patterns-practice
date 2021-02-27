<?php
declare(strict_types = 1);

namespace popp\ch10\batch08;

require_once("src/ch10/batch08/legacy.php");

/**
 * 要让其他代码通过一个"入口"进入我们的系统。
 *
 * 以下类为之前面向过程代码提供一个接口。
 *
 * 外观模式是一个十分简单的概念，它只为系统中的某一层或子系统提供单一入口，
 * 但可以带来许多好处。
 * 首选，它能帮助我们解耦项目中的不同部分；其次，客户端程序员需要调用的只是
 * 一些简单的方法，这对他们来说非常方便。另外，因为只在一个地方调用子系统，所以减少了
 * 出错的可能性，而且可以确定子系统发生变化时只会对一个地方产生影响。
 *
 * 最后，Facade类还能防止客户端代码不正确调用子系统中的内部函数。
 *
 * 一方面，为复杂系统创建简单接口的好处很明显；另一方面，我们可能会过度抽象系统。
 * 总之，如果希望客户端代码能简单地调用子系统及（或）系统的改动不会影响客户端代码，
 * 那么就应该实现外观模式。
 *
 * 外观模式是被人们使用多年，却一直没有得到命名的模式之一。
 * 外观模式可以为系统中的一层或子系统提供简洁的入口。
 * 在PHP中，外观模式还可以用于创建对象包装器，以封装面向过程的代码。
 *
 * 使用继承是为了更好地组合对象并为客户端代码提供统一的接口。
 *
 * Class ProductFacade
 *
 * @package popp\ch10\batch08
 */
class ProductFacade
{
    private $products = [];

    public function __construct(string $file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile()
    {
        $lines = getProductFileLines($this->file);
        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromID($id, $name);
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProduct(string $id): \Product
    {
        if (isset($this->products[$id])) {
            return $this->products[$id];
        }
        return null;
    }
}

