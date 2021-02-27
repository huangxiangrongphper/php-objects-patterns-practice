<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

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


    // CliRequest
    // 而对于CliRequest，
    // 我们不能依赖服务器来处理转发，
    // 因此需要采取另一种方法。

    // 我们利用了"在解析参数数组以得到路劲时，
    // 最后匹配到的路径会设置在Request中这一特点"。
    // 因此，
    // 我们所需要做的只是添加一个路径参数、清空注册表、然后重新运行控制器。
    public function forward(string $path)
    {
        // tack the new path onto the end the argument list
        // last argument wins
        $_SERVER['argv'][] = "path:{$path}";
        Registry::reset();
        Controller::run();
    }
}
