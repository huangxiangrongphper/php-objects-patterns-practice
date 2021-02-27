<?php
declare(strict_types = 1);

/**
 *  什么样的文件可以执行操作而不是声明类呢？
 *  应用的启动脚本可以。
 *
 */

namespace popp\ch15\batch01;

require_once(__DIR__ . "/../../../vendor/autoload.php");

$tree = new Tree();
print "loaded " . get_class($tree) . "\n";

