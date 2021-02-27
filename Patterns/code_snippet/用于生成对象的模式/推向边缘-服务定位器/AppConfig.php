<?php
declare(strict_types = 1);

namespace popp\ch09\batch13;

use popp\ch09\batch09\CommsManager;
use popp\ch09\batch09\MegaCommsManager;
use popp\ch09\batch09\BloggsCommsManager;

/**
 * 这是一个标准的单例。因此，我们可以在系统中的任何地方得到一个AppConfig实例。
 * 而且得到的都是同一个实例。
 *
 * 之前的模式会推迟做出应该创建哪个或哪一组对象的决定。
 *
 * 因为PHP应用必须对每个请求进行重新配置，所以我们需要使脚本的初始化尽可能地快速。
 *
 * 这个类结合使用单例模式与抽象工厂模式
 *
 * AppConfig的职责是找出并创建组件，所以它是服务定位器模式的一个典型示例。、
 * 与直接进行实例化相比，它引入的依赖关系更加缓和。
 * 任何使用其服务的类都必须显示地调用这个服务定位器，这会将它们与外部系统绑定在一起。
 *
 * AppConfig能够代替客户端查找组件或服务的类
 *
 * 服务定位器模式更加简单，但它在组件与外部系统间建立了依赖关系。
 *
 * Class AppConfig
 *
 * @package popp\ch09\batch13
 */
class AppConfig
{
    private static $instance;
    private $commsManager;

    private function __construct()
    {
        // will run once only
        // 在每个进程中只执行一次
        $this->init();
    }

    // 查找和提供所需类型实例的责任委托给了这个方法
    private function init()
    {
        // 服务定位器的硬编码调用会使组件依赖于它。
        // 所以客户端与目标组件（由服务定位器提供）间的关系也有些模糊。
        // 通常会首先选择使用服务定位器。
        // 这样只需几行代码就能够创建出一个Registry类，并能根据需求增加其灵活性。
        switch (Settings::$COMMSTYPE) {
            case 'Mega':
                $this->commsManager = new MegaCommsManager();
                break;
            default:
                $this->commsManager = new BloggsCommsManager();
        }
    }

    public static function getInstance(): AppConfig
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCommsManager(): CommsManager
    {
        return $this->commsManager;
    }
}
