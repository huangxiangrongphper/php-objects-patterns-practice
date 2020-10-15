<?php
declare(strict_types=1);

namespace popp\ch04\batch9;

// PHP引入了异常

/**
 * Class ConfException
 *
 * @package popp\ch04\batch10
 *
 *            异常类中的公开方法
 * getMessage            得到传递给构造方法的消息字符串
 *
 *
 *
 *
 */


class ConfException
{
    private $file;
    private $xml;
    private $lastmatch;

    public function __construct(string $file)
    {
        $this->file = $file;
        if (! file_exists($file)) {
            throw new \Exception("file '$file' does not exist");
        }
        $this->xml = simplexml_load_file($file);
    }

    public function write()
    {
        if (! is_writeable($this->file)) {
            // 异常是实例化自内置的Exception类（或它的继承类）的特殊对象
            // Exception类型的对象可以存放和报告错误信息
            throw new \Exception("file '{$this->file}' is not writeable");
        }
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get(string $str): string
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastmatch = $matches[0];
            return (string)$matches[0];
        }
        return null;
    }

    public function set(string $key, string $value)
    {
        if (! is_null($this->get($key))) {
            $this->lastmatch[0]=$value;
            return;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }
}
