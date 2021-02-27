<?php
declare(strict_types = 1);

namespace popp\ch12\batch10;

use popp\ch12\batch06\AppException;
use popp\ch12\batch06\Registry;
use popp\ch12\batch06\Conf;

/**
 * 事务脚本模式（Transaction Script）：当希望以最少的前期规划快速地完成工作时，
 * 可以在应用逻辑中使用面向过程的库代码。但是该模式难以扩展。
 *
 * 如果说控制层是协调与调用方的交互并管理系统对其响应的地方，
 * 那么逻辑层就是继续进行业务处理的地方。
 * 逻辑层应当尽可能地保持独立，
 * 远离解析查询字符串、构建HTML表格以及拼接反馈信息等处理的干扰。
 * 业务逻辑应当关注那些确实需要做的事情，
 * 即应用的核心任务。
 * 其他的一切只是为了支持这些任务。
 *
 * 之所以将其作为业务逻辑层的一部分，是因为本模式的动机是实现系统的业务目标。
 *
 * 可以将业务逻辑编写到一组过程式的操作中，然后让每个操作处理特定的请求。
 *
 * 事务脚本模式带来的巨大好处是能够快速地得到想要的结果。
 * 每个脚本都接收输入并操作数据库来得到想要的结果。
 *
 * 除了需要考虑如何在同一个类中组织相关的方法以及将事务脚本类保留在其自己的层（即尽可能独立于命令层、控制层和视图层）中，
 * 事务脚本模式几乎不需要前期设计。
 *
 * 虽然业务逻辑层类往往与表示层明显分离，
 * 但通常它们会更多地嵌入数据层。
 * 这是因为这些类经常需要执行检索和存储数据的任务。
 *
 *
 * 抽象父类-这本身就是一种模式（"层超类型"）。
 * 如果同一层中的类具有相同的功能，
 * 那么我们应当让它们继承于同一个基类，
 * 然后将这些共通的功能放在基类中。
 *
 *
 *
 * Class Base
 *
 * @package popp\ch12\batch10
 */
abstract class Base
{
    private $pdo;
    private $config = __DIR__ . "/data/woo_options.ini";

    private $stmts = [];

    public function __construct()
    {
        $reg = Registry::instance();
        $options = parse_ini_file($this->config, true);
        $conf = new Conf($options['config']);
        $reg->setConf($conf);
        $dsn = $reg->getDSN();

        if (is_null($dsn)) {
            throw new AppException("No DSN");
        }

        $this->pdo = new \PDO($dsn);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
