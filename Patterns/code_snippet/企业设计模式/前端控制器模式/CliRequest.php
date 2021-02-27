<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 * CliRequest从命令行中以key=value的格式获取参数并将其分解为属性。
 * 它还会在参数中寻找path：前缀，
 * 并将参数值赋值给对象的$path属性。
 *
 * Class CliRequest
 *
 * @package popp\ch12\batch05
 */
class CliRequest extends Request
{
    public function init()
    {
        $args = $_SERVER['argv'];

        foreach ($args as $arg) {
            if (preg_match("/^path:(\S+)/", $arg, $matches)) {
                $this->path = $matches[1];
            } else {
                if (strpos($arg, '=')) {
                    list($key, $val) = explode("=", $arg);
                    $this->setProperty($key, $val);
                }
            }
        }

        $this->path = (empty($this->path)) ? "/" : $this->path;
    }
}
