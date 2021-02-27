<?php

// 自动加载函数包含以传统方式命名的类文件（如PEAR包中的类文件）。
$underscores = function ($classname) {
    // 将$classname中的下划线替换为DIRECTORY_SEPARATOR字符（在Unix系统上为/）,
    // 然后尝试包含这个类文件（util/BlashNew.php）
    $path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
    $path = __DIR__ . "/$path";
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};

\spl_autoload_register($underscores);

$blah = new util_BlahNew();
$blah->wave();
