<?php
declare(strict_types = 1);

namespace popp\ch12\batch08;

use popp\ch12\batch06\Registry;
use popp\ch12\batch06\Request;
use popp\ch12\batch06\HttpRequest;
use popp\ch12\batch08\CliRequest;

/**
 * 页面控制器基类-以便将它们（控制器和视图）明显地分离
 *
 * PageController类所扮演的主要角色是提供对Request对象的访问并管理视图的加载。
 *
 * 在实际项目中，
 * 随着子类越来越多，
 * 我们会发现有些功能应当成为通用功能，
 * 于是PageController类所扮演的角色也会越来越多。
 *
 * Class PageController
 *
 * @package popp\ch12\batch08
 */
abstract class PageController
{
    private $reg;

    abstract public function process();

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    public function init()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $request = new HttpRequest();
        } else {
            $request = new CliRequest();
        }

        $this->reg->setRequest($request);
    }

    public function forward(string $resource)
    {
        $request = $this->getRequest();
        $request->forward($resource);
    }

    public function render(string $resource, Request $request)
    {
        include($resource);
    }

    public function getRequest()
    {
        return $this->reg->getRequest();
    }
}
