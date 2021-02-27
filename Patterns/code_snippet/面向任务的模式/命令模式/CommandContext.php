<?php
declare(strict_types = 1);

namespace popp\ch11\batch09;

/**
 *
 * 从本质上讲，CommandContext就是一个围绕在关联数组对象周围的对象包装器
 * Class CommandContext
 *
 * @package popp\ch11\batch09
 */
class CommandContext
{
    private $params = [];
    private $error = "";

    public function __construct()
    {
        $this->params = $_REQUEST;
    }

    public function addParam(string $key, $val)
    {
        $this->params[$key] = $val;
    }

    public function get(string $key): string
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return null;
    }

    public function setError($error): string
    {
        $this->error = $error;
    }

    public function getError(): string
    {
        return $this->error;
    }
}
