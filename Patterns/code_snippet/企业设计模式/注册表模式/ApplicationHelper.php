<?php
declare(strict_types = 1);

namespace popp\ch12\batch01;

/**
 * 注册表（Registry）模式：该模式的作用是让进程中的所有类都能够使用数据。
 * 只要谨慎地序列化数据，我们也可以使用该模式进行跨会话甚至跨应用实例的信息存储。
 *
 * 注册表模式超出了分层结构的范围。实际上，注册表是突破分层制约的一种有力手段。
 * 它是为了顺利分层而允许的一种特例。
 *
 * 注册表模式提供了在系统范围内访问对象的能力。
 *
 * Class ApplicationHelper
 *
 * @package popp\ch12\batch01
 */
class ApplicationHelper
{
    public function getOptions(): array
    {
        $optionfile = __DIR__ . "/data/woo_options.xml";

        if (! file_exists($optionfile)) {
            throw new AppException("Could not find options file");
        }

        $options = simplexml_load_file($optionfile);
        $dsn = (string)$options->dsn;
        // what do we do with this now?
        // ...

        return [$dsn];

    }
}

