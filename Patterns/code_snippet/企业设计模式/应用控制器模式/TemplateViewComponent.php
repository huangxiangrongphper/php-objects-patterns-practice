<?php
declare(strict_types = 1);

namespace popp\ch12\batch06;

/**
 * Command对象不再调用视图，
 * 那么我们需要一种渲染模板的机制。
 *
 * 此类实现
 *
 * Class TemplateViewComponent
 *
 * @package popp\ch12\batch06
 */
class TemplateViewComponent implements ViewComponent
{
    private $name = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render(Request $request)
    {
        $reg = Registry::instance();
        $conf = $reg->getConf();
        $path = $conf->get("templatepath");

        if (is_null($path)) {
            throw new AppException("no template directory");
        }

        // 将模板路径配置值与这个名字拼接起来，
        // 作为要包含的完整的模板路径。
        $fullpath = "{$path}/{$this->name}.php";

        if (! file_exists($fullpath)) {
            throw new AppException("no template at {$fullpath}");
        }

        include($fullpath);
    }
}
