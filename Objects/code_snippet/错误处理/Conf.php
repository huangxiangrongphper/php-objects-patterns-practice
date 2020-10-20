<?php
declare(strict_types=1);

namespace popp\ch04\batch11;

class Conf
{
    private $file;
    private $xml;
    private $lastmatch;

    public function __construct(string $file)
    {
        $this->file = $file;
        if (! file_exists($file)) {
            throw new FileException("file '$file' does not exist");
        }

        // LIBXML_NOERROR 会阻止程序直接输出警告信息
        $this->xml = simplexml_load_file($file, null, LIBXML_NOERROR);
        if (! is_object($this->xml)) {
            throw new XmlException(libxml_get_last_error());
        }
        $matches = $this->xml->xpath("/conf");
        if (! count($matches)) {
            throw new ConfException("could not find root element: conf");
        }
    }

    public function write()
    {
        // 当我们抛出异常时，就意味着强制客户端代码负责处理这个异常。
        // 当方法检测到错误，但又缺少足够的上下文信息处理它时，就应当抛出异常。
        // 例如write() 方法知道什么时候尝试写文件可能会失败，以及为什么失败，但不知道如何处理失败。
        // 事情本该就应当是这样的，因为要是让Conf知道更多信息，它的功能就会变得不单一，可复用性也会降低。
        if (! is_writeable($this->file)) {
            throw new \Exception("file '{$this->file}' is not writeable");
        }
        file_put_contents($this->file, $this->xml->asXML());
    }

    public function get($str)
    {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastmatch = $matches[0];
            return (string)$matches[0];
        }
        return null;
    }

    public function set($key, $value)
    {
        if (! is_null($this->get($key))) {
            $this->lastmatch[0]=$value;
            return;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);
    }
}
