<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

class HttpRequest extends Request
{
    public function init()
    {
        // we're conveniently ignoring POST/GET/etc distinctions
        // don't do that in the real world!

        // 完整的实现应该管理GET、POST和PUT数组，
        // 并提供一套统一的查询机制。
        $this->properties = $_REQUEST;
        $this->path = $_SERVER['PATH_INFO'];
        $this->path = (empty($this->path)) ? "/" : $this->path;
    }
}
