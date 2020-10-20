<?php
declare(strict_types=1);

namespace popp\ch04\batch11;

// 子类化异常 用户自定义异常
// 可以扩展异常类的功能 定义的新的异常类型能帮我们处理错误。
class XmlException extends \Exception
{
    private $error;

    // 当SimpleXML遇到一个损坏的XML文件时，会生成LibXmlError类。
    // 它与Exception类似，有一个$message属性和一个$code属性
    public function __construct(\LibXmlError $error)
    {
        $shortfile = basename($error->file);
        $msg = "[{$shortfile}, line {$error->line}, col {$error->column}] {$error->message}";
        $this->error = $error;
        parent::__construct($msg, $error->code);
    }

    public function getLibXmlError()
    {
        return $this->error;
    }
}

