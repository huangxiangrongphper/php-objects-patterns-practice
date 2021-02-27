<?php

$underscores = function ($classname) {
    $path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
    $path = __DIR__ . "/$path";
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};

$namespaces = function ($path) {
    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};

\spl_autoload_register($namespaces);
// 同时支持PEAR风格的类名和命名空间
\spl_autoload_register($underscores);
// 如果需要多条 autoload 函数，spl_autoload_register() 满足了此类需求。 它实际上创建了 autoload 函数的队列，按定义时的顺序逐个执行。相比之下， __autoload() 只可以定义一次。

// 维护自动加载栈允许系统中的各个部分独立地注册自动加载策略，而不会互相覆盖。
// 事实上，如果一个库只是短暂地需要使用一种简单的自动加载机制，那么它还可以将自定义的自动加载函数的名字（如果该函数是匿名函数，那么就是指向它的引用）
// 传递给spl_autoload_unregister()，以清理自己留下的自动加载机制！

$blah = new BlahNew();
$blah->wave();

$obj = new util\LocalPath();
$obj->wave();


