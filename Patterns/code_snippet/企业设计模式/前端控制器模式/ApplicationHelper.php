<?php
declare(strict_types = 1);

namespace popp\ch12\batch05;

/**
 * ApplicationHelper类并非前端控制器模式的核心。
 * 但因为多数前端控制器模式的实现都必须获取基本的配置数据，
 * 所以我们应设计一种相关的策略。
 *
 *
 * 这个类是读取一个配置文件，
 * 并将各种对象添加到注册表，
 * 以便它们可以在整个系统中被访问。
 *
 * Class ApplicationHelper
 *
 * @package popp\ch12\batch05
 */
class ApplicationHelper
{
    private $config = __DIR__ . "/data/woo_options.ini";
    private $reg;

    public function __construct()
    {
        $this->reg = Registry::instance();
    }

    // init()方法还会判断应用是在Web浏览器上执行还是在命令行中运行
    // 通过检查$_SERVER['REQUEST_METHOD']是否存在。
    public function init()
    {
        $this->setupOptions();

        if (isset($_SERVER['REQUEST_METHOD'])) {
            $request = new HttpRequest();
        } else {
            $request = new CliRequest();
        }

        // 将不同的Request子类传递给Registry对象。
        $this->reg->setRequest($request);
    }

    private function setupOptions()
    {
        if (! file_exists($this->config)) {
            throw new AppException("Could not find options file");
        }

        $options = parse_ini_file($this->config, true);

        // 将两个数组，每个数组都包装在一个名为Conf的数组包装器中
        $conf = new Conf($options['config']);
        $this->reg->setConf($conf);

        $commands = new Conf($options['commands']);
        $this->reg->setCommands($commands);
    }
}

