<?php
// 强类型声明 只适用于调用方的代码，而不适用于函数或方法的实现代码。
// 因此，需要由客户端代码加强这种严格性。
declare(strict_types=1);

class Runner
{
    public static function run1()
    {

        $settings = simplexml_load_file(__DIR__."/resolve.xml");
        $manager = new AddressManager();
        $manager->outputAddresses((string)$settings->resolvedomains);

    }

    public static function run2()
    {

        $manager = new AddressManager();
        // 强类型声明，会使得传递的字符串"false"不再隐式转换为布尔值true
        $manager->outputAddresses("false");

    }
}
