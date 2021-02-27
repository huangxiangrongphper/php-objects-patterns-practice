<?php

$namespaces = function ($path) {
    // 在字符串中，两个反斜杠被解释为一个反斜杠，然后在作为正则表达式， \\ 则被正则表达式引擎解释为 \，所以在正则表达式中需要使用四个反斜杠。
    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};
// 传递给自动加载函数的值总是会标准化为一个完全限定的名字，没有开头的反斜杠，因此，
// 实例化对象时无须担心别名或相对命名空间的问题
\spl_autoload_register($namespaces);
$obj = new util\LocalPath();
$obj->wave();
