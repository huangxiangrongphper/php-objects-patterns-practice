<?php

/**
 * Composer会生成一个名为autoload.php的文件，
 * 它会负责加载所下载的软件包中的类。
 *
 * 我们也可以通过包含autoload.php（通常使用require_once()）实现自动加载自己的类。
 * 这样一来，只要目录和文件名与命名空间和类名一一对应
 * 例如，popp5/megaquiz/command/CommandContext类必须定义在CommandContext.php文件中，
 * 而且该文件必须位于popp5/megaquiz/command/目录下，
 * 那么在代码中访问我们自己声明的类时，它们都会自动加载到系统。
 *
 * 如果还希望自动加载那些命名空间和类名与目录和文件名不对应的类，
 * 例如，省略一两个冗长的主目录，
 * 或者在类的查找路径中添加一个测试目录，
 * 那么可以使用autoload元素将命名空间映射到文件结构，如下若示。
 * "autoload"：{
 *     "psr-4": {
 *         "popp5\\megaquiz\\": ["src", "test"]
 *      }
 * }
 *
 *
 *
 *
 *
 */
