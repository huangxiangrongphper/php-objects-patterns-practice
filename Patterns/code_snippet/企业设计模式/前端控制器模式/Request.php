<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 * 最好将请求相关的操作集中在一个地方，所以定义了一个Request类。
 *
 * 例如可以过滤传入的请求，或者从HTTP请求以外的地方收集请求参数，
 * 从而允许从命令行或测试脚本运行应用。
 *
 * Request对象也是一个有用的存储库，它可以存储需要传递给视图层的数据。
 *
 *
 * Class Request
 *
 * @package popp\ch12\batch05
 */
abstract class Request
{
    protected $properties;
    protected $feedback = [];
    protected $path = "/";

    public function __construct()
    {
        $this->init();
    }

    abstract public function init();

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getProperty(string $key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }

        return null;
    }

    public function setProperty(string $key, $val)
    {
        $this->properties[$key] = $val;
    }

    public function addFeedback(string $msg)
    {
        array_push($this->feedback, $msg);
    }

    public function getFeedback(): array
    {
        return $this->feedback;
    }

    public function getFeedbackString($separator = "\n"): string
    {
        return implode($separator, $this->feedback);
    }

    public function clearFeedback()
    {
        $this->feedback = [];
    }
}
