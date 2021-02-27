<?php

// 定义一个接受类名作为参数的自动加载函数
$basic = function ($classname) {
    $file = __DIR__ . "/" . "{$classname}.php";
    if (file_exists($file)) {
        require_once($file);
    }
};
// 注册自定义的函数来处理不同的文件命名约定。
// spl_autoload_register 默认加载小写的类名文件
// 将指向这个自定义加载函数的引用传递给spl_autoload_register()。
// 一旦调用了自动加载函数，PHP将再次尝试实例化该类。
// 实际项目可以结合使用包含路径配置与自动加载逻辑（Composer的自动加载实现就是这么做的）。
\spl_autoload_register($basic);

$blah = new Blah();
$blah->wave();
